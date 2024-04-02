<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::find(1);
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::where('id',1)->first();

        if($request->logo != null) {
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png',
            ]);
            
            if($settings->logo!=null) {
                unlink(public_path('uploads/'.$settings->logo));
            }
            
            $final_name = 'logo_'.time().'.'.$request->logo->extension();
            $request->logo->move(public_path('uploads'), $final_name);
            $settings->logo = $final_name;
        }

        if($request->favicon != null) {
            $request->validate([
                'favicon' => 'image|mimes:jpg,jpeg,png',
            ]);
            
            if($settings->favicon!=null) {
                unlink(public_path('uploads/'.$settings->favicon));
            }
            
            $final_name = 'favicon_'.time().'.'.$request->favicon->extension();
            $request->favicon->move(public_path('uploads'), $final_name);
            $settings->favicon = $final_name;
        }

        if($request->banner != null) {
            $request->validate([
                'banner' => 'image|mimes:jpg,jpeg,png',
            ]);
            
            if($settings->banner!=null) {
                unlink(public_path('uploads/'.$settings->banner));
            }
            
            $final_name = 'banner_'.time().'.'.$request->banner->extension();
            $request->banner->move(public_path('uploads'), $final_name);
            $settings->banner = $final_name;
        }

        $settings->top_phone = $request->top_phone;
        $settings->top_email = $request->top_email;
        $settings->cta_heading = $request->cta_heading;
        $settings->cta_text = $request->cta_text;
        $settings->cta_button_text = $request->cta_button_text;
        $settings->cta_button_url = $request->cta_button_url;
        $settings->cta_status = $request->cta_status;

        $settings->footer_address = $request->footer_address;
        $settings->footer_email = $request->footer_email;
        $settings->footer_phone = $request->footer_phone;
        $settings->facebook = $request->facebook;
        $settings->twitter = $request->twitter;
        $settings->linkedin = $request->linkedin;
        $settings->instagram = $request->instagram;
        $settings->youtube = $request->youtube;
        $settings->copyright = $request->copyright;
        $settings->map = $request->map;

        $settings->update();

        return redirect()->back()->with('success','Setting is updated successfully');
    }
}
