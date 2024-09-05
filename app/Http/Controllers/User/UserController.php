<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Cause;
use App\Models\Message;
use App\Models\CauseFaq;
use App\Models\CausePhoto;
use App\Models\CauseVideo;
use App\Models\EventTicket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CauseDonation;
use App\Http\Controllers\Controller;
use App\Models\CausePartnershipAndCollaboration;
use App\Models\CauseTargetAudience;
use App\Models\PartnershipAndCollaborationCategory;
use App\Models\TargetAudienceCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GeminiAPI\Laravel\Facades\Gemini;
use Telegram\Bot\Laravel\Facades\Telegram;

class UserController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->user()->id;

        // Calculate total tickets purchased and their price
        $total_ticket = EventTicket::where('user_id', $userId)->sum('number_of_tickets');
        $total_ticket_price = EventTicket::where('user_id', $userId)->sum('total_price');

        // Calculate total donations made
        $total_donation_made = CauseDonation::where('user_id', $userId)->sum('price');

        // Calculate total donations received
        $total_donation_received = CauseDonation::whereHas('cause', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('payment_status', 'COMPLETED')->sum('price');

        return view('user.dashboard', compact('total_ticket', 'total_ticket_price', 'total_donation_made', 'total_donation_received'));
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


    public function donationsReceived()
    {
        $receivedDonations = CauseDonation::whereHas('cause', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->where('payment_status', 'COMPLETED')->paginate(10);

        return view('user.cause.donations_received', compact('receivedDonations'));
    }

    public function donationsReceivedInvoice()
    {
        $user = auth()->user();
        $receivedDonations = CauseDonation::whereHas('cause', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->where('payment_status', 'COMPLETED')
        ->with('cause')
        ->get();

        return view('user.cause.invoice_received', compact('receivedDonations'));
    }


    public function donationsMade()
    {
        $madeDonations = CauseDonation::where('user_id', auth()->user()->id)
                                    ->where('payment_status', 'COMPLETED')
                                    ->with('cause') // Eager load the related Cause model
                                    ->paginate(10);

        return view('user.cause.donations_made', compact('madeDonations'));
    }

    public function donationsMadeInvoice()
    {
        $user = auth()->user();
        $donationsMade = CauseDonation::where('user_id', $user->id)
                                    ->where('payment_status', 'COMPLETED')
                                    ->with('cause')
                                    ->get();

        return view('user.cause.invoice_made', compact('donationsMade'));
    }


    public function donation_invoice($id)
    {
        $donation_data = CauseDonation::findOrFail($id);
        return view('user.cause.invoice', compact('donation_data'));
    }

    public function causes(){

        $user = Auth::user();
        $causes = Cause::where('user_id', $user->id)->get();
        
        return view('user.cause.index', compact('causes'));
    }

    public function create()
    {
        $targetAudiences = TargetAudienceCategory::all();
        $partnerships = PartnershipAndCollaborationCategory::all();

        return view('user.cause.create', compact('targetAudiences', 'partnerships'));
    }



    public function createCauseSubmit(Request $request)
    {
        // Check if the user is blocked
        $user = Auth::user();
        if ($user->block == 1) {
            return redirect()->back()->with('error', 'You are blocked and cannot create a cause.');
        }
        // dd($request->all());
        // Validate the required fields
        $request->validate([
            'name' => ['required'],
            'goal' => ['required', 'numeric', 'min:1'],
            'short_description' => 'required',
            'objective' => 'required',
            'expectations' => 'required',
            'legal_considerations' => 'nullable',
            'challenges_and_solution' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'supporting_documents.*' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
            'target_audience.*' => 'exists:target_audience_categories,id', 
            'partnerships_and_collaborations.*' => 'exists:partnership_and_collaboration_categories,id',
            'is_featured' => 'required'
        ]);

        // Create and save the new cause
        $obj = new Cause();
        $obj->name = $request->name;
        $obj->slug = Str::slug($request->name);
        $obj->goal = $request->goal;
        $obj->raised = 0;
        $obj->short_description = $request->short_description;
        $obj->objective = $request->objective;
        $obj->expectations = $request->expectations;
        $obj->legal_considerations = $request->legal_considerations;
        $obj->challenges_and_solution = $request->challenges_and_solution;
        $obj->start_date = $request->start_date;
        $obj->end_date = $request->end_date;
        $obj->is_featured = $request->is_featured;
        $obj->user_id = Auth::id();

        // Handle file uploads for supporting documents
        if ($request->hasFile('supporting_documents')) {
            $files = $request->file('supporting_documents');
            $filePaths = [];
            foreach ($files as $file) {
                $fileName = 'supporting_document_' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/supporting_documents'), $fileName);
                $filePaths[] = $fileName;
            }
            $obj->supporting_documents = json_encode($filePaths);
        }

         // Handle the featured photo
        if($request->featured_photo != null) {
            $request->validate([
                'featured_photo' => 'image|mimes:jpg,jpeg,png',
            ]);

            $final_name = 'cause_featured_photo_'.time().'.'.$request->featured_photo->extension();
            $request->featured_photo->move(public_path('uploads'), $final_name);
            $obj->featured_photo = $final_name;
        }

        $obj->save();

        // Handle target audience categories (pivot table entries)
        if ($request->has('target_audience')) {
            // $obj->targetAudienceCategories()->attach($request->target_audience_categories);
            // dd($request->target_audience_categories);
            foreach($request->target_audience as $ret)
            {
                $target = new CauseTargetAudience();
                $target->cause_id = $obj->id;
                $target->target_audience_category_id = $ret;
                $target->save();
            }
        }

        // Handle partnerships and collaborations
        if ($request->has('partnerships_and_collaborations')) {
            foreach($request->partnerships_and_collaborations as $ret)
            {
                $target = new CausePartnershipAndCollaboration();
                $target->cause_id = $obj->id;
                $target->partnership_id = $ret;
                $target->save();
            }
        }

        $this->sendTelegramAlert($request);

        // Redirect with success message
        return redirect()->route('user_cause')->with('success', 'Cause created successfully');
    }


    function sendTelegramAlert(Request $request)
    {
        $channelId = config('services.telegram.channel_id');
        $message = "📢 A new project has been submitted:\n\n";
        $message .= "📝 <b>Name:</b> " . $request->input('name') . "\n";
        $message .= "🎯 <b>Goal:</b> " . $request->input('goal') . "\n";
        $message .= "✍️ <b>Short Description:</b> " . $request->input('short_description') . "\n";
        $message .= "🎯 <b>Objective:</b> " . $request->input('objective') . "\n";
        $message .= "🔍 <b>Expectations:</b> " . $request->input('expectations') . "\n";
        $message .= "📅 <b>Start Date:</b> " . $request->input('start_date') . "\n";
        $message .= "📅 <b>End Date:</b> " . $request->input('end_date') . "\n";

        Telegram::sendMessage([
            'chat_id' => $channelId,
            'text'    => $message,
            'parse_mode' => 'HTML',
        ]);
    }



    public function edit($id)
    {
        $cause = Cause::findOrFail($id);
        return view('user.cause.edit', compact('cause'));
    }

    public function edit_submit(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'unique:causes,name,'.$id],
            'slug' => ['required', 'alpha_dash', 'unique:causes,slug,'.$id],
            'goal' => ['required', 'numeric', 'min:1'],
            'short_description' => 'required',
            'description' => 'required',
        ]);

        $obj = Cause::findOrFail($id);

        if($request->featured_photo != null) {
            $request->validate([
                'featured_photo' => 'image|mimes:jpg,jpeg,png',
            ]);
            unlink(public_path('uploads/'.$obj->featured_photo));

            $final_name = 'cause_featured_photo_'.time().'.'.$request->featured_photo->extension();
            $request->featured_photo->move(public_path('uploads'), $final_name);
            $obj->featured_photo = $final_name;
        }

        $obj->name = $request->name;
        $obj->slug = strtolower($request->slug);
        $obj->goal = $request->goal;
        $obj->short_description = $request->short_description;
        $obj->description = $request->description;
        $obj->is_featured = $request->is_featured;
        $obj->update();

        return redirect()->route('user_cause')->with('success','Cause updated successfully');
    }

    public function delete($id)
    {
        $cause = Cause::findOrFail($id);
        unlink(public_path('uploads/'.$cause->featured_photo));
        $cause->delete();

        return redirect()->back()->with('success','Cause deleted successfully');
    }

    public function photo($id)
    {
        $cause_single = Cause::findOrFail($id);
        $cause_photos = CausePhoto::where('cause_id', $id)->get();
        return view('user.cause.photo', compact('cause_single', 'cause_photos'));
    }

    public function photo_submit(Request $request)
    {
        $request->validate([
            'cause_id' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $obj = new CausePhoto();
        $obj->cause_id = $request->cause_id;
        $final_name = 'cause_photo_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);
        $obj->photo = $final_name;
        $obj->save();

        return redirect()->back()->with('success','Cause photo created successfully');
    }

    public function photo_delete($id)
    {
        $cause_photo = CausePhoto::findOrFail($id);
        unlink(public_path('uploads/'.$cause_photo->photo));
        $cause_photo->delete();

        return redirect()->back()->with('success','Cause photo deleted successfully');
    }


    public function video($id)
    {
        $cause_single = Cause::findOrFail($id);
        $cause_videos = CauseVideo::where('cause_id', $id)->get();
        return view('user.cause.video', compact('cause_single', 'cause_videos'));
    }

    public function video_submit(Request $request)
    {
        $request->validate([
            'cause_id' => 'required',
            'youtube_video_id' => 'required',
        ]);

        $obj = new CauseVideo();
        $obj->cause_id = $request->cause_id;
        $obj->youtube_video_id = $request->youtube_video_id;
        $obj->save();

        return redirect()->back()->with('success','Cause Video created successfully');
    }

    public function video_delete($id)
    {
        $cause_video = CauseVideo::findOrFail($id);
        $cause_video->delete();

        return redirect()->back()->with('success','Cause Video deleted successfully');
    }


    public function faq($id)
    {
        $cause_single = Cause::findOrFail($id);
        $cause_faqs = CauseFaq::where('cause_id', $id)->get();
        return view('user.cause.faq', compact('cause_single', 'cause_faqs'));
    }

    public function faq_submit(Request $request)
    {
        $request->validate([
            'cause_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);

        $obj = new CauseFaq();
        $obj->cause_id = $request->cause_id;
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        $obj->save();

        return redirect()->back()->with('success','Cause FAQ created successfully');
    }

    public function faq_delete($id)
    {
        $cause_faq = CauseFaq::findOrFail($id);
        $cause_faq->delete();

        return redirect()->back()->with('success','Cause FAQ deleted successfully');
    }

    public function faq_update(Request $request, $id) 
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $obj = CauseFaq::findOrFail($id);
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        $obj->update();

        return redirect()->back()->with('success','Cause FAQ updated successfully');
    }

    public function reply_comment(){
        return view('user.reply_comment.index');
    }


    // Method to list all messages
    public function listMessages()
    {
        $messages = Message::all();
        return view('user.message.list', ['messages' => $messages]);
    }

    // Method to store a new message
    public function storeMessage(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'message' => 'required|string',
        ]);

        // Create a new message using the validated data
        $message = new Message();
        $message->message = $validatedData['message'];
        $message->user_id = auth()->user()->id;
        $message->save();

        // Send the message to Gemini and get the response
        try {
            $apiKey = config('services.gemini.api_key'); // Fetch the API key
            $response = Gemini::geminiPro()->generateContent($validatedData['message'], $apiKey);
            $responseText = $response->text();

            // Save the response as a new message from the chatbot
            $chatbotMessage = new Message();
            $chatbotMessage->message = $responseText;
            $chatbotMessage->user_id = null; // Assuming null indicates the message is from the chatbot
            $chatbotMessage->save();

        } catch (\Exception $e) {
            dd($e->getMessage());
            // Handle exception
            return redirect()->route('user_message_list')->with('error', 'An error occurred while communicating with the chatbot.');
        }

        // Redirect back to the message list with a success message
        return redirect()->route('user_message_list');
    }

    
}
