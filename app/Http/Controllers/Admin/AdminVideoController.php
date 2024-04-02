<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoCategory;
use App\Models\Video;

class AdminVideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('rVideoCategory')->get();
        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
        $video_categories = VideoCategory::get();
        return view('admin.video.create', compact('video_categories'));
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'youtube_video_id' => 'required',
        ]);

        $obj = new Video();
        $obj->video_category_id = $request->video_category_id;
        $obj->youtube_video_id = $request->youtube_video_id;
        $obj->save();

        return redirect()->route('admin_video_index')->with('success','Video created successfully');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $video_categories = VideoCategory::get();
        return view('admin.video.edit', compact('video', 'video_categories'));
    }

    public function edit_submit(Request $request, $id)
    {
        $request->validate([
            'youtube_video_id' => 'required',
        ]);
        $video = Video::findOrFail($id);
        $video->video_category_id = $request->video_category_id;
        $video->youtube_video_id = $request->youtube_video_id;
        $video->update();

        return redirect()->route('admin_video_index')->with('success','Video updated successfully');
    }

    public function delete($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->back()->with('success','Video deleted successfully');
    }
}
