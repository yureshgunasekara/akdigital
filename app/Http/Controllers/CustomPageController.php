<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\AppSocial;
use App\Models\CustomPage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomPageController extends Controller
{
    function index()
    {
        try {
            $custom_pages = CustomPage::all();

            return Inertia::render('Admin/PageManagement/Show', compact('custom_pages'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    function create()
    {
        try {
            return Inertia::render('Admin/PageManagement/Create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'max:30'],
                'route' => ['required', 'max:30'],
                'content' => ['required'],
            ]);

            CustomPage::create($request->all());

            return redirect()
                ->route('custom-page')
                ->with('success', 'A new page created successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    function page_view(Request $request, $page)
    {
        try {
            $app = AppSetting::first();
            $socials = AppSocial::all();
            $custom_pages = CustomPage::all();
            $current_page = CustomPage::where('route', $page)->first();

            return view('custom-page', compact('app', 'socials', 'custom_pages', 'current_page'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    function update($id)
    {
        try {
            $custom_page = CustomPage::find($id);

            return Inertia::render('Admin/PageManagement/Update', compact('custom_page'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    function save(Request $request, $id)
    {
        try {
            CustomPage::find($id)->update($request->all());

            return redirect()
                ->route('custom-page')
                ->with('success', 'Page updated successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    function delete($id)
    {
        try {
            CustomPage::find($id)->delete();

            return back()->with('success', 'Page deleted successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
