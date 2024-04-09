<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        try {
            $page = 10;
            if ($request->per_page) {
                $page = intval($request->per_page);
            }
            $users = User::where('role', '!=', 'admin')->with('subscription_plan')->paginate($page);

            return Inertia::render('Admin/UserManagement/Show', compact('users'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function profile($id)
    {
        try {
            $user = User::where('id', $id)->with('subscription_plan')->first();
            return Inertia::render('Admin/UserManagement/Profile', compact('user'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $user = User::where('id', $id)->with('subscription_plan')->first();
            return Inertia::render('Admin/UserManagement/Update', compact('user'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'role' => 'required',
            'name' => 'required|string|max:100',
            'phone' => 'max:100',
            'status' => 'required',
            'company' => 'max:100',
            'website' => 'max:100',
        ]);

        try {
            $user = User::where('id', $id)->first();

            if ($request->new_image) {
                if ($user->image) {
                    File::delete($user->image);
                }

                $location = public_path('/upload/');
                $image = Image::make($request->image)->resize(600, 600);
                $image->save($location . time() . $request->image->getClientOriginalName());
                $imageUrl = 'upload/' . $image->filename . '.' . $image->extension;

                $user->image = $imageUrl;
            }

            $user->role = $request->role;
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->company = $request->company;
            $user->website = $request->website;
            $user->save();

            return Redirect::route('users.admin')->with('success', 'User successfully updated.');;
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());;
        }
    }


    public function search(Request $request)
    {
        try {
            $page = 10;
            $query = $request->value;

            if ($request->per_page) {
                $page = intval($request->per_page);
            }

            $result = User::where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%')
                ->with('subscription_plan')
                ->paginate($page);

            return $result;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
