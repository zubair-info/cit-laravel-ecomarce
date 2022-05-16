<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //cart insert
    public function cart_store(Request $request)
    {
        // dd($request->all());
        Cart::insert([

            'customer_id' => Auth::guard('customerlogin')->id(),
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
            'created_at' => Carbon::now(),

        ]);
        return back()->with('insert', 'Cart Add Sucessfully!!');
    }

    // mini cart delete
    public function cart_delete($cart_id)
    {
        Cart::find($cart_id)->delete();
        return back();
    }

    // cart view page
    // coupon apply cart page
    public function cart(Request $request)
    {
        $coupun_code = $request->coupon;
        // echo $copun_code;
        $message = NULL;
        $type = NULL;
        if ($coupun_code == '') {
            $discount = 0;
        } else {
            if (Coupon::where('coupon_name', $coupun_code)->exists()) {
                if (Carbon::now()->format('Y-m-d') >= Coupon::Where('coupon_name', $coupun_code)->first()->validity) {
                    $message = 'Coupon Code Exipred';
                    $discount = 0;
                } else {
                    $discount = Coupon::Where('coupon_name', $coupun_code)->first()->discount;
                    $type = Coupon::Where('coupon_name', $coupun_code)->first()->type;
                }
                // $discount = 10;
            } else {
                $message = 'Invalid Coupon';
                $discount = 0;
            }
        }
        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        return view('fontend.cart', [
            'carts' => $carts,
            'discount' => $discount,
            'message' => $message,
            'type' => $type,
        ]);
    }

    public function cart_remove(Request $request)
    {
        Cart::find($request->cart_id)->delete();
        return back();
    }
}
