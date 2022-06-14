<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Models\CustomerLogin;
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

// =================================  fontend  ===========================================

Route::get('/', [FontendController::class, 'index'])->name('homepage');
// single product details page
Route::get('/product/details/{product_id}', [FontendController::class, 'product_details'])->name('product.details');
// ajax get size by color
Route::post('/getSize', [FontendController::class, 'getSize']);
// product review

Route::post('/product.review', [FontendController::class, 'product_review'])->name('product.review');

// =================================  customer  ===========================================

// customer login
Route::post('/customer/login', [CustomerLoginController::class, 'customer_login'])->name('customer.login');
Route::get('/customer/logout', [CustomerLoginController::class, 'customer_logout'])->name('customer.logout');
Route::get('/customer/acount', [CustomerController::class, 'customer_acount'])->name('customer.acount');
Route::post('/customer/acount/update', [CustomerController::class, 'acount_update']);
Route::post('/profile/photo/update', [CustomerController::class, 'picture_update']);
Route::post('/customer/password/update', [CustomerController::class, 'password_update']);
Route::get('/customer/register', [CustomerRegisterController::class, 'customer_register'])->name('customer.register');
Route::post('/customer/insert', [CustomerRegisterController::class, 'customer_insert']);
Route::get('/customer/password/reset', [CustomerController::class, 'password_reser_req'])->name('password.reset.req');
Route::post('/customer/password/store', [CustomerController::class, 'password_reser_store'])->name('password.reset.store');
Route::get('/customer/password/form/{token}', [CustomerController::class, 'password_reser_form'])->name('password.reset.form');
Route::post('/customer/password/update', [CustomerController::class, 'password_reset_update'])->name('password.reset.update');


// =================================  cart  ===============================================
// cart by master page
Route::post('/cart/store', [CartController::class, 'cart_store']);
Route::get('/cart/remove/{cart_id}', [CartController::class, 'cart_delete'])->name('cart.remove');
// cart page
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/getCartId', [CartController::class, 'cart_remove']);
Route::post('/cart/update', [CartController::class, 'cart_update'])->name('cart.update');


// =================================  Checkout  ===============================================
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/getState', [CheckoutController::class, 'get_state']);
Route::post('/getCity', [CheckoutController::class, 'get_city']);
Route::post('/checkout/insert', [CheckoutController::class, 'checkout_insert'])->name('checkout.insert');
Route::get('/order/success', [CheckoutController::class, 'order_success'])->name('order.success');

// invoice

Route::get('/order/invoice/{order_id}', [CustomerController::class, 'download_invoice'])->name('download.invoice');
Route::get('/order/invoiceview/{order_id}', [CustomerController::class, 'view_invoice'])->name('download.invoiceView');

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/ssl/pay', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END



// stripe start

Route::get('stripe', [StripePaymentController::class, 'stripe']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');


// =================================  Admin Dashboard  ======================================

// home dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/dash', [HomeController::class, 'dash']);

Route::get('/user/list', [HomeController::class, 'userList'])->name('user');
Route::get('/user/delete,{user_id}', [HomeController::class, 'userDelete'])->name('user.delete');
Route::get('/profile/change', [HomeController::class, 'profileChange'])->name('profile.change');
Route::post('/profile/name/update', [HomeController::class, 'nameChange']);
Route::post('/profile/password/update', [HomeController::class, 'passwordUpdate']);
Route::post('/profile/picture/update', [HomeController::class, 'picture_update']);



// =================================  Category  ======================================

Route::get('/add/category', [CategoryController::class, 'index'])->name('category');
Route::post('/category/insert', [CategoryController::class, 'insertCategory']);
Route::get('/edit/category/{category_id}', [CategoryController::class, 'edit'])->name('category.edit');
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


// =================================  Sub category  ======================================

Route::get('/add/subCategory', [SubcategoryController::class, 'index'])->name('subCategory');
Route::post('/subcategory/insert', [SubcategoryController::class, 'insert']);
Route::get('/edit/subcategory/{subcategory_id}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
Route::post('/subcategory/update', [SubcategoryController::class, 'update']);
Route::get('/subcategory/delete/{subcategory_id}', [SubcategoryController::class, 'delete'])->name('subcategory.delete');


// =================================  product  ======================================

Route::get('/add/product', [ProductController::class, 'index'])->name('product');
// ajax category
Route::post('/getSubcategory', [ProductController::class, 'getCategory']);
Route::post('/product/insert', [ProductController::class, 'insert']);
Route::get('/product/list', [ProductController::class, 'viewProduct'])->name('product.list');
Route::get('/edit.product/{product_id}', [ProductController::class, 'edit'])->name('edit.product');
Route::post('/product/Update', [ProductController::class, 'update']);
Route::get('/product/delete/{product_id}', [ProductController::class, 'delete'])->name('product.delete');



// =================================  Inventory  ======================================

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

// coupon

Route::get('/coupon', [CouponController::class, 'index'])->name('coupon');
Route::post('/coupon/insert', [CouponController::class, 'insert']);
Route::get('/coupon/{coupon_id}', [CouponController::class, 'delete'])->name('coupon.delete');


// Route::get('/', [FontendController::class, 'welcome']);
