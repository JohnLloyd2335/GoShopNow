<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {

        return view('customer.profile');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            'mobile_number' => ['required', 'numeric', 'digits:11'],
        ]);

        // Validate the request data
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update user's name, email, and mobile number
        auth()->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile_number' => $request->input('mobile_number')
        ]);

        return redirect(route('profile'))->with('success', 'Account Details Successfully Updated');
    }

    public function changePassword(){

        return view('customer.change_password');
    }

    public function updatePassword(Request $request){

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        // Validate the request data
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        auth()->user()->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return redirect(route('changePassword'))->with('success', 'Password Successfully Changed');

    }
}
