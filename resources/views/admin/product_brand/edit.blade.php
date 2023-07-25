@extends('admin.layouts.sidebar')
@section('title','Product Category')
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
                    <h4 class="page-title">Edit Brand</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('product_brands.index') }}">Product Brand</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('product_brands.edit', $brand->id) }}">Edit Brand</a></li>
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
        <div class="container-fluid">
          <!-- Start Page Content -->

            <form action="{{ route('product_brands.update', $brand->id) }}" method="post">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label>Brand Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $brand->name }}">
                <span>
                  @error('name')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </span>
                <button type="submit" class="btn btn-primary mt-2 float-end">Update</button>
              </div>
            </form>

          


          <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->

       

          
    @endsection
