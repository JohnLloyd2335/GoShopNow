<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Product::with(['category', 'brand', 'media', 'stock'])
                ->select('id', 'name', 'price', 'products.brand_id', 'products.category_id')
                ->get();

            $data->map(function ($item) {
                $item->image = asset($item->getFirstMediaUrl("product_images"));
                $item->stocks = $item->stock;
                return $item;
            });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return '<img src="' . $row->image . '" alt="Product Image" class="img-thumbnail" style="width: 200px; height: 200px">';
                })
                ->addColumn('action', function ($row) {
                    $viewRoute = route('products.show', $row->id);
                    $editRoute = route('products.edit', $row->id);
                    $deleteRoute = route('products.destroy', $row->id);

                    $actionBtn = "<div class='d-flex align-items-center justify-content-center gap-1'>";
                    $actionBtn .= '<a href="' . $viewRoute . '" class="text-light view btn btn-success btn-sm"><span class="mdi mdi-eye"></span></a>';

                    $actionBtn .= '<a href="' . $editRoute . '" class="text-light edit btn btn-primary btn-sm"><span class="mdi mdi-pencil"></span></a>';

                    $actionBtn .= '
                    <form action="' . $deleteRoute . '" method="POST" style="display: inline-block">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="submit" class="text-light delete btn btn-danger btn-sm"><span class="mdi mdi-delete"></span></button>
                    </form>';
                    $actionBtn .= "</div>";

                    return $actionBtn;
                })
                ->addColumn('stock', function ($row) {
                    $columnValue = '';
                    foreach ($row->stock as $stock) {
                        $columnValue .= "<span>" . $stock->size_name . "(" . $stock->quantity . ") </span>";
                    }

                    return $columnValue;
                })
                ->rawColumns(['image', 'action', 'stock'])
                ->make(true);
        }

        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        return view('admin.product.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'brand_id' => $request->input('brand'),
            'category_id' => $request->input('category'),
            'description' => $request->input('description')
        ]);

        $product->addMediaFromRequest('product_image', 'product_image_' . $product->id)->toMediaCollection('product_images');

        $product_stocks = [
            "S" => $request->input("small_stock"),
            "M" => $request->input("medium_stock"),
            "L" => $request->input("large_stock"),
            "XL" => $request->input("extra_large_stock"),
        ];

        foreach ($product_stocks as $key => $value) {
            ProductStock::create([
                'product_id' => $product->id,
                'size_name' => $key,
                'quantity'  => $value
            ]);
        }

        return redirect(route('products.index'))->with('success', 'Product Successfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $product = Product::with(['category', 'brand', 'media', 'stock'])
            ->select('id', 'name', 'price', 'description', 'products.brand_id', 'products.category_id')->findOrFail($id);

        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with(['category', 'brand', 'media', 'stock'])
            ->select('id', 'name', 'price', 'description', 'products.brand_id', 'products.category_id')->findOrFail($id);

        $categories = Category::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');

        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {


        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'brand_id' => $request->input('brand'),
            'category_id' => $request->input('category'),
            'description' => $request->input('description')
        ]);

        if ($request->hasFile('product_image')) {
            $product->clearMediaCollection('product_images');
            $product->addMediaFromRequest('product_image', 'product_image_' . $product->id)->toMediaCollection('product_images');
        }


        $product_sizes_stock = [
            "S" => $request->input("S"),
            "M" => $request->input("M"),
            "L" => $request->input("L"),
            "XL" => $request->input("XL"),
        ];



        foreach ($product_sizes_stock as $size => $quantity) {
            $productStock = $product->stock()->firstOrNew(['size_name' => $size]);
            $productStock->quantity = $quantity;
            $productStock->save();
        }

        return redirect(route('products.index'))->with('success', "Product Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect(route('products.index'))->with('success', "Product Successfully Deleted");
    }
}
