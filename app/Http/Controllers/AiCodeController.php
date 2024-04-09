<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Helpers\AppHelper;
use App\Models\SavedCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Response;


class AiCodeController extends Controller
{
    public function index()
    {
        try {
            $todaysCodes = AppHelper::today_content('code');

            return Inertia::render('AiCode', compact('todaysCodes'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function save_code(Request $request)
    {
        try {
            $user = auth()->user();
            SavedCode::create([
                'user_id' => $user->id,
                'title' => $request->title,
                'language' => $request->language,
                'description' => $request->description,
                'code' => $request->code,
            ]);

            return Redirect::route('generated-codes')->with('success', 'Generated code successfully saved.');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Request $request)
    {
        try {
            $page = 10;
            $user = auth()->user();
            if ($request->per_page) {
                $page = intval($request->per_page);
            }

            if ($user->role == 'admin') {
                $codes = SavedCode::orderBy('created_at', 'desc')
                    ->paginate($page);
            } else {
                $codes = SavedCode::orderBy('created_at', 'desc')
                    ->where('user_id', $user->id)
                    ->paginate($page);
            }

            return Inertia::render('SavedDocuments/GeneratedCodes/Show', compact('codes'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function view($id)
    {
        try {
            $code = SavedCode::where('id', $id)->first();

            return Inertia::render('SavedDocuments/GeneratedCodes/View', compact('code'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function delete($id)
    {
        try {
            SavedCode::where('id', $id)->delete();

            return Redirect::route('generated-codes')->with('success', 'Code successfully deleted');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $page = 10;
            $user = auth()->user();
            $query = $request->value;
            if ($request->per_page) {
                $page = intval($request->per_page);
            }

            if ($user->role == 'admin') {
                $result = SavedCode::where('title', 'LIKE', '%' . $query . '%')
                    ->paginate($page);
            } else {
                $result = SavedCode::where('user_id', $user->id)
                    ->where('title', 'LIKE', '%' . $query . '%')
                    ->paginate($page);
            }

            return $result;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }


    // Export codes list
    public function export()
    {
        $codes = SavedCode::all();
        $columns = Schema::getColumnListing((new SavedCode())->getTable());
        $headers = AppHelper::exportToCSV($codes, $columns, 'codes');

        return Response::make('', 200, $headers);
    }
}
