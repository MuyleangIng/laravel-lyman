<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function subscriber_submit(Request $request) 
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers'
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->token = md5(time().$request->email);
        $subscriber->status = 0;
        $subscriber->save();

        $subject = "Subscriber Verification";
        $message = "Please verify your email address by clicking on the following link:<br><br>";
        $message .= "<a href='".route('subscriber_verify',[$request->email,$subscriber->token])."'>".route('subscriber_verify',[$request->email,$subscriber->token])."</a><br><br>";

        Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'An email has been sent to you, Please check and verify your email');
    }

    public function subscriber_verify($email,$token)
    {
        $subscriber = Subscriber::where('email',$email)->where('token',$token)->first();
        if($subscriber)
        {
            $subscriber->status = 1;
            $subscriber->token = '';
            $subscriber->save();
            
            return redirect()->route('home')->with('success','Your email has been verified successfully');
        }
        else
        {
            return redirect()->route('home')->with('error','Invalid email or token');
        }
    }
}
