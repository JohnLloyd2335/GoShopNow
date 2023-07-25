<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAccountDetailsRequest;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile.index');
    }

    public function edit_account_details(){
        return view('admin.profile.edit_account_details');
    }

    public function update_account_details(UpdateAccountDetailsRequest $request){

        $user_data = $request->validated();

        User::findOrFail(auth()->user()->id)->update($user_data);

        return redirect(route('admin.profile.index'))->with('success','Account Details Successfully Updated');

    }

    public function edit_password(){

        return view('admin.profile.edit_password');
    }

    public function update_password(UpdatePasswordRequest $request){

        User::findOrFail(auth()->user()->id)->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return redirect(route('admin.profile.index'))->with('success','Password Successfully Changed');
    }
}
