<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //checkout page view
    public function checkout()
    {
        return view('fontend.checkout');
    }
}
