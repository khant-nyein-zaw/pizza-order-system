<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // user list view for admin
    public function userList()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.user.list', compact('users'));
    }

    // change role with ajax
    public function changeRole(Request $request)
    {
        User::where('id', $request->userId)->update([
            'role' => $request->role
        ]);
        return response(200);
    }

    // user feedbacks
    public function feedbacks()
    {
        $feedbacks = Contact::get();
        return view('admin.user.contact', compact('feedbacks'));
    }

    // delete user
    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Selected user account have been deleted.']);
    }
}
