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
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $slider = Slider::get();
        $special = Special::where('id', 1)->first();
        $features = Feature::get();
        $home_page_item = HomePageItem::where('id', 1)->first();
        $testimonials = Testimonial::get();
        $featured_causes = Cause::where('is_featured', 'Yes')->where('status', 'approve')->get();
        $events = Event::take(3)->get();
        $posts = Post::orderBy('id', 'desc')->take(3)->get();
    
        $user = Auth::user(); // Get the currently authenticated user
    
        // Attach liked_by_user, bookmarked_by_user status, and track viewers
        foreach ($featured_causes as $cause) {
            $cause->liked_by_user = $user ? $cause->likedByUsers->contains($user->id) : false;
            $cause->bookmarked_by_user = $user ? $cause->bookmarkedByUsers->contains($user->id) : false;
    
            // Track the viewer
            $this->trackViewer($cause);
        }
    
        return view('front.home', compact('slider', 'special', 'features', 'testimonials', 'home_page_item', 'featured_causes', 'events', 'posts'));
    }
    
    /**
     * Track a viewer for a cause.
     *
     * @param \App\Models\Cause $cause
     * @return void
     */
    protected function trackViewer($cause)
    {
        $user = Auth::user(); // Get the currently authenticated user
        $ipAddress = request()->ip(); // Get the IP address of the request
    
        // Check if the user has already viewed the cause in this session
        if ($user) {
            $viewed = session()->has("viewed_causes.{$cause->id}");
            if (!$viewed) {
                session()->put("viewed_causes.{$cause->id}", true);
                $cause->increment('views');
            }
        } else {
            // Track views by IP if the user is not authenticated
            $viewed = session()->has("viewed_causes_ip.{$cause->id}.{$ipAddress}");
            if (!$viewed) {
                session()->put("viewed_causes_ip.{$cause->id}.{$ipAddress}", true);
                $cause->increment('views');
            }
        }
    }
    
}
