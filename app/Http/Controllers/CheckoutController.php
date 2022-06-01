<?php

namespace App\Http\Controllers;

use App\Mail\SendInvoiceMail;
use App\Models\BillingDetails;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    //checkout page view
    public function checkout()
    {
        $countries = Country::all();

        return view('fontend.checkout', [
            'countries' => $countries,
        ]);
    }

    // get city ajax dropdown checkout page
    public function get_state(Request $request)
    {
        // echo $request->country_id;
        $states = State::where('country_id', $request->country_id)->select('id', 'name')->get();

        // print_r($cities);
        // echo $cities;
        $str = '<option value="">Select a City</option>';
        foreach ($states as $state) {
            // echo $city->name;
            $str .= '<option value="' . $state->id . '">' . $state->name . '</option>';
        }

        echo $str;
    }

    public function get_city(Request $request)

    {
        $cities = City::where('state_id', $request->state_id)->get();

        // echo $request->state_id;
        // print_r($cities);
        // echo $cities->id;
        $str = '<option value="">Select a State</option>';
        foreach ($cities as $city) {
            // echo $city->name;
            $str .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }

        echo $str;
    }

    // checkout insert check out page
    public function checkout_insert(Request $request)
    {
        // print_r($request->all());
        echo  $request->discount;
        if ($request->payment_method == 1) {
            $order_id = Order::insertGetId([
                'user_id' => Auth::guard('customerlogin')->id(),
                'sub_total' => $request->sub_total,
                'discount' =>  $request->discount,
                'delivery_charge' => $request->delivery_charge,
                'total' => $request->delivery_charge + $request->sub_total - $request->discount,
                'created_at' => Carbon::now(),
            ]);

            // print_r($order_id);

            $billing_id = BillingDetails::insert([
                'user_id' => Auth::guard('customerlogin')->id(),
                'order_id' => $order_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'company' => $request->company,
                'address' => $request->address,
                'notes' => $request->notes,
                'created_at' => Carbon::now(),

            ]);

            // 
            $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();

            foreach ($carts as $cart) {
                OrderProduct::insert([
                    'order_id' => $order_id,
                    'product_id' => $cart->product_id,
                    'price' => $cart->rel_to_product->product_price,
                    'quantity' => $cart->quantity,

                ]);
            }

            Mail::to($request->email)->send(new SendInvoiceMail($order_id));

            $total = $request->delivery_charge + $request->sub_total - $request->discount;
            // sms sent mobile number
            // $url = "http://66.45.237.70/api.php";
            // $number = $request->phone;
            // $text = "Thak You for Purchasing Our Products,Your Total amouny is:" . $total;
            // $data = array(
            //     'username' => "zubair1050",
            //     'password' => "Z9HEMAPG",
            //     'number' => "$request->phone",
            //     'message' => "$text"
            // );
            // $ch = curl_init(); 
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // $smsresult = curl_exec($ch);
            // $p = explode("|", $smsresult);
            // $sendstatus = $p[0];



            foreach ($carts as $cart) {
                Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('qty', $cart->quantity);
                // checkout order then cart remove 
                Cart::find($cart->id)->delete();
            }



            return redirect()->route('order.success')->with('order_success', 'Congratulations!!Your Order Has Been Place!');
        } elseif ($request->payment_method == 2) {
            echo 'SSL';
        } else {
            echo 'stripe';
        }
    }

    public function order_success()
    {
        if (session('order_success')) {
            return view('fontend.order_success');
        } else {
            return view('fontend.errors.404');
        }
    }
}
