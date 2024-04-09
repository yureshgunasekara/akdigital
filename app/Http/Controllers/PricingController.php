<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Rules\UnlimitedOrNumber;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class PricingController extends Controller
{
    // Get all subscription plan list on admin dashboard
    public function index(Request $request)
    {
        try {
            $page = 10;
            if ($request->per_page) {
                $page = intval($request->per_page);
            }
            $plans = SubscriptionPlan::paginate($page);
            
            return Inertia::render('Admin/PricingManagement/Show', compact('plans'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }


    // Subscription plan create page
    public function create()
    {
        return Inertia::render('Admin/PricingManagement/Create');
    }


    // Creating subscription plan
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'status' => 'required',
            'description' => 'required',
            'monthly_price' => 'required',
            'yearly_price' => 'required',
            'currency' => 'required',
            'prompt_generation' => ['required', new UnlimitedOrNumber],
            'image_generation' => ['required', new UnlimitedOrNumber],
            'code_generation' => ['required', new UnlimitedOrNumber],
            'content_token_length' => ['required', new UnlimitedOrNumber],
            'text_to_speech_generation' => ['required', new UnlimitedOrNumber],
            'text_character_length' => ['required', new UnlimitedOrNumber],
            'speech_to_text_generation' => ['required', new UnlimitedOrNumber],
            'speech_duration' => 'required|integer',
            'support_request' => ['required', new UnlimitedOrNumber],
            'access_template' => 'required',
            'access_chat_bot' => 'required'
        ]);

        try {
            SubscriptionPlan::create([
                'title' => $request->title,
                'type' => $request->type,
                'status' => $request->status,
                'description' => $request->description,
                'monthly_price' => $request->monthly_price,
                'yearly_price' => $request->yearly_price,
                'currency' => $request->currency,
                'prompt_generation' => $request->prompt_generation,
                'image_generation' => $request->image_generation,
                'code_generation' => $request->code_generation,
                'content_token_length' => $request->content_token_length,
                'text_to_speech_generation' => $request->text_to_speech_generation,
                'text_character_length' => $request->text_character_length,
                'speech_to_text_generation' => $request->speech_to_text_generation,
                'speech_duration' => $request->speech_duration,
                'support_request' => $request->support_request,
                'access_template' => $request->access_template,
                'access_chat_bot' => $request->access_chat_bot
            ]);
    
            return Redirect::route('plans')->with('success', 'A new plan successfully created');
        
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }


    // Changing the status of subscription plan
    public function update(Request $request, $planId): RedirectResponse
    {
        $request->validate([
            'status' => 'required',
        ]);
        
        try {
            SubscriptionPlan::where('id', $planId)->update([
                'status' => $request->status,
            ]);

            return Redirect::route('plans')->with('success', 'Plan status successfully changed.');
        
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }
}
