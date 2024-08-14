<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;

class AdminSubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::where('status',1)->get();
        return view('admin.subscriber.index', compact('subscribers'));
    }

    public function send_message()
    {
        return view('admin.subscriber.send_message');
    }

    public function send_message_submit(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);

        $subscribers = Subscriber::where('status',1)->get();

        $subject = $request->subject;
        $message = nl2br($request->content);

        foreach($subscribers as $subscriber){
            Mail::to($subscriber->email)->send(new Websitemail($subject,$message));
        }

        return redirect()->back()->with('success', 'Message sent successfully');
    }

    public function delete($id)
    {
        $subscriber = Subscriber::find($id);
        $subscriber->delete();
        return redirect()->back()->with('success', 'Subscriber deleted successfully');
    }
}
