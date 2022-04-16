<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class FontendController extends Controller
{

    // home page /index page
    public function index()
    {
        $categories = Category::all();
        $latest_products = Product::take(6)->orderBy('id', 'DESC')->get();
        // $new_arrival = Product::latest()->take(6)->get();
        return view('fontend.index', [
            'latest_products' => $latest_products,
            'categories' => $categories,
        ]);
    }

    // product details page / shop page
    public function product_details($product_id)
    {
        $product_info = Product::find($product_id);
        $avaliable_color = Inventory::where('product_id', $product_id)->groupBy('color_id')->selectRaw('count(*) as total, color_id')->get();
        return view('fontend.product_details', [
            'product_info' => $product_info,
            'avaliable_color' => $avaliable_color,
        ]);
    }
    // get size by color id
    public function getSize(Request $request)
    {
        $str = '<option value="">Choose A Option</option>';
        
        $get_size = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
        foreach ($get_size as $size) {
            // echo $size->size_id . ',';
            $str .= '<option value="' . $size->size_id . '">' . $size->rel_to_size->size_name . '</option>';
        }
        echo $str;
    }
}
