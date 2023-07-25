@extends('admin.layouts.sidebar')
@section('title', 'Manage User')
@section('content')


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">View User</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('manage_users.index') }}">Users</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('manage_users.show', $user->id) }}">Edit
                                        User</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid mt-5">
            <!-- Start Page Content -->
            <div class="row gx-4 gx-lg-5 align-items-start px-2">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="https://via.placeholder.com/300" alt="User Image" />
                </div>
                <div class="col-md-6">

                    <form action="{{ route('manage_users.update', $user->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">

                            <div class="col">
                                <label>Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                                <span>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>  

                            <div class="col">
                                <label>Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                                <span>
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>

                        </div>

                        <div class="row mt-1">

                            <div class="col">
                                <label>Address Line 1</label>
                                <input type="text" name="address_line_1"
                                    class="form-control @error('address_line_1') is-invalid @enderror"
                                    value="{{ $user->address->address_line_1 }}">
                                <span>
                                    @error('address_line_1')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>

                            <div class="col">
                                <label>Address Line 2</label>
                                <input type="text" name="address_line_2"
                                    class="form-control @error('address_line_2') is-invalid @enderror"
                                    value="{{ $user->address->address_line_2 }}">
                                <span>
                                    @error('address_line_2')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>

                        </div>

                        <div class="row mt-1">

                            <div class="col">
                                <label>Region</label>
                                <select id="region-selector" class="form-control" required name="region-selector"></select>
                                <input type="hidden" name="region" id="region" required>
                                @error('region')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label>Province</label>
                                <select id="province-selector" class="form-control" required
                                    name="province-selector"></select>
                                <input type="hidden" name="province" id="province" required>
                                @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mt-1">

                            <div class="col">
                                <label>City/Municipality</label>
                                <select id="city-selector" class="form-control" required name="city-selector"></select>
                                <input type="hidden" name="city_municipality" id="city" required>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label>Postal Code</label>
                                <input id="postal_code" class="form-control" type="number" required name="postal_code"
                                    value="{{ $user->address->postal_code }}">
                                @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mt-1">

                            <div class="col">
                                <label>Mobile Number</label>
                                <input type="number" name="mobile_number"
                                    class="form-control @error('mobile_number') is-invalid @enderror"
                                    value="{{ $user->mobile_number->mobile_number }}">
                                @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col">
                                <label>Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mt-3 float-end">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>


                </div>
                </form>
            </div>





            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->



        <script src="{{ asset('js/ph-locations.js') }}"></script>
    @endsection
