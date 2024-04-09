<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Rules\XSSPurifier;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile page.
     */
    public function index()
    {
        try {
            $user = User::where('id', auth()->user()->id)->with('subscription_plan')->first();
            return Inertia::render('Profile', compact('user'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:100',
            'phone' => 'max:100',
            'company' => 'max:100',
            'website' => 'max:100',
        ]);

        $request->user()->name = $request->input('name');
        $request->user()->phone = $request->input('phone');
        $request->user()->company = $request->input('company');
        $request->user()->website = $request->input('website');
        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // User profile settings
    public function profile()
    {
        return Inertia::render('Settings/Profile');
    }

    /**
     * Update the user's profile information.
     */
    public function profile_update(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => ['max:20'],
            'name' => ['required', 'max:100', new XSSPurifier],
            'image' => ['image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ]);

        if ($request->company) {
            $request->validate(['company' => ['max:100', new XSSPurifier]]);
        }
        if ($request->website) {
            $request->validate(['website' => ['max:100', new XSSPurifier]]);
        }

        try {
            if ($request->image) {
                if ($request->user()->image) {
                    File::delete($request->user()->image);
                }
                $imageUrl = AppHelper::image_uploader($request->image);
                $request->user()->image = $imageUrl;
            }

            $request->user()->name = $request->name;
            $request->user()->phone = $request->phone;
            $request->user()->company = $request->company;
            $request->user()->website = $request->website;
            $request->user()->save();

            return Redirect::route('settings.profile');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    // User account settings
    public function account()
    {
        return Inertia::render('Settings/Account', [
            'error' => session('error'),
            'success' => session('success'),
        ]);
    }
}
