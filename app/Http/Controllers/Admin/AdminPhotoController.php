<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhotoCategory;
use App\Models\Photo;

class AdminPhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::with('rPhotoCategory')->get();
        return view('admin.photo.index', compact('photos'));
    }

    public function create()
    {
        $photo_categories = PhotoCategory::get();
        return view('admin.photo.create', compact('photo_categories'));
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $obj = new Photo();
        $obj->photo_category_id = $request->photo_category_id;
        $final_name = 'photo_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);
        $obj->photo = $final_name;
        $obj->save();

        return redirect()->route('admin_photo_index')->with('success','Photo created successfully');
    }

    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        $photo_categories = PhotoCategory::get();
        return view('admin.photo.edit', compact('photo', 'photo_categories'));
    }

    public function edit_submit(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);

        if($request->photo != null) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png',
            ]);
            unlink(public_path('uploads/'.$photo->photo));

            $final_name = 'photo_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $photo->photo = $final_name;
        }

        $photo->photo_category_id = $request->photo_category_id;
        $photo->update();

        return redirect()->route('admin_photo_index')->with('success','Photo updated successfully');
    }

    public function delete($id)
    {
        $photo = Photo::findOrFail($id);
        unlink(public_path('uploads/'.$photo->photo));
        $photo->delete();

        return redirect()->back()->with('success','Photo deleted successfully');
    }
}
