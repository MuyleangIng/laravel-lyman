<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'comment' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->comment = $request->comment;
        $final_name = 'testimonial_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);
        $testimonial->photo = $final_name;
        $testimonial->save();

        return redirect()->route('admin_testimonial_index')->with('success','Testimonial created successfully');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function edit_submit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'comment' => 'required'
        ]);

        $testimonial = Testimonial::findOrFail($id);

        if($request->photo != null) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png',
            ]);
            unlink(public_path('uploads/'.$testimonial->photo));

            $final_name = 'testimonial_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $testimonial->photo = $final_name;
        }

        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->comment = $request->comment;
        $testimonial->update();

        return redirect()->back()->with('success','Testimonial updated successfully');
    }

    public function delete($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        unlink(public_path('uploads/'.$testimonial->photo));
        $testimonial->delete();

        return redirect()->back()->with('success','Testimonial deleted successfully');
    }
}
