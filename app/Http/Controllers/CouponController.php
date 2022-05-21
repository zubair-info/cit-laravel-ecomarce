<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //coupon view page
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    // coupon insert

    public function insert(Request $request)
    {
        $request->validate([

            'coupon_name' => 'required',
            'discount' => 'required',
            'type' => 'required',
            'validity' => 'required',
        ]);
        Coupon::insert([
            'coupon_name' => $request->coupon_name,
            'discount' => $request->discount,
            'type' => $request->type,
            'validity' => $request->validity,
        ]);
        return back()->with('success_msg', 'Coupon Add Sucessfully');
    }
    // coupon delete
    public function delete($coupon_id)
    {
        Coupon::find($coupon_id)->delete();
        return back()->with('delete', 'Coupon Delete Sucessfully');
    }
}
