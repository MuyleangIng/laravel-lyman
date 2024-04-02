<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OtherPageItem;

class TermsController extends Controller
{
    public function index()
    {
        $terms_data = OtherPageItem::where('id',1)->first();
        return view('front.terms', compact('terms_data'));
    }
}
