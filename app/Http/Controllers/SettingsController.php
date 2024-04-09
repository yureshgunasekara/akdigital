<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Helpers\AppHelper;
use App\Models\AppSetting;
use App\Models\SmtpSetting;
use App\Models\SocialLogin;
use App\Rules\XSSPurifier;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Mail\ChangeEmailVerification;
use Illuminate\Support\Facades\Cookie;
use App\Models\AppSocial;

class SettingsController extends Controller
{
    private $config;

    public function __construct()
    {
        $this->config = base_path('config\app.php');
    }

    public function configRewrite($key, $prevValue, $newValue)
    {
        file_put_contents(
            $this->config,
            str_replace("'$key' => '" . $prevValue . "'", "'$key' => '" . $newValue . "'", file_get_contents($this->config))
        );
    }

    // Auth settings for admin
    public function auth()
    {
        try {
            $google = SocialLogin::where('name', 'google')->first();

            return Inertia::render('Admin/Settings/Auth', compact('google'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }

    // Auth settings for admin
    public function auth_google(Request $request): RedirectResponse
    {
        $request->validate([
            'google_client_id' => ['required', 'string', 'max:200', new XSSPurifier],
            'google_client_secret' => ['required', 'string', 'max:100', new XSSPurifier],
            'google_redirect' => ['required', 'string', 'max:100', new XSSPurifier],
        ]);
        $google_login_allow = $request->google_login_allow ? true : false;

        try {
            SocialLogin::where('name', 'google')->update([
                'active' => $google_login_allow,
                'client_id' => $request->google_client_id,
                'client_secret' => $request->google_client_secret,
                'redirect_url' => $request->google_redirect,
            ]);

            return Redirect::route('settings.auth')->with('success', 'Google auth successfully updated.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }

    // Global settings for admin
    public function global()
    {
        try {
            $socials = AppSocial::all();

            return Inertia::render('Admin/Settings/Global', compact('socials'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }

    // Global settings for admin
    public function global_update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50', new XSSPurifier],
            'email' => ['required', 'max:50', 'email', new XSSPurifier],
            'timezone' => ['required', 'string', 'max:50', new XSSPurifier],
            'description' => ['required', 'string', 'max:300', new XSSPurifier],
            'copyright' => ['required', 'string', 'max:100', new XSSPurifier],
        ]);
        if ($request->logo) {
            $request->validate([
                'logo' => ['image', 'mimes:jpg,png,jpeg', 'max:2048']
            ]);
        }

        try {
            $app = AppSetting::first();

            if ($request->logo) {
                File::delete($app->logo);
                $imgUrl = AppHelper::image_uploader($request->logo);
                $app->logo = $imgUrl;
            }

            $app->name = $request->name;
            $app->email = $request->email;
            $app->timezone = $request->timezone;
            $app->description = $request->description;
            $app->copyright = $request->copyright;
            $app->save();

            return back()->with('success', 'Global settings successfully updated.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    // OpenAI setup for admin
    public function openai()
    {
        try {
            return Inertia::render('Admin/Settings/OpenAI');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function openai_update(Request $request): RedirectResponse
    {
        if ($request->openai_key) {
            $request->validate(['openai_key' => ['max:100', new XSSPurifier]]);
        }

        try {
            $app = AppSetting::first();
            $app->openai_key = $request->openai_key ?? "";
            $app->save();

            return back()->with('success', 'AWS setup successfully updated.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    // OpenAI setup for admin
    public function model(Request $request)
    {
        try {
            $cookie = Cookie::forever('model', $request->model);

            return back()->with('success', 'Model selected for Template and AIChat features')->withCookie($cookie);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    // AWS poly setup for admin
    public function aws_setup(Request $request): RedirectResponse
    {
        if ($request->aws_key) {
            $request->validate(['aws_key' => ['max:100', new XSSPurifier]]);
        }

        if ($request->aws_secret) {
            $request->validate(['aws_secret' => ['max:100', new XSSPurifier]]);
        }

        try {
            $app = AppSetting::first();
            $app->aws_key = $request->aws_key ?? "";
            $app->aws_secret = $request->aws_secret ?? "";
            $app->save();

            return back()->with('success', 'OpenAI setup successfully updated.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    // Add new social link from global settings
    public function add_social(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:30', new XSSPurifier],
            'link' => ['required', 'url'],
            'logo' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048']
        ]);

        try {
            $social = new AppSocial;
            $imgUrl = AppHelper::image_uploader($request->logo);

            $social->name = $request->name;
            $social->link = $request->link;
            $social->logo = $imgUrl;
            $social->save();

            return back()->with('success', 'Added a new app social link.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    // Update new social link from global settings
    public function update_social(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:30', new XSSPurifier],
            'link' => ['required', 'url'],
        ]);
        if ($request->logo) {
            $request->validate(['logo' => ['image', 'mimes:jpg,png,jpeg', 'max:2048']]);
        }

        try {
            $social = AppSocial::find($id);
            if ($request->logo) {
                if (File::exists($social->logo)) File::delete($social->logo);
                $imgUrl = AppHelper::image_uploader($request->logo);
                $social->logo = $imgUrl;
            }

            $social->name = $request->name;
            $social->link = $request->link;
            $social->save();

            return back()->with('success', 'Social link successfully updated.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    // Delete a social link from global settings
    public function delete_social($id): RedirectResponse
    {
        try {
            $social = AppSocial::find($id);
            File::delete($social->logo);
            $social->delete();

            return back()->with('success', 'App social link  successfully deleted');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    // SMTP settings for admin
    public function smtp()
    {
        try {
            $smtp = SmtpSetting::first();

            return Inertia::render('Admin/Settings/SMTP', compact('smtp'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }

    // SMTP settings for admin
    public function smtp_update(Request $request): RedirectResponse
    {
        $request->validate([
            'host' => ['required', 'max:50', new XSSPurifier],
            'port' => ['required', 'max:10', new XSSPurifier],
            'username' => ['required', 'max:50', new XSSPurifier],
            'password' => ['required', 'max:100'],
            'encryption' => ['required', 'max:10', new XSSPurifier],
            'from_address' => ['required', 'max:50', 'email', new XSSPurifier],
            'from_name' => ['required', 'max:50', new XSSPurifier],
            'admin_email' => 'required|max:50|email',
        ]);

        try {
            config(['mail.mailers.smtp.host' => $request->host]);
            config(['mail.mailers.smtp.port' => (int) $request->port]);
            config(['mail.mailers.smtp.username' => $request->username]);
            config(['mail.mailers.smtp.password' => $request->password]);
            config(['mail.mailers.smtp.encryption' => $request->encryption]);
            config(['mail.from.address' => $request->from_address]);
            config(['mail.from.name' => $request->from_name]);

            Mail::raw('This is a test email.', function ($message) use ($request) {
                $message->to($request->admin_email, 'Recipient Name');
                $message->subject('Test Email');
                $message->from($request->from_address, 'Test');
            });

            $smtp = SmtpSetting::first();

            $smtp->host = $request->host;
            $smtp->port = $request->port;
            $smtp->username = $request->username;
            $smtp->password = $request->password;
            $smtp->sender_email = $request->from_address;
            $smtp->sender_name = $request->from_name;
            $smtp->encryption = $request->encryption;
            $smtp->save();

            return back()->with('success', 'SMTP connection is successfully established');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }



    // Email change feature
    public function change_email(Request $request)
    {
        $request->validate([
            'current_email' => 'required|string|email|max:55||exists:users,email',
            'new_email' => 'required|string|email|max:55|unique:users,email',
        ]);

        try {
            AppHelper::smtp();
            $app = AppSetting::first();
            $user = User::find(auth()->user()->id);

            // Generate a unique token for email verification
            $token = Str::random(60);
            $url = route('save.email', ['token' => $token]);

            // Store the email change request in the database
            $user->email_change_new_email = $request->new_email;
            $user->email_change_token = $token;
            $user->save();

            // Send an email with the verification link to the new email
            Mail::to($request->new_email)->send(new ChangeEmailVerification($user, $app, $url));

            return back()->with('success', 'We have sent a email verification link to your new email account.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function save_email(Request $request)
    {
        try {
            $user = User::find(auth()->user()->id);

            if ($request->token !== $user->email_change_token) {
                return redirect()->route('settings')->with('error', "Verification token didn't match or expire.");
            }
            $user->email = $user->email_change_new_email;
            $user->email_change_new_email = null;
            $user->email_change_token = null;
            $user->save();

            return redirect()->route('settings.account')->with('success', "Your email successfully changed.");
        } catch (\Throwable $th) {
            return redirect()->route('settings.account')->with('error', $th->getMessage());
        }
    }


    // App version handler view controller
    public function appControl()
    {
        try {
            $version = File::get(base_path() . '/version.txt');

            return Inertia::render('Admin/AppControl', compact('version'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
