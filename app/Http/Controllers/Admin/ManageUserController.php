<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Address;
use App\Models\MobileNumber;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()){
            $data = User::with(['address','mobile_number'])
            ->select('id', 'name', 'email', 'password','is_active')
            ->where('is_admin', false)
            ->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('mobile_number', function($row){
                return $row->mobile_number->mobile_number;
            })
            ->addColumn('address', function($row){
                return $row->address->address_line_1." ".$row->address->address_line_2." ".$row->address->city_municipality.", ".$row->address->province.", ".$row->address->region." (".$row->address->postal_code.")";
            })
            ->addColumn('status', function($row){

                if($row->is_active){
                    return "<p class='bg-success text-light px-1 rounded text-center'>Active<p>";
                }
                else{
                    return "<p class='bg-danger text-light px-1 rounded text-center'>Inactive<p>";
                }
          

            })
            ->addColumn('action', function ($row) {
                $viewRoute = route('manage_users.show', $row->id);
                $editRoute = route('manage_users.edit', $row->id);
            

                $actionBtn = "<div class='d-flex align-items-center justify-content-center gap-1'>";
                $actionBtn .= '<a href="' . $viewRoute . '" class="text-light view btn btn-success btn-sm"><span class="mdi mdi-eye"></span></a>';

                $actionBtn .= '<a href="' . $editRoute . '" class="text-light edit btn btn-primary btn-sm"><span class="mdi mdi-pencil"></span></a>';

                $actionBtn .= "</div>";

                return $actionBtn;
            })
   
            ->rawColumns(['mobile_number','address','status','action'])
            ->make(true);
        }
        

        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {

        $user = User::findOrFail($id);

        $status = $request->input('status') == "1" || $request->input('status') == 1 ? 1 : 0;

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        $user->update([
            'is_active' => $status
        ]);

        $user->address->update([
            "address_line_1" => $request->input('address_line_1'),
            "address_line_2" => $request->input('address_line_1'),
            "region" => $request->input('region'),
            "province" => $request->input('province'),
            "city_municipality" => $request->input('city_municipality'),
            "postal_code" => $request->input('postal_code')
        ]);

        $user->mobile_number->update([
            'mobile_number' => $request->input('mobile_number')
        ]);

        return redirect(route('manage_users.index'))->with('success','User Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
