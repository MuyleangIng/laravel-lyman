<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OtherPageItem;

class AdminOtherPageController extends Controller
{
    public function terms()
    {
        $terms_data = OtherPageItem::where('id',1)->first();
        return view('admin.other_pages.terms', compact('terms_data'));
    }

    public function terms_update(Request $request)
    {
        $terms_data = OtherPageItem::where('id',1)->first();
        $terms_data->terms_content = $request->terms_content;
        $terms_data->save();

        return redirect()->back()->with('success', 'Terms & Conditions updated successfully');
    }

    public function privacy()
    {
        $privacy_data = OtherPageItem::where('id',1)->first();
        return view('admin.other_pages.privacy', compact('privacy_data'));
    }

    public function privacy_update(Request $request)
    {
        $privacy_data = OtherPageItem::where('id',1)->first();
        $privacy_data->privacy_content = $request->privacy_content;
        $privacy_data->save();

        return redirect()->back()->with('success', 'Privacy Policy updated successfully');
    }
}
