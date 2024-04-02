<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhotoCategory;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index()
    {
        $photo_categories = PhotoCategory::with('rPhoto')->get();
        return view('front.photo_gallery', compact('photo_categories'));
    }
}
