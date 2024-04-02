<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cause;
use App\Models\CausePhoto;
use App\Models\CauseVideo;
use App\Models\CauseFaq;
use App\Models\CauseDonation;
use App\Models\Admin;
use App\Mail\Websitemail;
use App\Models\User;
use Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CauseController extends Controller
{
    public function index()
    {
        $causes = Cause::get();
        return view('front.causes', compact('causes'));
    }

    public function detail($slug)
    {
        $cause = Cause::where('slug', $slug)->first();
        $cause_photos = CausePhoto::where('cause_id',$cause->id)->get();
        $cause_videos = CauseVideo::where('cause_id',$cause->id)->get();
        $cause_faqs = CauseFaq::where('cause_id',$cause->id)->get();
        $recent_causes = Cause::orderBy('id', 'desc')->take(5)->get();
        return view('front.cause', compact('cause', 'cause_photos', 'cause_videos', 'cause_faqs', 'recent_causes'));
    }

    public function send_message(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        $admin_data = Admin::where('id',1)->first();
        $admin_email = $admin_data->email;

        $cause_data = Cause::where('id',$request->cause_id)->first();

        $subject = "Message from visitor for Cause - ".$cause_data->name;
        $message = "<b>Visitor Information:</b><br><br>";
        $message .= "Name: ".$request->name."<br>";
        $message .= "Email: ".$request->email."<br>";
        $message .= "Phone: ".$request->phone."<br>";
        $message .= "Message: ".$request->message."<br><br>";
        $message .= "<b>Cause Page URL: </b><br>";
        $message .= "<a href='".url('/cause/'.$cause_data->slug)."'>".url('/cause/'.$cause_data->slug)."</a>";

        \Mail::to($admin_email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','Message sent successfully');
    }



    public function payment(Request $request)
    {
        if(!auth()->user()) {
            return redirect()->route('login');
        }

        $request->validate([
            'price' => ['required', 'numeric', 'min:1'],
            'payment_method' => 'required'
        ]);

        $cause_data = Cause::where('id',$request->cause_id)->first();
        $needed_amount = $cause_data->goal - $cause_data->raised;

        if($request->price > $needed_amount) {
            return redirect()->back()->with('error','You can not donate more than needed amount');
        }

        if($request->payment_method == 'paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('donation_paypal_success'),
                    "cancel_url" => route('donation_cancel')
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $request->price
                        ]
                    ]
                ]
            ]);
            //dd($response);
            if(isset($response['id']) && $response['id']!=null) {
                foreach($response['links'] as $link) {
                    if($link['rel'] === 'approve') {
                        session()->put('cause_id', $request->cause_id);
                        session()->put('price', $request->price);
                        return redirect()->away($link['href']);
                    }
                }
            } else {
                return redirect()->route('donation_cancel');
            }
        }

        if($request->payment_method == 'stripe') {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $cause_data->name,
                            ],
                            'unit_amount' => $request->price*100,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('donation_stripe_success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('donation_cancel'),
            ]);
            //dd($response);
            if(isset($response->id) && $response->id != ''){
                session()->put('cause_id', $request->cause_id);
                session()->put('price', $request->price);
                return redirect($response->url);
            } else {
                return redirect()->route('donation_cancel');
            }
        } 
    }


    public function paypal_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        //dd($response);
        if(isset($response['status']) && $response['status'] == 'COMPLETED') {
            
            // Insert data into database
            $obj = new CauseDonation;
            $obj->cause_id = session()->get('cause_id');
            $obj->user_id = auth()->user()->id;
            $obj->price = session()->get('price');
            $obj->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $obj->payment_id = $response['id'];
            $obj->payment_method = "PayPal";
            $obj->payment_status = $response['status'];
            $obj->save();

            $cause_data = Cause::where('id',session()->get('cause_id'))->first();
            $cause_data->raised = $cause_data->raised + session()->get('price');
            $cause_data->update();

            unset($_SESSION['cause_id']);
            unset($_SESSION['price']);

            return redirect()->route('cause',$cause_data->slug)->with('success','Payment completed successfully');

        } else {
            return redirect()->route('donation_cancel');
        }
    }


    public function stripe_success(Request $request)
    {
        if(isset($request->session_id)) {

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
            //dd($response);

            // Insert data into database
            $obj = new CauseDonation;
            $obj->cause_id = session()->get('cause_id');
            $obj->user_id = auth()->user()->id;
            $obj->price = session()->get('price');
            $obj->currency = $response->currency;
            $obj->payment_id = $response->id;
            $obj->payment_method = "Stripe";
            $obj->payment_status = "COMPLETED";
            $obj->save();

            $cause_data = Cause::where('id',session()->get('cause_id'))->first();
            $cause_data->raised = $cause_data->raised + session()->get('price');
            $cause_data->update();

            unset($_SESSION['cause_id']);
            unset($_SESSION['price']);

            return redirect()->route('cause', $cause_data->slug)->with('success','Payment completed successfully');

        } else {
            return redirect()->route('donation_cancel');
        }
    }

    public function cancel()
    {
        return redirect()->route('home')->with('error','Payment is cancelled');
    }
}
