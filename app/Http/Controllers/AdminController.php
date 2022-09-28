<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // direct account details page
    public function details()
    {
        return view('admin.account.details');
    }

    // direct password change page
    public function passwordChangePage()
    {
        return view('admin.account.changePassword');
    }

    // direct account edit page
    public function editPage()
    {
        return view('admin.account.edit');
    }

    // edit account info
    public function edit($id, Request $request)
    {
        $this->accountValidation($request);
        $updatedData = $this->getData($request);

        if ($request->hasFile('image')) {
            $oldFileName = User::where('id', $id)->pluck('image')->first();

            if ($oldFileName != null) {
                Storage::delete('public/' . $oldFileName);
            }

            $newFileName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->image->storeAs('public', $newFileName);
            $updatedData['image'] = $newFileName;
        }

        User::where('id', $id)->update($updatedData);
        return redirect()->route('admin#accountDetails')->with(['updated' => 'Account info updated.']);
    }

    // change password
    public function changePassword(Request $request)
    {
        $this->passwordValidation($request);
        $user = User::where('id', Auth::user()->id)->first();
        $hashedCurrentPassword = $user->password;
        if (Hash::check($request->oldPassword, $hashedCurrentPassword)) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword),
            ]);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return redirect()->route('category#list')->with(['passwordUpdated' => 'Your password is updated.']);
        }
        return back()->with(['errorMsg' => 'The provided password does not match your current password.']);
    }

    // direct admin list
    public function list()
    {
        $admins = User::when(request('searchKey'), function ($query) {
            return $query->where('name', 'LIKE', '%' . request('searchKey') . '%')
                ->orWhere('email', 'LIKE', '%' . request('searchKey') . '%')
                ->orWhere('phone', 'LIKE', '%' . request('searchKey') . '%')
                ->orWhere('address', 'LIKE', '%' . request('searchKey') . '%');
        })->where('role', 'admin')->paginate(3);
        $admins->appends(request()->all());
        return view('admin.account.list', compact('admins'));
    }

    // delete admin account
    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->image != null) {
            $currentUserImage = $user->image;
            Storage::delete('public/' . $currentUserImage);
        }
        $user->delete();
        return back()->with(['deleteSuccess' => 'Admin account was deleted.']);
    }

    // change role with ajax
    public function changeRole(Request $request)
    {
        User::where('id', $request->userId)->update([
            'role' => $request->role
        ]);
        return response(200);
    }

    // account data get from request
    private function getData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];
    }

    // account data validation
    private function accountValidation($request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id,
            'phone' => 'required',
            'image' => 'file|mimes:jpg,jpeg,png,webp',
            'address' => 'required',
            'gender' => 'required',
        ])->validate();
    }

    // password validation rules
    private function passwordValidation($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'passwordConfirmation' => 'required|min:6|same:newPassword',
        ])->validate();
    }
}
