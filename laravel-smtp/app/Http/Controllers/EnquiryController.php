<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EnquiryMail;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    public function sendEnquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');

        Mail::to('laravelsmtp@example.com')->send(new EnquiryMail($name, $email, $subject, $message));

        return response()->json(['message' => 'Email sent successfully.']);
    }
}
