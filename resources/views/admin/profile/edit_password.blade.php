@extends('admin.layouts.sidebar')
@section('title', 'Profile')
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
                    <h4 class="page-title">Edit Password</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.profile.index') }}">Profile</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.profile.editpassword') }}">Edit Password</a></li>
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
            <section style="background-color: #eee;">
                <div class="container py-5">
            
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="card mb-4">
                        <div class="card-body text-center">
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                            class="rounded-circle img-fluid" style="width: 150px;">
                          <h5 class="my-3">{{ auth()->user()->name }}</h5>
                         

                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="card mb-4">
                        <div class="card-body">
                          <form action="{{ route('admin.profile.updatepassword') }}" method="POST">
                          @csrf
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0">Password</p>
                            </div>
                            <div class="col-sm-9">
                              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                              <span>
                              @error('password')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                              </span>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0">Confirm Password</p>
                            </div>
                            <div class="col-sm-9">
                              <input type="password" name="password_confirmation"  class="form-control @error('password_confirmation') is-invalid @enderror">
                              <span>
                              @error('password_confirmation')
                                  <p class="text-danger">{{ $message }}</p>
                              @enderror
                              </span>
                            </div>
                          </div>
                          <hr>
                          <div class="row py-4">
                            <div class="col-md-12 d-flex align-items-end justify-content-end pb-3">

                                <a href="{{ route('admin.profile.index') }}" class="btn btn-outline-primary ms-1">Cancel</a>
                                <button type="submit" class="btn btn-outline-primary ms-1">Update</button>
                                
                            </div>
                          </div>
                          </form>

                          {{-- <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">(097) 234-5678</p>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0">Mobile</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">(098) 765-4321</p>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
                            </div>
                          </div> --}}
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </section>

            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->




    @endsection
