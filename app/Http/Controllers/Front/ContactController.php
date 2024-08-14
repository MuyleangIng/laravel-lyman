<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact');
    }

    public function send_message(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $admin_data = Admin::where('id',1)->first();

        $subject = "Contact Form";
        $message = "Visitor Information: <br><br>";
        $message .= "Name: <br>".$request->name."<br><br>";
        $message .= "Email: <br>".$request->email."<br><br>";
        $message .= "Message: <br>".$request->message."<br><br>";

        Mail::to($admin_data->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','Message sent successfully');
    }

}
