<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\SavedDocument;
use App\Models\SubscriptionPlan;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;


class TemplatesController extends Controller
{
    function index()  
    {
        try {
            $user = auth()->user();
            $templateAccess = null;
            if ($user->role == 'admin') {
                $templateAccess = '';
            } else {
                $plan = SubscriptionPlan::where('id', $user->subscription_plan_id)->first();
                $templateAccess = $plan->access_template;
            }
            $templates = Template::all();
            $todaysTemplate = AppHelper::today_content('template');
            
            return Inertia::render('Templates/Show', compact('templates', 'templateAccess', 'todaysTemplate'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }


    // Template management show
    function show(Request $request)  
    {
        try {
            $page = 10;
            if ($request->per_page) {
                $page = intval($request->per_page);
            }
            $templates = Template::paginate($page);

            return Inertia::render('Admin/TemplatesManagement/Show', compact('templates'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }


    function create($id) 
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();

            if ($user->role == 'admin') {
                $template = Template::where('id', $id)->first();
                return Inertia::render('Templates/Create', compact('template'));
            }

            $todaysTemplate = AppHelper::today_content('template');
            
            if($user->subscription_plan->access_template == 'Premium'){
                $template = Template::where('id', $id)->first();
                return Inertia::render('Templates/Create', compact('template', 'todaysTemplate'));
            }
            elseif($user->subscription_plan->access_template == 'Standard'){
                $template = Template::where('id', $id)->first();
                if($template->access_plan == 'Free' || $template->access_plan == 'Standard'){                    
                    return Inertia::render('Templates/Create', compact('template', 'todaysTemplate'));
                }
                else{
                    return back()->with('warning', 'You need to update your current plan to access this.');
                }
            }
            elseif($user->subscription_plan->access_template == 'Free'){
                $template = Template::where('id', $id)->first();
                if($template->access_plan == 'Free'){                    
                    return Inertia::render('Templates/Create', compact('template', 'todaysTemplate'));
                }
                else{
                    return back()->with('warning', 'You need to update your current plan to access this.');
                }
            }
            
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }


    // new document creating
    function store(Request $request): RedirectResponse
    {
        try {
            SavedDocument::create($request->all());
            
            return Redirect::route('template-contents');
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }


    // Template edit request
    function edit($id)  
    {
        try {
            $template = Template::where('id', $id)->first();
            return Inertia::render('Admin/TemplatesManagement/Update', compact('template'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }


    // Template update request
    function update(Request $request, $id): RedirectResponse 
    {
        $request->validate([
            'title' => 'required|max:40',
            'slug' => 'required|max:40',
            'status' => 'required',
            'type' => 'required',
            'description' => 'required|max:120',
        ]);

        try {
            Template::where('id', $id)->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'status' => $request->status,
                'access_plan' => $request->type,
                'description' => $request->description,
            ]);
            return Redirect::route('templates.admin')->with('success', "Template successfully updated");

        } catch (\Throwable $th) {
            return Redirect::route('templates.admin')->with('error', 'Internal server error!. Try again later.');
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

            $result = Template::where('title', 'LIKE', '%'.$query.'%')->paginate($page);

            return $result;
        } catch (\Throwable $th) {
            return response()->json(['error'=> $th->getMessage()]);
        }
    }
}
