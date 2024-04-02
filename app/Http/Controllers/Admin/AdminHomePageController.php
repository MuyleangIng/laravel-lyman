<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePageItem;

class AdminHomePageController extends Controller
{
    public function index()
    {
        $home_page_items = HomePageItem::where('id',1)->first();
        return view('admin.home_page.index', compact('home_page_items'));
    }

    public function update(Request $request)
    {
        $home_page_item = HomePageItem::where('id',1)->first();

        if($request->feature_background != null) {
            $request->validate([
                'feature_background' => 'image|mimes:jpg,jpeg,png',
            ]);
            
            if($home_page_item->feature_background!=null) {
                unlink(public_path('uploads/'.$home_page_item->feature_background));
            }
            
            $final_name = 'feature_background_'.time().'.'.$request->feature_background->extension();
            $request->feature_background->move(public_path('uploads'), $final_name);
            $home_page_item->feature_background = $final_name;
        }


        if($request->testimonial_background != null) {
            $request->validate([
                'testimonial_background' => 'image|mimes:jpg,jpeg,png',
            ]);
            
            if($home_page_item->testimonial_background!=null) {
                unlink(public_path('uploads/'.$home_page_item->testimonial_background));
            }
            
            $final_name = 'testimonial_background_'.time().'.'.$request->testimonial_background->extension();
            $request->testimonial_background->move(public_path('uploads'), $final_name);
            $home_page_item->testimonial_background = $final_name;
        }

        $home_page_item->cause_heading = $request->cause_heading;
        $home_page_item->cause_subheading = $request->cause_subheading;
        $home_page_item->cause_status = $request->cause_status;
        
        $home_page_item->feature_status = $request->feature_status;

        $home_page_item->event_heading = $request->event_heading;
        $home_page_item->event_subheading = $request->event_subheading;
        $home_page_item->event_status = $request->event_status;

        $home_page_item->testimonial_heading = $request->testimonial_heading;
        $home_page_item->testimonial_status = $request->testimonial_status;

        $home_page_item->blog_heading = $request->blog_heading;
        $home_page_item->blog_subheading = $request->blog_subheading;
        $home_page_item->blog_status = $request->blog_status;

        $home_page_item->update();

        return redirect()->back()->with('success','Home Page is updated successfully');
    }
}
