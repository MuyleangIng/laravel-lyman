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

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function edit_submit(Request $request, $id)
{
    // Validate the required fields
    $request->validate([
        'name' => 'required',
        'first_name' => 'nullable',
        'last_name' => 'nullable',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png',
        'phone' => 'nullable',
    ]);

    // Find the user by ID
    $user = User::findOrFail($id);

    // Update name, first name, and last name
    $user->name = $request->name;
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->phone = $request->phone;

    // Check if a new photo is uploaded
    if ($request->photo) {
        // Remove the old photo if it exists
        if ($user->photo) {
            unlink(public_path('uploads/' . $user->photo));
        }

        // Upload the new photo
        $final_name = 'user_' . time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);
        $user->photo = $final_name;
    }

    // Save the updated user
    $user->update();

    // Redirect with success message
    return redirect()->route('admin_user_index')->with('success', 'User updated successfully');
}

    

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->photo) {
            unlink(public_path('uploads/' . $user->photo));
        }
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
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
