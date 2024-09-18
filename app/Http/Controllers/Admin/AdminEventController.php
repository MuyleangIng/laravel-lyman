<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\EventVideo;
use App\Models\EventTicket;
use App\Models\User;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:events'],
            'slug' => ['required', 'alpha_dash', 'unique:events'],
            'location' => 'required',
            'date' => 'required',
            'time' => 'required',
            'price' => ['required', 'numeric', 'min:0'],
            'short_description' => 'required',
            'description' => 'required',
            'featured_photo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        if($request->total_seat != '') {
            $request->validate([
                'total_seat' => ['numeric', 'min:1'],
            ]);
        }

        $obj = new Event();
        $obj->name = $request->name;
        $obj->slug = $request->slug;
        $obj->location = $request->location;
        $obj->date = $request->date;
        $obj->time = $request->time;
        $obj->price = $request->price;
        $obj->short_description = $request->short_description;
        $obj->description = $request->description;
        $obj->total_seat = $request->total_seat;
        $final_name = 'event_featured_photo_'.time().'.'.$request->featured_photo->extension();
        $request->featured_photo->move(public_path('uploads'), $final_name);
        $obj->featured_photo = $final_name;
        $obj->save();

        return redirect()->route('admin_event_index')->with('success','Event created successfully');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.event.edit', compact('event'));
    }

    public function edit_submit(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'name' => ['required', 'unique:events,name,'.$id],
            'slug' => ['required', 'alpha_dash', 'unique:events,slug,'.$id],
            'location' => 'required',
            'date' => 'required',
            'time' => 'required',
            'price' => ['required', 'numeric', 'min:0'],
            'short_description' => 'required',
            'description' => 'required',
        ]);
    
        // Validate total_seat if present
        if ($request->total_seat != '') {
            $request->validate([
                'total_seat' => ['numeric', 'min:1'],
            ]);
        }
    
        // Find the event
        $event = Event::findOrFail($id);
    
        // Handle featured photo upload
        if ($request->hasFile('featured_photo')) {
            $request->validate([
                'featured_photo' => 'image|mimes:jpg,jpeg,png',
            ]);
    
            // Check if the old photo exists and delete it
            $oldPhotoPath = public_path('uploads/'.$event->featured_photo);
            if (file_exists($oldPhotoPath) && $event->featured_photo) {
                unlink($oldPhotoPath);
            }
    
            // Upload new photo
            $final_name = 'event_featured_photo_'.time().'.'.$request->featured_photo->extension();
            $request->featured_photo->move(public_path('uploads'), $final_name);
            $event->featured_photo = $final_name;
        }
    
        // Update event details
        $event->name = $request->name;
        $event->slug = $request->slug;
        $event->location = $request->location;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->price = $request->price;
        $event->short_description = $request->short_description;
        $event->description = $request->description;
        $event->total_seat = $request->total_seat;
        $event->save();
    
        return redirect()->back()->with('success', 'Event updated successfully');
    }
    

    public function delete($id)
    {
        $event = Event::findOrFail($id);
        unlink(public_path('uploads/'.$event->featured_photo));
        $event->delete();

        return redirect()->back()->with('success','Event deleted successfully');
    }

    public function photo($id)
    {
        $event_single = Event::findOrFail($id);
        $event_photos = EventPhoto::where('event_id', $id)->get();
        return view('admin.event.photo', compact('event_single', 'event_photos'));
    }

    public function photo_submit(Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $obj = new EventPhoto();
        $obj->event_id = $request->event_id;
        $final_name = 'event_photo_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);
        $obj->photo = $final_name;
        $obj->save();

        return redirect()->back()->with('success','Event photo created successfully');
    }

    public function photo_delete($id)
    {
        $event_photo = EventPhoto::findOrFail($id);
        unlink(public_path('uploads/'.$event_photo->photo));
        $event_photo->delete();

        return redirect()->back()->with('success','Event photo deleted successfully');
    }


    public function video($id)
    {
        $event_single = Event::findOrFail($id);
        $event_videos = EventVideo::where('event_id', $id)->get();
        return view('admin.event.video', compact('event_single', 'event_videos'));
    }

    public function video_submit(Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'youtube_video_id' => 'required',
        ]);

        $obj = new EventVideo();
        $obj->event_id = $request->event_id;
        $obj->youtube_video_id = $request->youtube_video_id;
        $obj->save();

        return redirect()->back()->with('success','Event Video created successfully');
    }

    public function video_delete($id)
    {
        $event_video = EventVideo::findOrFail($id);
        $event_video->delete();

        return redirect()->back()->with('success','Event Video deleted successfully');
    }


    public function tickets($id)
    {
        $event_single = Event::findOrFail($id);
        $event_tickets = EventTicket::where('event_id', $id)->where('payment_status', 'COMPLETED')->get();
        return view('admin.event.tickets', compact('event_single', 'event_tickets'));
    }

    public function ticket_invoice($id)
    {
        $ticket_data = EventTicket::findOrFail($id);
        $user_data = User::findOrFail($ticket_data->user_id);
        return view('admin.event.invoice', compact('ticket_data', 'user_data'));
    }
}
