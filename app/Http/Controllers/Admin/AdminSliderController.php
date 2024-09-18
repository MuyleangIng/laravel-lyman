<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class AdminSliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'text' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $slider = new Slider();
        $slider->heading = $request->heading;
        $slider->text = $request->text;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $final_name = time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);
        $slider->photo = $final_name;
        $slider->save();

        return redirect()->back()->with('success','Slider created successfully');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function edit_submit(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required',
            'text' => 'required',
            'photo' => 'image|mimes:jpg,jpeg,png', // Validate photo only if it's present
        ]);
    
        $slider = Slider::findOrFail($id);
    
        if ($request->hasFile('photo')) {
            $photoPath = public_path('uploads/' . $slider->photo);
    
            // Check if the old file exists before attempting to delete it
            if ($slider->photo && file_exists($photoPath)) {
                unlink($photoPath);
            }
    
            // Store the new photo
            $final_name = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $slider->photo = $final_name;
        }
    
        // Update other fields
        $slider->heading = $request->heading;
        $slider->text = $request->text;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
    
        // Save changes to the database
        $slider->update();
    
        return redirect()->back()->with('success', 'Slider updated successfully');
    }
    

    public function delete($id)
    {
        $slider = Slider::findOrFail($id);
        unlink(public_path('uploads/'.$slider->photo));
        $slider->delete();

        return redirect()->back()->with('success','Slider deleted successfully');
    }
}
