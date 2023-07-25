<?php

use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\ProductBrandController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController as CustomerProfileController;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes(['verify' => true]);
 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::group(['middleware' => ['verified','customer']], function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('home/filter-products', [HomeController::class, 'index'])->name('filteredProducts');
    Route::get('home/filter-products-with-price-range', [HomeController::class, 'filterWithPriceRange'])->name('filterProductsWithPriceRange');
    Route::post('/home', [HomeController::class, 'searchProductByName'])->name('searchProductByName');

    Route::get('/product/{id}', [ProductController::class,'showProduct'])->name('showProduct');

    Route::post('/add_to_cart/{id}', [CartController::class,'create'])->name('addToCart');

    Route::get('/cart',[CartController::class,'show'])->name('showCart');

    Route::delete('/cart/{id}/delete', [CartController::class,'destroy'])->name('deleteCartItem');

    Route::get('/profile',[CustomerProfileController::class,'index'])->name('profile');
    Route::put('/profile/update',[CustomerProfileController::class,'update'])->name('updateProfile');
    Route::get('/profile/change_password',[CustomerProfileController::class,'changePassword'])->name('changePassword');
    Route::put('/profile/update_password',[CustomerProfileController::class,'updatePassword'])->name('updatePassword');

    
});



Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin'], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('adminDashboard.index');

    Route::resource('product_categories',ProductCategoryController::class);
    Route::resource('product_brands',ProductBrandController::class);
    Route::resource('products', AdminProductController::class);

    Route::get('archives',[ArchiveController::class,'index'])->name('archives.index');
    Route::get('archives/{id}',[ArchiveController::class,'show'])->name('archives.show');
    Route::post('archives/{id}/restore', [ArchiveController::class, 'restore'])->name('archives.restore');

    Route::resource('manage_users', ManageUserController::class)->except(['create','store','destroy']);

    Route::get('profile', [ProfileController::class,'index'])->name('admin.profile.index');
    Route::get('profile/edit_account_details',[ProfileController::class,'edit_account_details'])->name('admin.profile.editaccountdetails');
    Route::post('profile/update_account_details', [ProfileController::class, 'update_account_details'])->name('admin.profile.updateaccountdetails');

    Route::get('profile/edit_password',[ProfileController::class, 'edit_password'])->name('admin.profile.editpassword');
    Route::post('profile/update_password',[ProfileController::class, 'update_password'])->name('admin.profile.updatepassword');
});

Route::view('/sample','sample');