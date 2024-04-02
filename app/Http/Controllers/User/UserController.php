<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Cause;
use App\Models\CauseDonation;
use Auth;
use Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        $total_ticket = 0;
        $total_ticket_price = 0;
        $event_ticket_data = EventTicket::where('user_id',auth()->user()->id)->get();
        foreach($event_ticket_data as $item) {
            $total_ticket += $item->number_of_tickets;
            $total_ticket_price += $item->total_price;
        }


        $total_donation_price = 0;
        $donation_data = CauseDonation::where('user_id',auth()->user()->id)->get();
        foreach($donation_data as $item) {
            $total_donation_price += $item->price;
        }


        return view('user.dashboard', compact('total_ticket', 'total_ticket_price', 'total_donation_price'));
    }

    public function profile()
    {
        return view('user.profile');
    }
    public function profile_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user_data = User::find(Auth::guard('web')->user()->id);

        if($request->photo != null) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png',
            ]);
            
            if(Auth::guard('web')->user()->photo != null) {
                unlink(public_path('uploads/'.Auth::guard('web')->user()->photo));
            }

            $final_name = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $user_data->photo = $final_name;
        }

        if($request->password != '' || $request->password_confirmation != '') {
            $request->validate([
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
            ]);
            $user_data->password = Hash::make($request->password);
        }

        $user_data->name = $request->name;
        $user_data->email = $request->email;
        $user_data->update();

        return redirect()->back()->with('success','Profile updated successfully');
    }

    public function tickets()
    {
        $event_tickets = EventTicket::where('user_id', auth()->user()->id)->where('payment_status', 'COMPLETED')->get();
        return view('user.event.tickets', compact('event_tickets'));
    }

    public function ticket_invoice($id)
    {
        $ticket_data = EventTicket::findOrFail($id);
        return view('user.event.invoice', compact('ticket_data'));
    }


    public function donations()
    {
        $donations = CauseDonation::where('user_id', auth()->user()->id)->where('payment_status', 'COMPLETED')->get();
        return view('user.cause.donations', compact('donations'));
    }

    public function donation_invoice($id)
    {
        $donation_data = CauseDonation::findOrFail($id);
        return view('user.cause.invoice', compact('donation_data'));
    }
}
