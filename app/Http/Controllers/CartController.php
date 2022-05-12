<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
    public function cart()
    {
        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        return view('fontend.cart', ['carts' => $carts]);
    }

    public function cart_remove(Request $request)
    {
        Cart::find($request->cart_id)->delete();
        return back();
    }
}
