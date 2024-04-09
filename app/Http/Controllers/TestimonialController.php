<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Testimonial;
use App\Rules\XSSPurifier;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;


class TestimonialController extends Controller
{
    public function index()
    {
        try {
            $testimonials = Testimonial::all();

            return Inertia::render('Admin/Testimonials/Show', compact('testimonials'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function create()
    {
        try {
            return Inertia::render('Admin/Testimonials/Create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50', new XSSPurifier],
            'image' => ['image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
            'designation' => ['required', 'max:50', new XSSPurifier],
            'rating' => ['required', 'numeric'],
            'comment' => ['required', 'max:180', new XSSPurifier],
        ]);

        try {
            $imageUrl = AppHelper::image_uploader($request->image);

            $tes = new Testimonial;
            $tes->name = $request->name;
            $tes->image = $imageUrl;
            $tes->designation = $request->designation;
            $tes->rating = $request->rating;
            $tes->comment = $request->comment;
            $tes->save();

            return redirect(route('testimonials'))->with('success', 'Testimonial Created Successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function get($id)
    {
        try {
            $testimonial = Testimonial::find($id);

            return Inertia::render('Admin/Testimonials/Update', compact('testimonial'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:50', new XSSPurifier],
            'designation' => ['required', 'max:50', new XSSPurifier],
            'rating' => ['required', 'numeric'],
            'comment' => ['required', 'max:180', new XSSPurifier],
        ]);
        if ($request->image) {
            $request->validate(['image' => ['image', 'mimes:jpeg,png,jpg,svg', 'max:2048']]);
        }

        try {
            $testimonial = Testimonial::find($id);

            if ($request->image) {
                if ($testimonial->image) {
                    File::delete($testimonial->image);
                }
                $imageUrl = AppHelper::image_uploader($request->image);
                $testimonial->image = $imageUrl;
            }

            $testimonial->name = $request->name;
            $testimonial->designation = $request->designation;
            $testimonial->rating = $request->rating;
            $testimonial->comment = $request->comment;
            $testimonial->save();

            return redirect(route('testimonials'))->with('success', 'Testimonial Updated Successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function delete($id)
    {
        try {
            $testimonial = Testimonial::find($id);
            if ($testimonial->image) {
                File::delete($testimonial->image);
            }
            $testimonial->delete();

            return back()->with('success', 'Testimonial Deleted Successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
