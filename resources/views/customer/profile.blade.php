@extends('customer.layouts.header-footer')
@section('title', 'Profile')
@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="d-flex mb-2">
    <h6 class="mb-0">
        <a href="{{ route('home') }}" class="text-white-50">Home</a>
        <span class="text-white-50 mx-2"> > </span>
        <a href="{{ route('profile') }}" class="text-white-50">Profile</a>
    </h6>
</nav>
<!-- Breadcrumb -->
@endsection
@section('content')
    <!-- sidebar + content -->
    <section class="">
        <div class="container-fluid my-5">
          
            <!-- Start Page Content -->
            <section style="background-color: #eee;">
              <div class="container py-5">
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
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
                        <form action="{{ route('updateProfile') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0">Full Name</p>
                          </div>
                          <div class="col-sm-9">
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control @error('name') is-invalid @enderror">
                            <span>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            </span>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                          </div>
                          <div class="col-sm-9">
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control @error('email') is-invalid @enderror">
                            <span>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            </span>
                          </div>
                        </div>
                        <hr>

                        <div class="row">
                          <div class="col-sm-3">
                            <p class="mb-0">Mobile Number</p>
                          </div>
                          <div class="col-sm-9">
                            <input type="number" name="mobile_number" value="{{ auth()->user()->mobile_number->mobile_number }}" class="form-control @error('mobile_number') is-invalid @enderror">
                            <span>
                            @error('mobile_number')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            </span>
                          </div>
                        </div>
                        <hr>


                        <div class="row py-4">
                          <div class="col-md-12 d-flex align-items-end justify-content-end pb-3">
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
    </section>

@endsection
