<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function customer_acount()
    {
        return view('fontend.customer.acount');
    }

    public function acount_update(Request $request)
    {
        // dd($request->all());
        
    }
}
