<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }


     // Block/Unblock user method
     public function block($id)
     {
         $user = User::findOrFail($id);
 
         // Toggle block status
         $user->block = !$user->block;
         $user->save();
 
         $status = $user->block ? 'blocked' : 'unblocked';
         return redirect()->back()->with('success', "User has been {$status} successfully.");
     }
}
