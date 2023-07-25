@extends('layouts.app')
@section('title', 'Send Password Reset Link')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           
               <h3 class="text-center">Reset Password</h3>

               
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex align-items-center justify-content-center flex-column gap-2">
                        <img src="{{ asset('assets/images/forgotpassword.png') }}" alt="">
                        <p class="lead">Provide email address to send password reset link</p>
                    </div>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3 d-flex align-items-center justify-content-center">
                            <div class="col-md-6 ">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 d-flex align-items-center justify-content-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>



        </div>
    </div>
</div>
@endsection
