@extends('layouts.app')
@section('title', 'Verify Account')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="d-flex align-items-center justify-content-center flex-column gap-2">
                    @if(session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <img src="{{ asset('assets/images/check-email.png') }}" alt="" height="600">
                    <h3 class="text-danger">Oops your account is not verified</h3>
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit"
                            class="btn btn-primary">{{ __('Click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
