<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AwardController extends Controller
{
    public function award()
    {
        $topUsers = User::withCount([
            'causeReports as approved_reports_count' => function ($query) {
                $query->whereHas('cause', function ($subQuery) {
                    $subQuery->where('status', 'approve');
                });
            }
        ])
        ->orderBy('approved_reports_count', 'desc')
        ->limit(3)
        ->get();

        return view('front.award', compact('topUsers'));
    }


}

