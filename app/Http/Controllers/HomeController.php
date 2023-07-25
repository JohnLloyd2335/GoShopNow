<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function redirectTo()
    {
        if (auth()->user()->is_admin) {
            return route('adminDashboard.index');
        } else {
            return '/';
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $productsQuery = Product::select('id', 'name', 'price')->with(['media']);

            if (isset($request->cat_id)) {
                $productsQuery->where('category_id', $request->cat_id);
            }

            if (isset($request->brand_id)) {
                $productsQuery->where('brand_id', $request->brand_id);
            }
            $productsQuery->inRandomOrder();
            $products = $productsQuery->paginate(6);
            $product_count = $products->total();

            return response()->json([
                'products' => $products, 
                'product_count' => $product_count,
            ]);
        }

        $categories = Category::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');
        $product_count = Product::count();
        $products = Product::select('id', 'name', 'price')->with(['media'])->inRandomOrder()->paginate(6);

        return view('customer.home', compact('categories', 'brands', 'products', 'product_count'));
    }

    public function filterWithPriceRange(Request $request){

        if($request->input('min') > $request->input('max')){
            return redirect(route('home'))->with('error', 'Max Price must be greaterthan Min Price');
        }

        $validated = $request->validate([
            'min' => ['required','min:0', 'numeric'],
            'max' => ['required','min:0', 'numeric','gte:min']
        ]);

        $productsQuery = Product::select('id', 'name', 'price')->with(['media']);

        if(isset($request->category)){
            $productsQuery->where('category_id', $request->cat_id);
        }

        if (isset($request->brand)) {
            $productsQuery->where('brand_id', $request->brand_id);
        }

        $productsQuery->whereBetween('price',[$request->input('min'),$request->input('max')]);
        $productsQuery->inRandomOrder();
        $products = $productsQuery->paginate(6);
        $product_count = $products->count();
        $categories = Category::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');

        return view('customer.home', compact('categories', 'brands', 'products', 'product_count'));
    }

    public function searchProductByName(Request $request){

        $products = Product::where('name', 'like', '%' . $request->input('search') . '%')->inRandomOrder()->paginate(6);

        $product_count = $products->count();
        $categories = Category::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');

        return view('customer.home', compact('categories', 'brands', 'products', 'product_count'));
    }


}
