<?php

namespace App\Http\Controllers;

use App\Models\CustomerEmailVerify;
use App\Models\CustomerLogin;
use App\Notifications\CustomerVerifyEmailNotification;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Notification;

class CustomerRegisterController extends Controller
{
    //
    public function customer_register()
    {
        return view('fontend.customer.customer_register');
    }

    // customer insert

    public function customer_insert(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // $request->all();
        CustomerLogin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),

        ]);

        // email verify
        $customer = CustomerLogin::where('email', $request->email)->firstOrFail();
        $delete_info = CustomerEmailVerify::where('customer_id', $customer->id)->delete();
        $verify_info = CustomerEmailVerify::Create([
            'customer_id' =>  $customer->id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);
        Notification::send($customer, new CustomerVerifyEmailNotification($verify_info));


        return back()->with('email_verify', 'We have sent you a verification Link at ->' . $customer->email);
    }
    // email verify
    public function customer_email_verify($token)
    {
        $token_check = CustomerEmailVerify::where('token', $token)->firstOrFail();
        $customer = CustomerLogin::findOrFail($token_check->customer_id);
        $customer->update([
            'email_verified_at' => Carbon::now(),
        ]);
        $token_check->delete();
        return redirect()->route('customer.register')->with('verified', 'Congratulation your eamil has been verified!');
    }
}
