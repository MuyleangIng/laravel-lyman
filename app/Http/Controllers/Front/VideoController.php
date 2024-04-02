<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoCategory;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $video_categories = VideoCategory::with('rVideo')->get();
        return view('front.video_gallery', compact('video_categories'));
    }
}
