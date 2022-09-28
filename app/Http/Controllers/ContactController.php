<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // direct view contact page
    public function contactForm()
    {
        return view('user.main.contact');
    }

    // contact from user
    public function contact(Request $request)
    {
        $this->validateRequest($request);
        $data = $this->getDataFromRequest($request);
        Contact::create($data);
        return back()->with(['success' => 'Your message has been delivered.']);
    }

    // data array
    private function getDataFromRequest($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];
    }

    // validate request
    private function validateRequest($request)
    {
        Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|string|email',
            'phone' => 'required',
            'message' => 'required|min:10|max:255'
        ])->validate();
    }
}
