<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhotoCategory;
use App\Models\Photo;

class AdminPhotoCategoryController extends Controller
{
    public function index()
    {
        $photo_categories = PhotoCategory::all();
        return view('admin.photo_category.index', compact('photo_categories'));
    }

    public function create()
    {
        return view('admin.photo_category.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:photo_categories']
        ]);

        $obj = new PhotoCategory();
        $obj->name = $request->name;
        $obj->save();

        return redirect()->route('admin_photo_category_index')->with('success','Photo Category created successfully');
    }

    public function edit($id)
    {
        $photo_category = PhotoCategory::findOrFail($id);
        return view('admin.photo_category.edit', compact('photo_category'));
    }

    public function edit_submit(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'unique:photo_categories,name,'.$id]
        ]);

        $obj = PhotoCategory::findOrFail($id);
        $obj->name = $request->name;
        $obj->update();

        return redirect()->route('admin_photo_category_index')->with('success','Photo Category updated successfully');
    }

    public function delete($id)
    {
        $photos = Photo::where('photo_category_id', $id)->get();
        foreach($photos as $photo) {
            unlink(public_path('uploads/'.$photo->photo));
        }

        Photo::where('photo_category_id',$id)->delete();
        PhotoCategory::where('id',$id)->delete();

        return redirect()->back()->with('success','Photo Category deleted successfully');
    }
}
