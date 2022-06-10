<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StripePaymentController extends Controller
{
    //
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $data = session('data');

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => 100 * (($data['sub_total'] + $data['delivery_charge']) - $data['discount']),
            "currency" => "bdt",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);



        // print_r($data['user_id']);
        // echo $data['user_id'];

        $order_id = Order::insertGetId([
            'user_id' => $data['user_id'],
            'sub_total' => $data['sub_total'],
            'discount' =>  $data['discount'],
            'delivery_charge' => $data['delivery_charge'],
            'total' => $data['delivery_charge'] + $data['sub_total'] - $data['discount'],
            'created_at' => Carbon::now(),
        ]);

        // print_r($order_id);

        $billing_id = BillingDetails::insert([
            'user_id' => $data['user_id'],
            'order_id' => $order_id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'country_id' => $data['country_id'],
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id'],
            'company' => $data['company'],
            'address' => $data['address'],
            'notes' => $data['notes'],
            'created_at' => Carbon::now(),

        ]);

        // 
        $carts = Cart::where('customer_id', $data['user_id'])->get();

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
    }
}
