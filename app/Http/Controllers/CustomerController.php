<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use PDF;
use App\Models\CustomerPasswordReset;
use App\Notifications\PassResetNotification;
use Illuminate\Support\Facades\Notification;

class CustomerController extends Controller
{
    //
    public function customer_acount()
    {
        $orders = Order::where('user_id', Auth::guard('customerlogin')->id())->get();
        return view('fontend.customer.acount', compact('orders'));
    }

    public function acount_update(Request $request)
    {
        // dd($request->all());
        CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
            'name' => $request->name,
            'number' => $request->number,
            'address' => $request->address,

        ]);
        return back()->with('update', 'Acount Update Sucessfully!!');
    }

    // profile picture update
    public function picture_update(Request $request)
    {
        $request->validate([
            'profile_photo' => 'file|max:1024',

            'profile_photo' => 'mimes:jpg,jpeg,png',
        ]);
        // print_r($request->all());
        $uploaded_photo = $request->profile_photo;
        $extention = $uploaded_photo->getClientOriginalExtension();
        // echo $extention;
        $filename = Auth::guard('customerlogin')->id() . '.' . $extention;


        if (Auth::guard('customerlogin')->user()->profile_photo == 'defult.jpg') {
            Image::make($uploaded_photo)->save(public_path('/uploads/customer/' . $filename));
            CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                'profile_photo' => $filename,
            ]);
            return back()->with('success_msg', 'Picture update Sucessfully!!');
        } else {
            $delete_form = public_path('/uploads/customer/' . Auth::guard('customerlogin')->user()->profile_photo);
            // unlink($delete_form);
            Image::make($uploaded_photo)->save(public_path('/uploads/customer/' . $filename));
            CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                'profile_photo' => $filename,
            ]);
            return back()->with('success_msg', 'Picture update Sucessfully!!');
        }
    }

    // profile password update
    public  function password_update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'password' =>  Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
            'password' => 'confirmed',

        ]);
        if (Hash::check($request->old_password, Auth::guard('customerlogin')->user()->password)) {

            if (Hash::check($request->password, Auth::guard('customerlogin')->user()->password)) {

                return back()->with('same_pass', 'Old Pass And current pass same');
            } else {

                // echo 'nai';
                CustomerLogin::find(Auth::guard('customerlogin')->id())->update([

                    'password' => bcrypt($request->password),
                    'updated_at' => Carbon::now(),

                ]);
                return back()->with('update', 'Password Update  Sucessfully!!');
            }
        } else {
            // echo 'Old Pass Not Correct';
            return back()->with('wrong_pass', 'Old Pass Not Correct');
        }
    }

    // invoice download customer
    public function download_invoice($order_id)
    {
        // echo $order_id;

        $pdf = PDF::loadView('fontend.customer.invoice.invoice', [
            'order_id'  => $order_id,
        ]);

        // return $pdf->download('invoice.pdf');
        return $pdf->stream('invoice.pdf');
        // return view('fontend.customer.invoice.invoice', compact('order_id'));
    }

    public function view_invoice($order_id)
    {
        $pdf = PDF::loadView('fontend.customer.invoice.invoice', [
            'order_id'  => $order_id,
        ]);
        return view('fontend.customer.invoice.invoice', compact('order_id'));
    }

    // passwod reset
    public function password_reser_req()
    {
        return view('fontend.customer.password_reset');
    }

    //passord store
    public function password_reser_store(Request $request)
    {

        $customer = CustomerLogin::where('email', $request->email)->firstOrfail();
        $password_reset = CustomerPasswordReset::where('customer_id', $customer->id)->delete();
        $password_reset = CustomerPasswordReset::create([
            'customer_id' => $customer->id,
            'reset_token' => uniqid(),
            'created_at' => Carbon::now(),

        ]);
        Notification::send($customer, new PassResetNotification($password_reset));
        return back()->with('reset_link', 'We has sent password reset link!!');
    }
    // email rest form
    public function password_reser_form($token)
    {
        return view('fontend.customer.password_reset_form', compact('token'));
    }

    public function password_reset_update(Request $request)
    {
        $customer_token = CustomerPasswordReset::where('reset_token', $request->reset_token)->firstOrfail();
        $customer = CustomerLogin::findOrfail($customer_token->customer_id);
        $customer->update([
            'password' => Hash::make($request->password),
        ]);
        $customer_token->delete();
        return back()->with('reset_success', 'password reset successfull!!');
    }
}
