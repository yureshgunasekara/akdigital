<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use Inertia\Inertia;
use App\Models\Support;
use App\Models\SupportReplay;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Response;


class SupportController extends Controller
{
    public function generateID()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $id = '';
        for ($i = 0; $i < 10; $i++) {
            $id .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $id;
    }


    function index(Request $request)
    {
        try {
            $page = 10;
            $supports = null;
            $user = auth()->user();

            if ($request->per_page) {
                $page = intval($request->per_page);
            }

            if ($user->role == 'admin') {
                $supports = Support::orderBy('created_at', 'desc')->with('replays')->paginate($page);
            } else {
                $supports = Support::orderBy('created_at', 'desc')
                    ->where('user_id', $user->id)
                    ->with('replays')
                    ->paginate($page);
            }

            Support::orderBy('created_at', 'desc')->with('replays')->paginate($page);

            return Inertia::render('SupportRequest/Show', compact('supports'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    // get support request create page
    function create()
    {
        return Inertia::render('SupportRequest/Create');
    }

    // get support request create page
    function delete($id)
    {
        try {
            $support = Support::where('id', $id)->first();
            foreach ($support->replays as $replay) {
                if ($replay->attachment) {
                    File::delete($replay->attachment);
                }
                SupportReplay::where('id', $replay->id)->delete();
            }
            $support->delete();
            return back()->with('success', 'Support request successfully deleted');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }

    // Create support request
    function store(Request $request): RedirectResponse
    {
        $user = auth()->user();
        try {
            $imgPath = null;
            if ($request->attachment) {
                $location = public_path('/upload/');
                $image = Image::make($request->attachment)->resize(600, 600);
                $image->save($location . time() . $request->attachment->getClientOriginalName());
                $imgPath = 'upload/' . $image->filename . '.' . $image->extension;
            }

            $support = Support::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'ticket_id' => $this->generateID(),
                'category' => $request->category,
                'subject' => $request->subject,
                'priority' => $request->priority,
            ]);

            SupportReplay::create([
                'support_id' => $support->id,
                'replay_from' => 'user',
                'description' => $request->description,
                'attachment' => $imgPath,
            ]);

            return Redirect::to('/support-request')->with('success', 'Support request successfully created.');
        } catch (\Throwable $th) {
            return Redirect::to('/support-request')->with('error', 'Internal server error!. Try again later.');
        }
    }

    public function conversation($id)
    {
        try {
            $support = Support::where('id', $id)->with('replays')->first();
            return Inertia::render('SupportRequest/Conversation', compact('support'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }

    // conversation replay
    public function replay(Request $request)
    {
        try {
            $imgPath = null;
            if ($request->attachment) {
                $location = public_path('/upload/');
                $image = Image::make($request->attachment);
                $image->save($location . time() . $request->attachment->getClientOriginalName());
                $imgPath = 'upload/' . $image->filename . '.' . $image->extension;
            }

            SupportReplay::create([
                'support_id' => $request->support_id,
                'replay_from' => $request->replay_from,
                'description' => $request->description,
                'attachment' => $imgPath,
            ]);

            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }


    public function search(Request $request)
    {
        try {
            $page = 10;
            $result = null;
            $user = auth()->user();
            $query = $request->value;

            if ($request->per_page) {
                $page = intval($request->per_page);
            }

            if ($user->role == 'admin') {
                $result = Support::where('subject', 'LIKE', '%' . $query . '%')->paginate($page);
            } else {
                $result = Support::where('user_id', $user->id)
                    ->where('subject', 'LIKE', '%' . $query . '%')
                    ->paginate($page);
            }

            return $result;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }


    // Export supports list
    public function export()
    {
        $supports = Support::with('replays')->get();
        $columns = Schema::getColumnListing((new Support())->getTable());
        $headers = AppHelper::exportToCSV($supports, $columns, 'supports');

        return Response::make('', 200, $headers);
    }
}
