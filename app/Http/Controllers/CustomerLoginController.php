<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    //
    public function customer_login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if (Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            // email verify check
            if (Auth::guard('customerlogin')->user()->email_verified_at == NULL) {
                Auth::guard('customerlogin')->logout();
                return redirect('/customer/register')->with('need_verify', 'Please verify your Email!');
            }
            return redirect('/');
            // echo 'not ok';
        } else {
            // echo ' ok';
            return redirect('/customer/register')->with('wrong_pass', 'Email and Password Does Not  Match');
        }
    }

    public function customer_logout()
    {
        Auth::guard('customerlogin')->logout();
        return redirect('/');
    }
}

