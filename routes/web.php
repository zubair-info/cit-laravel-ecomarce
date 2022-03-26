<?php

use App\Http\Controllers\FontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;

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
Route::get('/add/category', [CategoryController::class, 'index'])->name('add.category');
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




Route::get('/', [FontendController::class, 'welcome']);
