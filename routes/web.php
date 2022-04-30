<?php

use App\Http\Controllers\FontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// fontend
Route::get('/', [FontendController::class, 'index'])->name('homepage');
Route::get('/product/details,{product_id}', [FontendController::class, 'product_details'])->name('product.details');
// ajax get size by color
Route::post('/getSize', [FontendController::class, 'getSize']);




// home dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/dash', [HomeController::class, 'dash']);

Route::get('/user/list', [HomeController::class, 'userList'])->name('user');
Route::get('/user/delete,{user_id}', [HomeController::class, 'userDelete'])->name('user.delete');
// profile change
Route::get('/profile/change', [HomeController::class, 'profileChange'])->name('profile.change');
// profile name change
Route::post('/profile/name/update', [HomeController::class, 'nameChange']);
// profile password update
Route::post('/profile/password/update', [HomeController::class, 'passwordUpdate']);
// profilr picture update
Route::post('/profile/photo/update', [HomeController::class, 'pictureUpdate']);





// category
Route::get('/add/category', [CategoryController::class, 'index'])->name('category');
// category insert
Route::post('/category/insert', [CategoryController::class, 'insertCategory']);
// category edit
Route::get('/edit/category/{category_id}', [CategoryController::class, 'edit'])->name('category.edit');
//category update
Route::post('/category/update', [CategoryController::class, 'updateCategory']);
// category soft delete
Route::get('/category/delete,{category_id}', [CategoryController::class, 'categorySoftDelete'])->name('categorySoft.delete');
// mark all delete
Route::post('/markSoft/delete', [CategoryController::class, 'markSoftDelete']);
// category hard delete
Route::get('/category/hard/delete,{category_id}', [CategoryController::class, 'categoryHardDelete'])->name('categoryHard.delete');
// category restore
Route::get('/category/restore/{category_id}', [CategoryController::class, 'restoreCategory'])->name('category.restore');
// category all mark restore
Route::post('/markAll/restore', [CategoryController::class, 'markAllrestore']);


//subcategory
Route::get('/add/subCategory', [SubcategoryController::class, 'index'])->name('subCategory');
Route::post('/subcategory/insert', [SubcategoryController::class, 'insert']);
Route::get('/edit/subcategory/{subcategory_id}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
Route::post('/subcategory/update', [SubcategoryController::class, 'update']);
Route::get('/subcategory/delete/{subcategory_id}', [SubcategoryController::class, 'delete'])->name('subcategory.delete');


// product
Route::get('/add/product', [ProductController::class, 'index'])->name('product');
// ajax category
Route::post('/getSubcategory', [ProductController::class, 'getCategory']);
Route::post('/product/insert', [ProductController::class, 'insert']);
Route::get('/product/list', [ProductController::class, 'viewProduct'])->name('product.list');
Route::get('/edit.product/{product_id}', [ProductController::class, 'edit'])->name('edit.product');
Route::post('/product/Update', [ProductController::class, 'update']);
Route::get('/product/delete/{product_id}', [ProductController::class, 'delete'])->name('product.delete');



// inventory
Route::get('/product/add/color/size', [InventoryController::class, 'color_size'])->name('add.color.size');
Route::post('/insert/color', [InventoryController::class, 'insertColor']);
Route::post('/insert/size', [InventoryController::class, 'insertSize']);
Route::get('/add/inventory/{product_id}', [InventoryController::class, 'index'])->name('add.inventory');
Route::post('/inventory/insert', [InventoryController::class, 'insertInventory']);
Route::get('/edit/color/{color_id}', [InventoryController::class, 'edit_color'])->name('color.edit');
Route::post('/update/color', [InventoryController::class, 'update_color']);
Route::get('/color/delete/{color_id}', [InventoryController::class, 'delete_color'])->name('color.delete');
Route::get('/edit/size/{size_id}', [InventoryController::class, 'edit_size'])->name('size.edit');
Route::post('/update/size', [InventoryController::class, 'update_size']);
Route::get('/size/delete/{size_id}', [InventoryController::class, 'delete_size'])->name('size.delete');
Route::get('/edit/inventory/{inventory_id}', [InventoryController::class, 'edit_inventory'])->name('inventory.edit');
Route::post('/inventory/update', [InventoryController::class, 'update_inventory']);
Route::get('/inventory/delete/{inventory_id}', [InventoryController::class, 'delete_inventory'])->name('inventory.delete');




// Route::get('/', [FontendController::class, 'welcome']);
