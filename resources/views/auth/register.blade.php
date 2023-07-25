@extends('layouts.app')
@section('title', 'Register')
@section('content')
    <div class="container-fluid w-100 mt-5">
        <h3 class="text-center">Register</h3>
        <div class="row justify-content-center mt-5">

            <div class="col-md-4">
                <img src="{{ asset('assets/images/registration.png') }}" alt="">
            </div>

            <div class="col-md-8 px-5">


                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label for="name" class="col-md-4 col-form-label">{{ __('Name') }}</label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label for="email" class="col-md-4 col-form-label">{{ __('Email Address') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>



                    <div class="row mb-3">


                        <div class="col-md-6">
                            <label for="password" class="col-md-4 col-form-label ">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label ">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>


                    </div>

                    <div class="row mb-3">


                        <div class="col-md-6">
                            <label for="address-line-1" class="col-md-4 col-form-label ">{{ __('Address Line 1') }}</label>
                            <input id="address-line-1" type="text" class="form-control" name="address_line_1" required>
                            @error('address_line_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="address-line-2" class="col-md-4 col-form-label ">{{ __('Address Line 2') }}</label>
                            <input id="address-line-2" type="text" class="form-control" name="address_line_2" required>
                            @error('address_line_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>



                    <div class="row mb-3">


                        <div class="col-md-6">
                            <label for="region-selector" class="col-md-4 col-form-label ">{{ __('Region') }}</label>
                            <select id="region-selector" class="form-control" required name="region-selector"></select>
                            <input type="hidden" name="region" id="region" required>
                            @error('region')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="province-selector" class="col-md-4 col-form-label ">{{ __('Province') }}</label>

                            <select id="province-selector" class="form-control" required name="province-selector"></select>
                            <input type="hidden" name="province" id="province" required>
                            @error('province')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>



                    <div class="row mb-3">


                        <div class="col">
                            <label for="city-selector"
                                class="col-md-4 col-form-label ">{{ __('City/Municipality') }}</label>
                            <select id="city-selector" class="form-control" required name="city-selector"></select>
                            <input type="hidden" name="city_municipality" id="city" required>
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="postal_code" class="col-md-4 col-form-label ">{{ __('Postal Code') }}</label>
                            <input id="postal_code" class="form-control" type="number" required name="postal_code">
                            @error('postal_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="mobile_number" class="col-md-4 col-form-label ">{{ __('Mobile Number') }}</label>
                            <input id="mobile_number" type="number" class="form-control" required
                                name="mobile_number" />
                            @error('mobile_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="row ">
                        <div class="col gap-2 d-flex align-items-center justify-content-end">
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                {{ __('Back') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>



        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <!-- script type="text/javascript" src="../../jquery.ph-locations.js"></script -->
    <script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>
    <script src="{{ asset('js/ph-locations.js') }}"></script>
@endsection
