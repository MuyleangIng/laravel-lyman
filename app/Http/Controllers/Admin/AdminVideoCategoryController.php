<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoCategory;
use App\Models\Video;

class AdminVideoCategoryController extends Controller
{
    public function index()
    {
        $video_categories = VideoCategory::all();
        return view('admin.video_category.index', compact('video_categories'));
    }

    public function create()
    {
        return view('admin.video_category.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:video_categories']
        ]);

        $obj = new VideoCategory();
        $obj->name = $request->name;
        $obj->save();

        return redirect()->route('admin_video_category_index')->with('success','Video Category created successfully');
    }

    public function edit($id)
    {
        $video_category = VideoCategory::findOrFail($id);
        return view('admin.video_category.edit', compact('video_category'));
    }

    public function edit_submit(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'unique:video_categories,name,'.$id]
        ]);

        $obj = VideoCategory::findOrFail($id);
        $obj->name = $request->name;
        $obj->update();

        return redirect()->route('admin_video_category_index')->with('success','Video Category updated successfully');
    }

    public function delete($id)
    {
        Video::where('video_category_id',$id)->delete();
        VideoCategory::where('id',$id)->delete();

        return redirect()->back()->with('success','Video Category deleted successfully');
    }
}
