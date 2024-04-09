<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\AppSetting;
use App\Models\AppSocial;
use App\Models\ChildSection;
use App\Models\ChildSectionLink;
use App\Models\CustomPage;
use App\Models\IntroSection;
use App\Models\IntroSectionChild;
use App\Models\SubscriptionPlan;
use App\Models\Testimonial;
use App\Rules\XSSPurifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class IntroController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $app = AppSetting::first();
        $socials = AppSocial::all();
        $plans = SubscriptionPlan::where('status', 'Active')->get();
        $custom_pages = CustomPage::all();
        $testimonials = Testimonial::all();

        $header = IntroSection::where('type', 'header')->with('child_sections.section_links')->first();
        $features = IntroSection::where('type', 'features')->with('child_sections.section_links')->first();
        $ai_template = IntroSection::where('type', 'ai_template')->with('child_sections.section_links')->first();
        $ai_image = IntroSection::where('type', 'ai_image')->with('child_sections.section_links')->first();
        $ai_code = IntroSection::where('type', 'ai_code')->with('child_sections.section_links')->first();
        $ai_chatbot = IntroSection::where('type', 'ai_chatbot')->with('child_sections.section_links')->first();
        $speech_to_text = IntroSection::where('type', 'speech_to_text')->with('child_sections.section_links')->first();
        $text_to_speech = IntroSection::where('type', 'text_to_speech')->with('child_sections.section_links')->first();
        $demo_content = IntroSection::where('type', 'demo_content')->with('child_sections.section_links')->first();
        $templates = IntroSection::where('type', 'templates')->with('child_sections.section_links')->first();
        $testimonial_content = IntroSection::where('type', 'testimonials')->with('child_sections.section_links')->first();
        $faqs_content = IntroSection::where('type', 'faqs_content')->with('child_sections.section_links')->first();
        $pricing = IntroSection::where('type', 'pricing')->with('child_sections.section_links')->first();
        $partners = IntroSection::where('type', 'partners')->with('child_sections.section_links')->first();
        $banner = IntroSection::where('type', 'banner')->with('child_sections.section_links')->first();


        return view(
            'intro',
            compact(
                'app',
                'plans',
                'header',
                'features',
                'ai_template',
                'ai_image',
                'ai_code',
                'ai_chatbot',
                'speech_to_text',
                'text_to_speech',
                'demo_content',
                'templates',
                'testimonial_content',
                'faqs_content',
                'pricing',
                'partners',
                'banner',
                'testimonials',
                'custom_pages',
                'socials',
            )
        );
    }

    public function customize(Request $request)
    {
        $user = auth()->user();
        $app = AppSetting::first();
        $plans = SubscriptionPlan::where('status', 'Active')->get();
        $testimonials = Testimonial::all();

        $header = IntroSection::where('type', 'header')->with('child_sections.section_links')->first();
        $features = IntroSection::where('type', 'features')->with('child_sections.section_links')->first();
        $ai_template = IntroSection::where('type', 'ai_template')->with('child_sections.section_links')->first();
        $ai_image = IntroSection::where('type', 'ai_image')->with('child_sections.section_links')->first();
        $ai_code = IntroSection::where('type', 'ai_code')->with('child_sections.section_links')->first();
        $ai_chatbot = IntroSection::where('type', 'ai_chatbot')->with('child_sections.section_links')->first();
        $speech_to_text = IntroSection::where('type', 'speech_to_text')->with('child_sections.section_links')->first();
        $text_to_speech = IntroSection::where('type', 'text_to_speech')->with('child_sections.section_links')->first();
        $demo_content = IntroSection::where('type', 'demo_content')->with('child_sections.section_links')->first();
        $templates = IntroSection::where('type', 'templates')->with('child_sections.section_links')->first();
        $testimonial_content = IntroSection::where('type', 'testimonials')->with('child_sections.section_links')->first();
        $faqs_content = IntroSection::where('type', 'faqs_content')->with('child_sections.section_links')->first();
        $pricing = IntroSection::where('type', 'pricing')->with('child_sections.section_links')->first();
        $partners = IntroSection::where('type', 'partners')->with('child_sections.section_links')->first();
        $banner = IntroSection::where('type', 'banner')->with('child_sections.section_links')->first();

        $customize = true;


        return view(
            'customize',
            compact(
                'app',
                'plans',
                'header',
                'features',
                'ai_template',
                'ai_image',
                'ai_code',
                'ai_chatbot',
                'speech_to_text',
                'text_to_speech',
                'demo_content',
                'templates',
                'testimonial_content',
                'faqs_content',
                'pricing',
                'partners',
                'banner',
                'customize',
                'testimonials',
            )
        );
    }


    public function section(Request $request, $id)
    {

        $request->validate([
            'title' => ['required', 'string', 'max:100', new XSSPurifier],
            'subtitle' => ['string', 'max:200', new XSSPurifier],
            'description' => ['string', 'max:500', new XSSPurifier],
        ]);

        if ($request->asset) {
            if ($request->asset_type == 'image') {
                $request->validate(['asset' => 'required|image|mimes:jpeg,png,jpg|max:2048']);
            } else {
                $request->validate(['asset' => 'required|max:6000|mimes:mp4']);
            }
        }

        try {
            $section = IntroSection::find($id);
            $section->title = $request->title;
            if ($request->subtitle) $section->subtitle = $request->subtitle;
            if ($request->description) $section->description = $request->description;

            if ($request->asset) {
                $res = explode('/', $section->asset);
                if ($res && $res[0] == 'upload') {
                    File::delete($section->asset);
                }

                if ($request->asset_type == 'image') {
                    $assetUrl = AppHelper::image_uploader($request->asset);
                } else {
                    $name = time() . '.' . $request->asset->getClientOriginalExtension();
                    $request->asset->move(public_path('upload'), $name);
                    $assetUrl = 'upload/' . $name;
                }

                $section->asset = $assetUrl;
            }
            $section->save();

            return back();
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function child_section(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100', new XSSPurifier],
            'subtitle' => ['string', 'max:200', new XSSPurifier],
            'description' => ['string', 'max:500', new XSSPurifier],
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        try {
            $section = ChildSection::find($id);
            $section->title = $request->title;
            if ($request->subtitle) $section->subtitle = $request->subtitle;
            if ($request->description) $section->description = $request->description;

            if ($request->image) {
                $res = explode('/', $section->image);
                if ($res && $res[0] == 'upload') {
                    File::delete($section->image);
                }

                $imageUrl = AppHelper::image_uploader($request->image);
                $section->image = $imageUrl;
            }
            $section->save();

            return back();
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function section_link(Request $request)
    {
        $request->validate([
            'link_text1' => ['string', 'max:100', new XSSPurifier],
            'link_url1' => ['url', 'max:100', new XSSPurifier],
            'link_text2' => ['string', 'max:100', new XSSPurifier],
            'link_url2' => ['url', 'max:100', new XSSPurifier],
        ]);

        try {
            if ($request->link_one_id) {
                $link = ChildSectionLink::find($request->link_one_id);
                $link->link_text = $request->link_text1;
                $link->link_url = $request->link_url1;
                $link->save();
            }

            if ($request->link_two_id) {
                $link = ChildSectionLink::find($request->link_two_id);
                $link->link_text = $request->link_text2;
                $link->link_url = $request->link_url2;
                $link->save();
            }

            return back();
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
