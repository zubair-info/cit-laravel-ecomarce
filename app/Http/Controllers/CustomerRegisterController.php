<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        $request->all();
        CustomerLogin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),

        ]);
        return back();
    }
}
