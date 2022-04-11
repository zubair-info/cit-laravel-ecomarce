<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
    //sub category page view
    public function index()
    {
        $all_category = Category::all();
        $all_subcategory = Subcategory::all();
        return view('admin.subcategory.index', [
            'all_category' => $all_category,
            'all_subcategory' => $all_subcategory,
        ]);
        // return view('admin.subcategory.index');
    }

    // sub category insert
    public function insert(Request $request)
    {
        // print_r($request->all());
        $request->validate([

            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);

        if (Subcategory::where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()) {

            return back()->with('same_cat', 'Already Exists Category ');
        } else {

            Subcategory::insert([
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'created_at' => Carbon::now()
            ]);
        }


        return back()->with('success_msg', 'sub Category Add Sucessfully!!');
    }

    // edite sub category
    public function edit($subcategory_id)
    {
        // echo $subcategory_id;
        $all_category = Category::all();
        $subcategory_info = Subcategory::find($subcategory_id);

        return view('admin.subcategory.edit', [
            'all_category' => $all_category,
            'subcategory_info' => $subcategory_info,
        ]);
    }

    // sub category update
    public function update(Request $request)
    {
        // print_r($request->all());
        $request->validate([

            'category_id' => 'required',
            'subcategory_name' => 'required',

        ]);

        if (Subcategory::where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()) {

            return back()->with('same_cat', 'Already Exists Category ');
        } else {
            Subcategory::find($request->id)->update([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'updated_at' => Carbon::now(),
            ]);
        }
        return redirect()->route('subCategory')->with('update', 'Sub Category Update Successfully!');
    }

    // sub category delete
    public function delete($subcategory_id)
    {
        Subcategory::find($subcategory_id)->delete();
        return back()->with('delete', 'Sub Category Delete Sucessfully!');
    }
}
