<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InventoryController extends Controller
{


    public function color_size()
    {
        $all_color = Color::all();
        $all_size = Size::all();
        return view('admin.inventory.add_color_size', [
            'all_color' => $all_color,
            'all_size' => $all_size,
        ]);
    }
    // insert color
    public function insertColor(Request $request)
    {

        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now()

        ]);
        return back()->with('success_msg', 'Color Add Sucessfully!!');
    }
    // color edit
    public function edit_color($color_id)
    {
        $color_info = Color::find($color_id);

        return view('admin.inventory.color_edit', compact('color_info'));
    }
    // update color
    public function update_color(Request $request)
    {
        $request->validate([

            'color_name' => 'required',
            'color_code' => 'required',
        ]);
        Color::find($request->id)->update([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'updated_at' => Carbon::now(),


        ]);
        return redirect()->route('add.color.size')->with('update', 'Color Update Successfully!');
    }
    // color delete
    public function delete_color($color_id)
    {
        Color::find($color_id)->delete();
        return back()->with('delete', 'color Delete Sucessfully!');
    }

    // insert size
    public function insertSize(Request $request)
    {

        Size::insert([
            'size_name' => $request->size_name,
            'created_at' => Carbon::now()

        ]);
        return back()->with('success_msg', 'Size Add Sucessfully!!');
    }

    // size edit
    public function edit_size($size_id)
    {
        $size_info = Size::find($size_id);

        return view('admin.inventory.size_edit', compact('size_info'));
    }
    // update size
    public function update_size(Request $request)
    {
        $request->validate([

            'size_name' => 'required',

        ]);
        Size::find($request->id)->update([
            'size_name' => $request->size_name,
            'updated_at' => Carbon::now(),


        ]);
        return redirect()->route('add.color.size')->with('update', 'Size Update Successfully!');
    }
    // color delete
    public function delete_size($size_id)
    {
        Size::find($size_id)->delete();
        return back()->with('delete', 'Size Delete Sucessfully!');
    }



    //view inventory
    public function index($product_id)
    {

        $product_info = Product::find($product_id);
        $all_color = Color::all();
        $all_size = Size::all();
        $inventories = Inventory::Where('product_id', $product_id)->get();
        return view('admin.inventory.index', [
            'all_color' => $all_color,
            'all_size' => $all_size,
            'product_info' => $product_info,
            'inventories' => $inventories,

        ]);
    }

    // inventory insert
    public function insertInventory(Request $request)
    {
        $request->validate([
            'size_id' => 'required',
            'color_id' => 'required',
            'qty' => 'required',

        ]);
        if (Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()) {
            Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('qty', $request->qty);
            return back()->with('success_msg', 'Qty Update Sucessfully!!');
        } else {
            Inventory::insert([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'qty' => $request->qty,
                'created_at' => Carbon::now()

            ]);
            return back()->with('success_msg', 'Inventory Add Sucessfully!!');
        }
    }
    //  edit inventory
    public function edit_inventory($inventory_id)
    {
        $inventory_info = Inventory::find($inventory_id);
        // print_r($inventory_info);
        $all_color = Color::all();
        $all_size = Size::all();

        return view('admin.inventory.inventory_edit', compact('inventory_info', 'all_color', 'all_size'));
    }
    // update enventory
    public function update_inventory(Request $request)
    {
        $request->validate([
            'size_id' => 'required',
            'color_id' => 'required',
            'qty' => 'required',

        ]);
        Inventory::find($request->id)->update([
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
            'qty' => $request->qty,
            'updated_at' => Carbon::now(),



        ]);
        return back();
        // return redirect()->route('add.inventory')->with('update', 'Inventory Update Successfully!');
    }
    // inventory delete
    public function delete_inventory($inventory_id)
    {
        Inventory::find($inventory_id)->delete();
        return back()->with('delete', 'Inventory Delete Sucessfully!');
    }
}
