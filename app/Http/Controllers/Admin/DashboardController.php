<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Xendit\Xendit;

class DashboardController extends Controller
{

    public function __construct()
    {
        Xendit::setApiKey(env('XENDIT_API_KEY'));
    }

    public function index()
    {

        $allInvoice  =  \Xendit\Invoice::retrieveAll();
        
        $totalPaidAmount = 0;
        foreach ($allInvoice as $order) {
            if ($order['status'] === 'PAID') {
                $totalPaidAmount += $order['paid_amount'];
            }
        }



        $product_count = Product::count();
        $category_count = Category::count();
        $brand_count = Brand::count();
        $user_count = User::where('is_admin',false)->where('is_active',true)->count();
        $order_count = Order::whereNotIn('status',['Cancelled'])->count();
        $total_sales = number_format($totalPaidAmount,2);
        $latest_products = Product::with(['category','brand','stock','media'])->orderByDesc('created_at')->limit(3)->get();

        $categories_count = Category::withCount('products')->pluck('products_count','name');
        $brands_count = Brand::withCount('products')->pluck('products_count','name');

        $new_users = User::where('is_admin',false)->where('is_active',true)->with(['address','mobile_number'])->limit(3)->orderByDesc('created_at')->get();

        return view('admin.dashboard',compact('product_count','category_count','brand_count','user_count','latest_products','categories_count','brands_count','new_users','order_count','total_sales'));
    }
}
