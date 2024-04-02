<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::paginate(20);
        return view('front.volunteers', compact('volunteers'));
    }

    public function detail($id)
    {
        $volunteer = Volunteer::where('id', $id)->first();
        return view('front.volunteer', compact('volunteer'));
    }
}
