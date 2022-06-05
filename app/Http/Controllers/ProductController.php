<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Thumbnil;
use App\Models\Color;
use App\Models\Size;
use App\Models\Inventory;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ProductController extends Controller
{
    //product add apge view
    public function index()
    {
        $all_category = Category::all();
        $all_subcategory = Subcategory::all();
        return view('admin.product.index', [
            'all_category' => $all_category,
            'all_subcategory' => $all_subcategory,
        ]);
    }

    // all product view
    public function viewProduct()
    {
        $all_product = Product::all();

        return view('admin.product.view', [
            'all_product' => $all_product,

        ]);
    }

    // ajax category form sub category
    public function getCategory(Request $request)
    {
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        $str = '<option value="">---Select Sub Category---</option>';
        foreach ($subcategories as $subcategory) {
            // echo $subcategory->subcategory_name;
            $str .= '<option value="' . $subcategory->id . '">' . $subcategory->subcategory_name . '</option>';
        }
        echo $str;
    }
    // product insert
    public function  insert(ProductRequest $request)
    {


        if ($request->thumbnil) {
            $product_id = Product::insertGetId([
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'discount' => $request->discount,
                'after_discount' => $request->product_price - ($request->product_price * $request->discount) / 100,
                'sort_desp' => $request->sort_desp,
                'long_desp' => $request->long_desp,
                'created_at' => Carbon::now(),
                // 'preview' => 'Product Image',

            ]);
            $uploaded_file = $request->preview;
            // echo $uploaded_file;
            $extention = $uploaded_file->getClientOriginalExtension();
            // echo $extention;
            $file_name = $product_id . '.' . $extention;
            Image::make($uploaded_file)->resize(680, 680)->save(public_path('/uploads/product/preview/' . $file_name));
            Product::find($product_id)->update([
                'preview' => $file_name,
            ]);
            $loop = 0;
            $thumbnil_image = $request->thumbnil;

            foreach ($thumbnil_image as $thumb) {
                $thumbnil_extention = $thumb->getClientOriginalExtension();
                $thumbnil_file_name = $product_id . '-' . $loop . '.' . $thumbnil_extention;
                Image::make($thumb)->resize(680, 680)->save(public_path('/uploads/product/thumbnil/' . $thumbnil_file_name));
                Thumbnil::insert([
                    'product_id' => $product_id,
                    'thumbnil' => $thumbnil_file_name,
                    'created_at' => Carbon::now(),
                ]);

                $loop++;
            }
        } else {
            $product_id = Product::insertGetId([
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'discount' => $request->discount,
                'after_discount' => $request->product_price - ($request->product_price * $request->discount) / 100,
                'sort_desp' => $request->sort_desp,
                'long_desp' => $request->long_desp,
                'created_at' => Carbon::now(),
                // 'preview' => 'Product Image',

            ]);
            $uploaded_file = $request->preview;
            // echo $uploaded_file;
            $extention = $uploaded_file->getClientOriginalExtension();
            // echo $extention;
            $file_name = $product_id . '.' . $extention;
            Image::make($uploaded_file)->resize(680, 680)->save(public_path('/uploads/product/preview/' . $file_name));
            Product::find($product_id)->update([
                'preview' => $file_name,
            ]);
        }
        return redirect()->route('product.list')->with('success_msg', 'Product Add Sucessfully!!');
    }

    public function edit($product_id)
    {
        $thumbnil = Thumbnil::where('product_id', $product_id)->first();
        // print_r($thumbnil);
        // die();
        $all_product = Product::find($product_id);
        $all_category = Category::all();
        $all_subcategory = Subcategory::all();
        return view('admin.product.edit', [
            'all_category' => $all_category,
            'all_subcategory' => $all_subcategory,
            'all_product' => $all_product,
            'thumbnil' => $thumbnil,
        ]);
    }

    // update product
    public function update(Request $request)
    {
        if ($request->preview) {
            $product_id = $request->id;
            $product_info = Product::find($product_id);
            // echo $category_info->category_image;
            // die();
            $unlink_id = public_path('/uploads/product/preview/' . $product_info->preview);
            unlink($unlink_id);

            $uploaded_file = $request->preview;
            // echo $uploaded_file;
            $extention = $uploaded_file->getClientOriginalExtension();
            // echo $extention;
            $file_name = $request->id . '.' . $extention;
            Image::make($uploaded_file)->resize(680, 680)->save(public_path('/uploads/product/preview/' . $file_name));

            Product::find($request->id)->update([
                // 'user_id' => Auth::id(),
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'discount' => $request->discount,
                'after_discount' => $request->product_price - ($request->product_price * $request->discount) / 100,
                'sort_desp' => $request->sort_desp,
                'long_desp' => $request->long_desp,
                'preview' => $file_name,
                'updated_at' => Carbon::now(),

            ]);
            return redirect()->route('product.list')->with('success_msg', 'Product Update Sucessfully!!');
        } else if ($request->thumbnil) {

            $product_id = $request->id;
            $product_thum = Thumbnil::find($product_id);
            $loop = 0;
            $thumbnil_image = $request->thumbnil;

            foreach ($thumbnil_image as $thumb) {

                // echo $category_info->category_image;
                // die();
                $unlink_id = public_path('/uploads/product/thumbnil/' . $product_thum->thumbnil);
                unlink($unlink_id);
                $thumbnil_extention = $thumb->getClientOriginalExtension();
                $thumbnil_file_name = $product_id . '-' . $loop . '.' . $thumbnil_extention;
                Image::make($thumb)->resize(680, 680)->save(public_path('/uploads/product/thumbnil/' . $thumbnil_file_name));
                Thumbnil::find($request->id)->update([
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'product_name' => $request->product_name,
                    'product_price' => $request->product_price,
                    'discount' => $request->discount,
                    'after_discount' => $request->product_price - ($request->product_price * $request->discount) / 100,
                    'sort_desp' => $request->sort_desp,
                    'long_desp' => $request->long_desp,
                    'updated_at' => Carbon::now(),


                ]);

                $loop++;
            }
            return redirect()->route('product.list')->with('success_msg', 'Product Update Sucessfully!!');
        } else {

            Product::find($request->id)->update([
                // 'user_id' => Auth::id(),
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'discount' => $request->discount,
                'after_discount' => $request->product_price - ($request->product_price * $request->discount) / 100,
                'sort_desp' => $request->sort_desp,
                'long_desp' => $request->long_desp,
                'updated_at' => Carbon::now(),

            ]);
            return redirect()->route('product.list')->with('success_msg', 'Product Update Sucessfully!!');
        }
    }
    // product delete
    public function delete($product_id)
    {
        // echo $product_id;
        $product_image = Product::find($product_id);
        $product_image->preview;
        // print_r($product_thumb);
        // echo $product_thumb;
        $delete_preview = public_path('/uploads/product/preview/' . $product_image->preview);
        unlink($delete_preview);
        $product_thum = Thumbnil::where('product_id', $product_id)->get();
        foreach ($product_thum as $thumb) {

            $delete_thumb = public_path('/uploads/product/thumbnil/' . $thumb->thumbnil);
            unlink($delete_thumb);
        }

        Product::find($product_id)->delete();

        return back();
    }
}
