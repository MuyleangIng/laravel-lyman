<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cause;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookmarkController extends Controller
{
    public function bookmark(Request $request)
    {
        $user = User::find(Auth::id()); // Get the currently authenticated user
    
        if (!$user) {
            // If the user is not authenticated, redirect them or show a message
            return redirect()->route('login')->with('error', 'You need to be logged in to view your bookmarks.');
        }
    
        // Fetch only the causes that the user has bookmarked with pagination
        $causes = $user->bookmarkedCauses()->where('status', 'approve')->paginate(8);
    
        // Attach liked_by_user and bookmarked_by_user status to each cause
        foreach ($causes as $cause) {
            // Check if the cause is liked by the current user
            $cause->liked_by_user = $user->likedCauses->contains($cause->id);
    
            // Since these are the bookmarked causes, we can set bookmarked_by_user to true
            $cause->bookmarked_by_user = true;
    
            // Track the cause views by session
            if (!$this->hasViewed($cause->id)) {
                $this->incrementView($cause);
            }
        }
    
        // Return the 'bookmark' view with the filtered causes
        return view('front.bookmark', compact('causes'));
    }
    
    /**
     * Check if the cause has been viewed in the current session.
     */
    private function hasViewed($causeId)
    {
        return Session::has("viewed_causes.{$causeId}");
    }

    /**
     * Increment the view count for the cause.
     */
    private function incrementView($cause)
    {
        $cause->increment('views');
        Session::put("viewed_causes.{$cause->id}", true);
    }
}
