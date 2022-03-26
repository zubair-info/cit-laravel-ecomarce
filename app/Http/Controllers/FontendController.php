<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FontendController extends Controller
{
    //
    public function  welcome()
    {
        return view('fontend.welcome');
    }
}
