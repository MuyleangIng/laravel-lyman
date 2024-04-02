<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;

class AdminFeatureController extends Controller
{
    public function index()
    {
        $features = Feature::all();
        return view('admin.feature.index', compact('features'));
    }

    public function create()
    {
        return view('admin.feature.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'heading' => 'required',
            'text' => 'required',
        ]);

        $feature = new Feature();
        $feature->icon = $request->icon;
        $feature->heading = $request->heading;
        $feature->text = $request->text;
        $feature->save();

        return redirect()->route('admin_feature_index')->with('success','Feature is created successfully');
    }

    public function edit($id)
    {
        $feature = Feature::findOrFail($id);
        return view('admin.feature.edit', compact('feature'));
    }

    public function edit_submit(Request $request, $id)
    {
        $request->validate([
            'icon' => 'required',
            'heading' => 'required',
            'text' => 'required'
        ]);

        $feature = Feature::findOrFail($id);
        $feature->icon = $request->icon;
        $feature->heading = $request->heading;
        $feature->text = $request->text;
        $feature->update();

        return redirect()->route('admin_feature_index')->with('success','Feature is updated successfully');
    }

    public function delete($id)
    {
        Feature::findOrFail($id)->delete();

        return redirect()->back()->with('success','Feature is deleted successfully');
    }
}
