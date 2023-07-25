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
                                <li class="breadcrumb-item"><a href="{{ route('manage_users.show', $user->id) }}">View User</a></li>
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
            <div class="row gx-4 gx-lg-5 align-items-start px-2" >
              <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0"  src="https://via.placeholder.com/300" alt="User Image"/>
              </div>
              <div class="col-md-6">
                
                <p class="lead"><span class="h5">Name: </span>{{ $user->name }}</p>
                <p class="lead"><span class="h5">Email: </span>{{ $user->email }}</p>
                <p class="lead"><span class="h5">Address: </span>{{ $user->address->address_line_1." ".$user->address->address_line_2." ".$user->address->city_municipality.", ".$user->address->province.", ".$user->address->region." (".$user->address->postal_code.")"; }}</p>
                <p class="lead"><span class="h5">Mobile Number: </span>{{ $user->mobile_number->mobile_number }}</p>  
                <p class="lead"><span class="h5">Status: </span> 
                @switch($user->is_active)
                    @case(0)
                        <span class="bg-danger px-1 text-light rounded">Inactive</span>
                        @break
                    @case(1)
                        <span class="bg-success px-1 text-light rounded">Active</span>
                        @break
                    @default
                        
                @endswitch
                </p>
              </div>
            </div>





            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->




    @endsection
