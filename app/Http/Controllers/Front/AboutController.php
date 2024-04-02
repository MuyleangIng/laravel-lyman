<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counter;
use App\Models\Special;
use App\Models\Feature;
use App\Models\HomePageItem;

class AboutController extends Controller
{
    public function index()
    {
        $counters = Counter::where('id',1)->first();
        $special = Special::where('id',1)->first();
        $features = Feature::get();
        $home_page_item = HomePageItem::where('id',1)->first();
        return view('front.about', compact('counters', 'special', 'features', 'home_page_item'));
    }
}
