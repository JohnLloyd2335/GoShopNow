<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function showProduct($id){

        $product = Product::with(['category', 'brand', 'media', 'stock'])
            ->select('id', 'name', 'price', 'description', 'products.brand_id', 'products.category_id')->findOrFail($id);

        return view('customer.show_product',compact('product'));

    }

}
