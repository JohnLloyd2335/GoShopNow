<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $product_count = Product::count();
        $category_count = Category::count();
        $brand_count = Brand::count();
        $user_count = User::where('is_admin',false)->where('is_active',true)->count();
        $latest_products = Product::with(['category','brand','stock','media'])->orderByDesc('created_at')->limit(3)->get();

        $categories_count = Category::withCount('products')->pluck('products_count','name');
        $brands_count = Brand::withCount('products')->pluck('products_count','name');

        $new_users = User::where('is_admin',false)->where('is_active',true)->with(['address','mobile_number'])->limit(3)->orderByDesc('created_at')->get();

        return view('admin.dashboard',compact('product_count','category_count','brand_count','user_count','latest_products','categories_count','brands_count','new_users'));
    }
}
