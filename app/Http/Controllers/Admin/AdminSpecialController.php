<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Special;

class AdminSpecialController extends Controller
{
    public function edit()
    {
        $special = Special::where('id',1)->first();
        return view('admin.special.edit', compact('special'));
    }

    public function edit_submit(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'text' => 'required',
            'video_id' => 'required'
        ]);
    
        $special = Special::findOrFail(1);
    
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png',
            ]);
    
            // Check if the photo exists before attempting deletion
            if (file_exists(public_path('uploads/'.$special->photo))) {
                // Delete the existing photo
                unlink(public_path('uploads/'.$special->photo));
            }
    
            // Move the new photo to the uploads directory
            $final_name = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $special->photo = $final_name;
        }
    
        $special->heading = $request->heading;
        $special->sub_heading = $request->sub_heading;
        $special->text = $request->text;
        $special->button_text = $request->button_text;
        $special->button_link = $request->button_link;
        $special->video_id = $request->video_id;
        $special->status = $request->status;
        $special->save();
    
        return redirect()->back()->with('success', 'Special section updated successfully');
    }
    
}
