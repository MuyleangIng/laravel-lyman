<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AwardController extends Controller
{
    function award(){
        $topUsers = User::withCount(['causes' => function ($query) {
            $query->where('status', 'approve');
        }])->orderBy('causes_count', 'desc')->limit(3)->get();


    return view('front.award', compact('topUsers'));
    }
}

