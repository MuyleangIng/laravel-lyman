<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;

class AdminVolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::all();
        return view('admin.volunteer.index', compact('volunteers'));
    }

    public function create()
    {
        return view('admin.volunteer.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'profession' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $volunteer = new Volunteer();
        $volunteer->name = $request->name;
        $volunteer->profession = $request->profession;
        $volunteer->address = $request->address;
        $volunteer->email = $request->email;
        $volunteer->phone = $request->phone;
        $volunteer->website = $request->website;
        $volunteer->facebook = $request->facebook;
        $volunteer->twitter = $request->twitter;
        $volunteer->linkedin = $request->linkedin;
        $volunteer->instagram = $request->instagram;
        $volunteer->detail = $request->detail;
        $final_name = 'volunteer_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);
        $volunteer->photo = $final_name;
        $volunteer->save();

        return redirect()->route('admin_volunteer_index')->with('success','Volunteer created successfully');
    }

    public function edit($id)
    {
        $volunteer = Volunteer::findOrFail($id);
        return view('admin.volunteer.edit', compact('volunteer'));
    }

    public function edit_submit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'profession' => 'required',
        ]);

        $volunteer = Volunteer::findOrFail($id);

        if($request->photo != null) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png',
            ]);
            unlink(public_path('uploads/'.$volunteer->photo));

            $final_name = 'volunteer_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $volunteer->photo = $final_name;
        }

        $volunteer->name = $request->name;
        $volunteer->profession = $request->profession;
        $volunteer->address = $request->address;
        $volunteer->email = $request->email;
        $volunteer->phone = $request->phone;
        $volunteer->website = $request->website;
        $volunteer->facebook = $request->facebook;
        $volunteer->twitter = $request->twitter;
        $volunteer->linkedin = $request->linkedin;
        $volunteer->instagram = $request->instagram;
        $volunteer->detail = $request->detail;
        $volunteer->update();

        return redirect()->route('admin_volunteer_index')->with('success','Volunteer updated successfully');
    }

    public function delete($id)
    {
        $volunteer = Volunteer::findOrFail($id);
        unlink(public_path('uploads/'.$volunteer->photo));
        $volunteer->delete();

        return redirect()->back()->with('success','Volunteer deleted successfully');
    }
}
