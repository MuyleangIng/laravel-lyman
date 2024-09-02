<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cause;
use App\Models\CausePhoto;
use App\Models\CauseVideo;
use App\Models\CauseFaq;
use App\Models\CauseDonation;
use App\Models\CauseComment;
use App\Mail\Websitemail;
use App\Models\CauseReply;
use App\Models\User;
use App\Services\PayWayService;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class CauseController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        // Check if there's a search query
        if ($query) {
            $causes = Cause::where('status', 'approve')
                            ->where('name', 'like', "%$query%")
                            ->get();
        } else {
            // If no search query, retrieve all approved causes
            $causes = Cause::where('status', 'approve')->get();
        }

        return view('front.causes', compact('causes'));
    }

    public function detail($slug)
    {
        // Fetch the cause based on the slug
        $cause = Cause::where('slug', $slug)->with(['targetAudiences', 'partnershipsAndCollaborations'])->firstOrFail();
        
        // Fetch related photos, videos, and FAQs
        $cause_photos = CausePhoto::where('cause_id', $cause->id)->get();
        $cause_videos = CauseVideo::where('cause_id', $cause->id)->get();
        $cause_faqs = CauseFaq::where('cause_id', $cause->id)->get();
        
        // Fetch recent causes
        $recent_causes = Cause::orderBy('id', 'desc')->take(5)->get();
        
        // Fetch comments with their nested replies related to the cause
        $comments = CauseComment::with(['replies.children'])->where('cause_id', $cause->id)
                                ->orderBy('created_at', 'desc')
                                ->get();
        
        // Pass all data to the view
        return view('front.cause', compact('cause', 'cause_photos', 'cause_videos', 'cause_faqs', 'recent_causes', 'comments'));
    }
    

    public function send_message(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to comment.');
        }

        $request->validate([
            'cause_id' => 'required|exists:causes,id',
            'message' => 'required'
        ]);

        // Fetch the logged-in user
        $user = auth()->user();

        // Fetch the cause details
        $cause_data = Cause::where('id', $request->cause_id)->first();

        // Check if the cause belongs to the logged-in user
        if ($cause_data->user_id == $user->id) {
            return redirect()->back()->with('error', 'You cannot comment on your own cause.');
        }

        // Fetch the cause creator's email
        $cause_creator = User::where('id', $cause_data->user_id)->first();
        $creator_email = $cause_creator->email;

        // Prepare email content
        $subject = "Message from visitor for Cause - " . $cause_data->name;
        $message = "<b>Visitor Information:</b><br><br>";
        $message .= "Name: " . $user->name . "<br>";

        // Generate photo URL
        $photo_url = $user->photo ? asset('uploads/' . $user->photo) : asset('uploads/default.png');
        $message .= "Photo: <img src='" . $photo_url . "' alt='User Photo' style='width:100px;'><br>";

        $message .= "Message: " . $request->message . "<br><br>";
        $message .= "<b>Cause Page URL: </b><br>";
        $message .= "<a href='" . url('/cause/' . $cause_data->slug) . "'>" . url('/cause/' . $cause_data->slug) . "</a>";

        // Send email to the cause creator
        Mail::to($creator_email)->send(new Websitemail($subject, $message));

        // Save the comment to the database
        CauseComment::create([
            'cause_id' => $request->cause_id,
            'user_id' => $user->id, // Store the user ID instead of name and photo
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Message sent successfully');
    }
    

    protected $payWayService;

    public function __construct(PayWayService $payWayService)
    {
        $this->payWayService = $payWayService;
    }

    public function payment(Request $request)
    {
        // Check if the user is logged in and is not blocked
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        if (auth()->user()->block == 1) {
            return redirect()->back()->with('error', 'You are blocked and cannot make a payment.');
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
            // PayPal logic (existing)
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
            // Stripe logic (existing)
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

            if(isset($response->id) && $response->id != ''){
                session()->put('cause_id', $request->cause_id);
                session()->put('price', $request->price);
                return redirect($response->url);
            } else {
                return redirect()->route('donation_cancel');
            }
        }

        if($request->payment_method == 'payway') {
            $item = [
                ['name' => $cause_data->name, 'quantity' => '1', 'price' => $request->price]
            ];

            $items = base64_encode(json_encode($item));
            $req_time = time();
            $transactionId = $req_time; 
            $amount = $request->price;
            $firstName = auth()->user()->first_name;
            $lastName = auth()->user()->last_name;
            $phone = auth()->user()->phone;
            $email = auth()->user()->email;
            $return_params = 'Thank you for your donation!';
            $type = 'purchase';
            $currency = 'USD';
            $shipping = '0.00';
            $merchant_id = config('payway.merchant_id');
            $payment_option = '';

            $hash = $this->payWayService->getHash(
                $req_time . $merchant_id . $transactionId . $amount . $items . $shipping .
                $firstName . $lastName . $email . $phone . $type . $payment_option .
                $currency . $return_params
            );
            
            return response()->json([
                // 'success' => true,
                'hash' => $hash,
                'transactionId' => $transactionId,
                'amount' => $amount,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'phone' => $phone,
                'email' => $email,
                'items' => $items,
                'return_params' => $return_params,
                'shipping' => $shipping,
                'currency' => $currency,
                'type' => $type,
                'payment_option' => $payment_option,
                'merchant_id' => $merchant_id,
                'req_time' => $req_time,
                'api_url' => config('payway.api_url')
            ]);
        }
    }

    public function payway_success(Request $request)
    {
        
        $cause_data = Cause::where('id', session()->get('cause_id'))->first();
        $cause_data->raised = $cause_data->raised + session()->get('price');
        $cause_data->update();

        unset($_SESSION['cause_id']);
        unset($_SESSION['price']);

        return redirect()->route('cause', $cause_data->slug)->with('success', 'Payment completed successfully via Payway');
    }


    public function paypal_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        // dd($response);
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
            // dd($response);

            // Insert data into database
            $obj = new CauseDonation;
            $obj->cause_id = session()->get('cause_id');
            $obj->user_id = auth()->user()->id;
            $obj->price = session()->get('price');
            $obj->currency = $response->currency;
            $obj->payment_id = $response->payment_intent;
            $obj->payment_method = "Stripe";
            $obj->payment_status = "COMPLETED";
            $obj->save();

            $cause_data = Cause::where('id',session()->get('cause_id'))->first();
            $cause_data->raised = $cause_data->raised + session()->get('price');
            $cause_data->update();
  
            unset($_SESSION['cause_id']);
            unset($_SESSION['price']);
            session()->put('payment_success', true);

            return redirect()->route('cause', $cause_data->slug);

        } else {
            return redirect()->route('donation_cancel');
        }
    }


    public function cancel()
    {
        return redirect()->route('home')->with('error','Payment is cancelled');
    }


    public function store(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|exists:cause_comments,id',
            'reply' => 'required|string',
            'parent_id' => 'nullable|exists:cause_replies,id',
        ]);

        // Fetch the logged-in user
        $user = Auth::user();

        // Fetch the comment details
        $comment = CauseComment::findOrFail($request->comment_id);

        // Ensure the user is the owner of the cause related to the comment
        $cause = $comment->cause; // Assuming `cause` is a relationship on CauseComment model

        // Save the reply to the database
        $causeReply = new CauseReply();
        $causeReply->user_id = $user->id; // Store the user ID instead of name and photo
        $causeReply->comment_id = $request->comment_id;
        $causeReply->reply = $request->reply;
        $causeReply->parent_id = $request->parent_id;
        $causeReply->save();

        return redirect()->back()->with('success', 'Reply sent successfully');
    }



    public function deleteCommentOrReply($id, $type)
    {
        $user = auth()->user(); // Get the currently authenticated user

        if ($type === 'comment') {
            $comment = CauseComment::findOrFail($id);

            // Check if the current user is the owner of the comment
            if ($comment->user_id !== $user->id) {
                return back()->with('error', 'Only the comment owner can be able to delete the comment.');
            }

            // Delete the comment and its replies
            $comment->replies()->delete(); // Delete all replies associated with the comment
            $comment->delete(); // Delete the comment

            return back()->with('success', 'Comment and its replies deleted successfully.');

        } elseif ($type === 'reply') {
            $reply = CauseReply::findOrFail($id);

            // Check if the current user is the owner of the reply
            if ($reply->user_id !== $user->id) {
                return back()->with('error', 'You do not have permission to delete this reply.');
            }

            // Delete the reply
            $reply->delete();

            return back()->with('success', 'Reply deleted successfully.');
        } else {
            return back()->with('error', 'Invalid deletion type specified.');
        }
    }




    public function updateCommentOrReply(Request $request, $id, $type)
    {
        $user = auth()->user(); // Get the currently authenticated user

        if ($type === 'comment') {
            $comment = CauseComment::findOrFail($id);

            // Check if the current user is the owner of the comment
            if ($comment->user_id !== $user->id) {
                return back()->with('error', 'You do not have permission to edit this comment.');
            }

            $request->validate([
                'message' => 'required|string',
            ]);

            $comment->update([
                'message' => $request->input('message'),
            ]);

            return back()->with('success', 'Comment updated successfully.');
        } elseif ($type === 'reply') {
            $reply = CauseReply::findOrFail($id);

            // Check if the current user is the owner of the reply
            if ($reply->user_id !== $user->id) {
                return back()->with('error', 'You do not have permission to edit this reply.');
            }

            $request->validate([
                'reply' => 'required|string',
            ]);

            $reply->update([
                'reply' => $request->input('reply'),
            ]);

            return back()->with('success', 'Reply updated successfully.');
        } else {
            return back()->with('error', 'Invalid update type specified.');
        }
    }



}
