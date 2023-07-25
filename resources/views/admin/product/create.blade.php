@extends('admin.layouts.sidebar')
@section('title', 'Product Category')
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
                    <h4 class="page-title">Add Product</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('products.create') }}">Add Product</a></li>
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

            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label>Brand</label>
                            <select name="brand" class="form-control @error('brand') is-invalid @enderror">
                                @foreach ($brands as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            <span>
                                @error('brand')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control @error('category') is-invalid @enderror">
                                @foreach ($categories as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>

                            <span>
                                @error('category')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name"
                                class="form-control @error('category') is-invalid @enderror" value="{{ old('product_name') }}">
                            <span>
                                @error('product_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control  @error('price') is-invalid @enderror" value="{{ old('price') }}">
                            <span>
                                @error('price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" name="product_image"
                                class="form-control @error('product_image') is-invalid @enderror"
                                accept=".png, .jpeg, .jpg">
                            <span>
                                @error('product_image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col">

                        <div class="row">
                            <div class="col">
                                <label for="">Small</label>
                                <input type="number" name="small_stock"
                                    class="form-control @error('small_stock') is-invalid @enderror" value="0" >
                                <span>
                                    @error('small_stock')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>

                            <div class="col">
                                <label>Medium</label>
                                <input type="number" name="medium_stock"
                                    class="form-control @error('medium_stock') is-invalid @enderror" value="0">
                                <span>
                                    @error('medium_stock')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>

                            <div class="col">
                                <label for="">Large</label>
                                <input type="number" name="large_stock"
                                    class="form-control @error('large_stock') is-invalid @enderror" value="0">
                                <span>
                                    @error('large_stock')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>

                            <div class="col">
                                <label>Extra Large</label>
                                <input type="number" name="extra_large_stock"
                                    class="form-control @error('extra_large_stock') is-invalid @enderror" value="0">
                                <span>
                                    @error('extra_large_stock')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="text-center mt-2">Stocks</h4>
                        </div>
                    </div>



                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id=""
                                cols="5" rows="5" style="resize: none">{{ old('description') }}</textarea>
                            <span>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-2 float-end">Add Product</button>
            </form>




            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->




    @endsection
