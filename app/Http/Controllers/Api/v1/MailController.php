<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Jobs\MailJob;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function sendMail(Request $request)
    {
        $to_mail = "chrisantosinatra6@gmail.com";
        $data = array("title" => "TEST EMAIL TITLE", "name" => "Chrisanto Sinatra", "body" => "This is a test mail from Laravel");

        try {

            dispatch(new MailJob($to_mail, $data));

            return response()->json(["message" => "Email sent successfully to " . $to_mail], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "Failed to send email", "error" => $e->getMessage()], 500);
        }
    }
}
