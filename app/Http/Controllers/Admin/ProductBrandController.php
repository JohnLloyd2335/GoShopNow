<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;


class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::select('id', 'name');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editRoute = route('product_brands.edit', $row->id);
                    $deleteRoute = route('product_brands.destroy', $row->id);

                    $actionBtn = '<a href="' . $editRoute . '" class="text-light edit btn btn-primary btn-sm"><span class="mdi mdi-pencil"></span></a> ';
                    $actionBtn .= '
                    <form action="' . $deleteRoute . '" method="POST" style="display: inline-block">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="submit" class="text-light delete btn btn-danger btn-sm"><span class="mdi mdi-delete"></span></button>
                    <form/>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.product_brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product_brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        Brand::create([
            'name' => $request->input('name')
        ]);

        return redirect(route('product_brands.index'))->with('success', 'Brand Successfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.product_brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, string $id)
    {
        $brand = Brand::findOrFail($id);

        $brand->update([
            'name' => $request->input('name')
        ]);

        return redirect(route('product_brands.index'))->with('success','Brand Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);

        $brand->delete();

        return redirect(route('product_brands.index'))->with('success','Brand Successfully Deleted');
    }
}
