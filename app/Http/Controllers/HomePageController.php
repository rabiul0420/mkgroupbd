<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\OurService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomePageController extends Controller
{
    public function index() {
        return view('website.pages.home');
    }

    public function service($id) {
        $service = OurService::find($id);
        return view('website.pages.service', compact('service'));
    }

    public function about_us() {
        return view('website.pages.about_us');
    }

    public function mission_vission() {
        $title = "Mission and Vission";
        return view('website.pages.mission_vission',compact('title'));
    }

    public function why_choose_us() {
        $title = "Why Choose Us";
        return view('website.pages.why_choose_us',compact('title'));
    }

    public function our_commitment() {
        $title = "Our Commitment";
        return view('website.pages.our_commitment',compact('title'));
    }




    public function services() {
        return view('website.pages.services');
    }

    public function contact_us() {
        return view('website.pages.contact_us');
    }





    public function storeMessage(Request $request) {
        $this->validate($request,[
           'name' => 'required|max:50',
           'email' => 'required|email|max:50',
           'subject' => 'required|max:100',
           'message' => 'required|max:1000'
        ]);
        $mail_data = [
            'subject' => $request->subject,
            'body' => $request->message,
            'title' => 'Someone wants to contact with you.',
            'name' => $request->name,
            'email' => $request->email
        ];
        // $mail_data = [];
        // $mail_data['subject'] = "Hello";
        // $mail_data['body'] = "Hello";
        // $mail_data['title'] = "Hello";
        // $mail_data['name'] = "Hello";
        // $mail_data['name'] = "email";
        // return view("mail.mail_template",compact('mail_data'));
        $mailSent = Mail::to(siteSetting()['email'])->send(new SendMail($mail_data));
        try {
            $mailSent = Mail::to(siteSetting()['email'])->send(new SendMail($mail_data));

            if (!$mailSent) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Your message has been sent successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Mail sending success, but no recipients accepted.'
                ]);
            }
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('Mail sending failed: ' . $e->getMessage());

            // Return an error response
            return response()->json([
                'status' => 'error',
                'message' => 'Message not sent. Something went wrong!'
            ]);
        }
    }
}
