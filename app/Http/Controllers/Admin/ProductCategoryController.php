<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select('id','name');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editRoute = route('product_categories.edit', $row->id);
                    $deleteRoute = route('product_categories.destroy', $row->id);
                
                    $actionBtn = '<a href="' . $editRoute . '" class="text-light edit btn btn-primary btn-sm"><span class="mdi mdi-pencil"></span></a> ';
                    $actionBtn .= '
                    <form action="'.$deleteRoute.'" method="POST" style="display: inline-block">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="submit" class="text-light delete btn btn-danger btn-sm"><span class="mdi mdi-delete"></span></button>
                    <form/>';
                
                    return $actionBtn;
                })                
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('admin.product_category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'name' => $request->input('name')
        ]);


        return redirect(route('product_categories.index'))->with('success','Category Successfully Added');
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

       $category = Category::findOrFail($id);

       return view('admin.product_category.edit',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->input('name')
        ]);

        return redirect(route('product_categories.index'))->with('success','Category Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect(route('product_categories.index'))->with('success','Category Successfully Deleted');
    }
}
