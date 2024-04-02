<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counter;

class AdminCounterController extends Controller
{
    public function edit()
    {
        $counter = Counter::where('id',1)->first();
        return view('admin.counter.edit', compact('counter'));
    }

    public function edit_submit(Request $request)
    {
        $request->validate([
            'counter1_number' => 'required',
            'counter1_name' => 'required',
            'counter2_number' => 'required',
            'counter2_name' => 'required',
            'counter3_number' => 'required',
            'counter3_name' => 'required',
            'counter4_number' => 'required',
            'counter4_name' => 'required'
        ]);

        $counter = Counter::where('id',1)->first();
        $counter->counter1_number = $request->counter1_number;
        $counter->counter1_name = $request->counter1_name;
        $counter->counter2_number = $request->counter2_number;
        $counter->counter2_name = $request->counter2_name;
        $counter->counter3_number = $request->counter3_number;
        $counter->counter3_name = $request->counter3_name;
        $counter->counter4_number = $request->counter4_number;
        $counter->counter4_name = $request->counter4_name;
        $counter->status = $request->status;
        $counter->update();

        return redirect()->back()->with('success','Counter section updated successfully');
    }
}
