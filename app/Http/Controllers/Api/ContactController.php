<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SendContact;
use App\Mail\ContactSite;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendContact(SendContact $request)
    {
        Mail::send(new ContactSite($request->all()));

        return response()->json(['message' => 'success']);
    }
}
