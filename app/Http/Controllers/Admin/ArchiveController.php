<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            
            $data = Product::onlyTrashed()
                ->with(['category', 'brand', 'media', 'stock'])
                ->select('id', 'name', 'price', 'brand_id', 'category_id')
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
                    $viewRoute = route('archives.show', $row->id);
                    $restoreRoute = route('archives.restore', $row->id);

                    $actionBtn = "<div class='d-flex align-items-center justify-content-center gap-1'>";
                    $actionBtn .= '<a href="' . $viewRoute . '" class="text-light view btn btn-success btn-sm"><span class="mdi mdi-eye"></span></a>';
                    $actionBtn .= '
                    <form action="' . $restoreRoute . '" method="POST" style="display: inline-block">
                    ' . csrf_field() . '
                    <button type="submit" class="text-light delete btn btn-danger btn-sm"><span class="mdi mdi-delete"></span></button>';

                    $actionBtn .= "</form></div>";

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

        return view('admin.archive.index');
    }

    public function show($id){
        $product = Product::onlyTrashed()
        ->with(['category', 'brand', 'media', 'stock'])
        ->select('id', 'name', 'price', 'description', 'products.brand_id', 'products.category_id')->findOrFail($id);

        return view('admin.archive.show', compact('product'));
    }

    public function restore($id){

        $product = Product::withTrashed()->findOrFail($id);

        if ($product->trashed()) {
            $product->restore();
            return redirect(route('archives.index'))->with('success', "Product Successfully Restored");
        } else {
            return redirect(route('archives.index'))->with('error', "Product not found or not soft deleted.");
        }
        
    }
}
