<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Slider;
use App\Models\Special;
use App\Models\Feature;
use App\Models\HomePageItem;
use App\Models\Testimonial;
use App\Models\Cause;
use App\Models\Event;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $slider = Slider::get();
        $special = Special::where('id',1)->first();
        $features = Feature::get();
        $home_page_item = HomePageItem::where('id',1)->first();
        $testimonials = Testimonial::get();
        $featured_causes = Cause::where('is_featured','Yes')->get();
        $events = Event::take(3)->get();
        $posts = Post::orderBy('id', 'desc')->take(3)->get();

        return view('front.home', compact('slider', 'special', 'features', 'testimonials', 'home_page_item', 'featured_causes', 'events', 'posts'));
    }
}
