<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CausesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cause;
use App\Models\CausePhoto;
use App\Models\CauseVideo;
use App\Models\CauseFaq;
use App\Models\CauseDonation;
use App\Models\CausePartnershipAndCollaboration;
use App\Models\CauseReport;
use App\Models\CauseTargetAudience;
use App\Models\CauseTargetRegion;
use App\Models\PartnershipAndCollaborationCategory;
use App\Models\TargetAudienceCategory;
use App\Models\TargetRegion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AdminCauseController extends Controller
{
    public function export()
    {
        return Excel::download(new CausesExport, 'causes.xlsx');
    }

    public function index()
    {
        $causes = Cause::all();
        return view('admin.cause.index', compact('causes'));
    }

    public function create()
    {
        $users = User::all();
        $targetAudiences = TargetAudienceCategory::all();
        $partnerships = PartnershipAndCollaborationCategory::all();
        return view('admin.cause.create', compact('users', 'targetAudiences', 'partnerships'));
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:causes'],
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
            'featured_photo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $obj = new Cause();
        $obj->user_id = $request->user_id;
        if (Auth::guard('admin')->check()) {
            $adminId = Auth::guard('admin')->id();
            $obj->approved_by = $adminId;
            $obj->status = 'approve';
        }    
        $obj->name = $request->name;
        $obj->slug = Str::slug($request->name);
        // $obj->slug = strtolower($request->slug);
        $obj->goal = $request->goal;
        $obj->raised = 0;
        $obj->short_description = $request->short_description;
        $final_name = 'cause_featured_photo_'.time().'.'.$request->featured_photo->extension();
        $request->featured_photo->move(public_path('uploads'), $final_name);
        $obj->objective = $request->objective;
        $obj->expectations = $request->expectations;
        $obj->legal_considerations = $request->legal_considerations;
        $obj->challenges_and_solution = $request->challenges_and_solution;
        $obj->start_date = $request->start_date;
        $obj->end_date = $request->end_date;
        $obj->featured_photo = $final_name;
        $obj->is_featured = $request->is_featured;  

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

        $obj->save();

         // Handle target audience categories (pivot table entries)
         if ($request->has('target_audience')) {
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
            // $obj->partnershipsAndCollaborations()->attach($request->partnerships_and_collaborations);
        }

        return redirect()->route('admin_cause_index')->with('success','Cause created successfully');
    }

    public function edit($id)
    {
        $targetAudiences = TargetAudienceCategory::all();
        $partnerships = PartnershipAndCollaborationCategory::all();
        $targetRegions = TargetRegion::all();
        $users = User::all(); 
        $cause = Cause::with(['targetAudiences', 'partnershipsAndCollaborations', 'targetRegions'])->findOrFail($id);
    
        // Fetch selected target audiences, partnerships, and target regions
        $selectedAudiences = $cause->targetAudiences->pluck('id')->toArray();
        $selectedPartnerships = $cause->partnershipsAndCollaborations->pluck('id')->toArray();
        $selectedRegions = $cause->targetRegions->pluck('id')->toArray();  // Add this line
    
        // Decode the JSON field 'supporting_documents' to an array if it exists
        $existingDocuments = $cause->supporting_documents ? json_decode($cause->supporting_documents, true) : [];
    
        // Passing the formatBytes function
        $formatBytes = function($bytes, $precision = 2) {
            $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    
            $bytes = max($bytes, 0);
            $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
            $pow = min($pow, count($units) - 1);
    
            $bytes /= (1 << (10 * $pow));
    
            return round($bytes, $precision) . ' ' . $units[$pow];
        };
    
        return view('admin.cause.edit', compact(
            'cause',
            'targetAudiences',
            'partnerships',
            'targetRegions',
            'selectedAudiences',
            'selectedPartnerships',
            'selectedRegions',  // Add this line
            'users',
            'existingDocuments',
            'formatBytes'
        ));
    }
    

    public function edit_submit(Request $request, $id)
    {
        // Validation rules
        $request->validate([
            'name' => ['required', 'unique:causes,name,'.$id],
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
            'target_region.*' => 'exists:target_regions,id',
            'featured_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // Find the existing cause
        $cause = Cause::findOrFail($id);
    
        // Update cause fields
        $cause->name = $request->name;
        $cause->slug = Str::slug($request->name);
        $cause->goal = $request->goal;
        $cause->short_description = $request->short_description;
        $cause->objective = $request->objective;
        $cause->expectations = $request->expectations;
        $cause->legal_considerations = $request->legal_considerations;
        $cause->challenges_and_solution = $request->challenges_and_solution;
        $cause->start_date = $request->start_date;
        $cause->end_date = $request->end_date;
        $cause->is_featured = $request->is_featured;
    
        // Handle new featured photo
        if ($request->hasFile('featured_photo')) {
            // Delete old photo if it exists
            if ($cause->featured_photo && file_exists(public_path('uploads/' . $cause->featured_photo))) {
                unlink(public_path('uploads/' . $cause->featured_photo));
            }
    
            // Save new featured photo
            $final_name = 'cause_featured_photo_' . time() . '.' . $request->featured_photo->extension();
            $request->featured_photo->move(public_path('uploads'), $final_name);
            $cause->featured_photo = $final_name;
        }
    
        // Update the cause
        $cause->save();
    
        // Update target audience categories
        CauseTargetAudience::where('cause_id', $id)->delete(); // Clear previous associations
        if ($request->has('target_audience')) {
            foreach ($request->target_audience as $audienceId) {
                $target = new CauseTargetAudience();
                $target->cause_id = $cause->id;
                $target->target_audience_category_id = $audienceId;
                $target->save();
            }
        }
    
        // Update partnerships and collaborations
        CausePartnershipAndCollaboration::where('cause_id', $id)->delete(); // Clear previous associations
        if ($request->has('partnerships_and_collaborations')) {
            foreach ($request->partnerships_and_collaborations as $partnershipId) {
                $partnership = new CausePartnershipAndCollaboration();
                $partnership->cause_id = $cause->id;
                $partnership->partnership_id = $partnershipId;
                $partnership->save();
            }
        }

        // Update target regions
        CauseTargetRegion::where('cause_id', $id)->delete(); // Clear previous associations
        if ($request->has('target_region')) {
            foreach ($request->target_region as $regionId) {
                $targetRegion = new CauseTargetRegion();
                $targetRegion->cause_id = $cause->id;
                $targetRegion->target_region_id = $regionId;
                $targetRegion->save();
            }
        }
    
        return redirect()->route('admin_cause_index')->with('success', 'Cause updated successfully');
    }


    public function updateDocuments(Request $request, $id)
    {
        // Fetch the cause by ID
        $cause = Cause::findOrFail($id);

        // Validate the incoming request
        $request->validate([
            'files.*' => 'required|mimes:pdf,doc,docx,txt,jpg,jpeg,png|max:2048', // Example validation
        ]);

        // Initialize an array to store file names
        $filePaths = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Store the uploaded file
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/supporting_documents'), $fileName);

                // Add file name to the array
                $filePaths[] = $fileName;
            }

            // Append new files to existing documents (if any)
            $existingDocuments = json_decode($cause->supporting_documents, true) ?? [];
            $allDocuments = array_merge($existingDocuments, $filePaths);

            // Update the 'supporting_documents' field in the database
            $cause->supporting_documents = json_encode($allDocuments);
            $cause->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Documents updated and saved successfully.');
    }


    public function removeDocument($causeId, $document)
    {
        // Fetch the cause by ID
        $cause = Cause::findOrFail($causeId);
    
        // Decode the JSON supporting documents array
        $documents = json_decode($cause->supporting_documents, true);
    
        // Find the document and remove it from the array
        if (($key = array_search($document, $documents)) !== false) {
            // Remove the document from the array
            unset($documents[$key]);
    
            // Update the supporting_documents field in the database
            $cause->supporting_documents = json_encode(array_values($documents));
            $cause->save();
    
            // Optionally delete the file from the storage
            $documentPath = public_path('uploads/supporting_documents/' . $document);
            if (file_exists($documentPath)) {
                unlink($documentPath);
            }
    
            return back()->with('success', 'Document removed successfully.');
        }
    
        return back()->with('error', 'Document not found.');
    }
    

    public function delete($id)
    {
        $cause = Cause::findOrFail($id);
    
        if ($cause->featured_photo && file_exists(public_path('uploads/' . $cause->featured_photo))) {
            unlink(public_path('uploads/' . $cause->featured_photo));
        }

        $cause->delete();
    
        return redirect()->back()->with('success', 'Cause deleted successfully');
    }
    

    public function photo($id)
    {
        $cause_single = Cause::findOrFail($id);
        $cause_photos = CausePhoto::where('cause_id', $id)->get();
        return view('admin.cause.photo', compact('cause_single', 'cause_photos'));
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
        return view('admin.cause.video', compact('cause_single', 'cause_videos'));
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
        return view('admin.cause.faq', compact('cause_single', 'cause_faqs'));
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

    public function donations($id)
    {
        $cause_single = Cause::findOrFail($id);
        $donations = CauseDonation::where('cause_id', $id)->where('payment_status', 'COMPLETED')->get();
        return view('admin.cause.donations', compact('cause_single', 'donations'));
    }

    public function donation_invoice($id)
    {
        $donation_data = CauseDonation::findOrFail($id);
        $user_data = User::findOrFail($donation_data->user_id);
        return view('admin.cause.invoice', compact('donation_data', 'user_data'));
    }

    //Update proposal status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approve,reject',
        ]);

        $cause = Cause::findOrFail($id);
        $cause->status = $request->status;
        $cause->save();

        return redirect()->back()->with('success', 'Cause status updated successfully');
    }

    public function approval()
    {
        $causes = Cause::all();
        return view('admin.cause.approval', compact('causes'));
    }

    public function undoReject($id)
    {
        $cause = Cause::findOrFail($id);

        // Check if the current status is "Reject"
        if ($cause->status === 'reject') {
            // Store the current status as previous status
            $cause->previous_status = $cause->status;
            // Set the status to "Pending"
            $cause->status = 'pending';
            // Save the changes
            $cause->save();

            return redirect()->route('admin_cause_approval', $cause->id)->with('success', 'Reject status undone successfully');
        } else {
            // If the current status is not "Reject", redirect back with a warning message
            return redirect()->back()->with('error', 'The cause status cannot be undone because it is not currently rejected');
        }
    }


    public function details($slug) 
    {
        $cause = Cause::where('slug', $slug)->with(['targetAudiences', 'partnershipsAndCollaborations', 'user'])->firstOrFail();
        $cause_photos = CausePhoto::where('cause_id',$cause->id)->get();
        $cause_videos = CauseVideo::where('cause_id',$cause->id)->get();
        $cause_faqs = CauseFaq::where('cause_id',$cause->id)->get();
        $recent_causes = Cause::orderBy('id', 'desc')->take(5)->get();
        // Decode the JSON supporting_documents field
        $supporting_documents = json_decode($cause->supporting_documents, true);
        return view('admin.cause.details', compact('cause', 'cause_photos', 'cause_videos', 'cause_faqs', 'recent_causes', 'supporting_documents'));
    }

    public function showReport($id)
    {
        $report = CauseReport::with('media')->where('cause_id', $id)->first();
        return view('admin.partials.cause_report', compact('report'));
    }

}
