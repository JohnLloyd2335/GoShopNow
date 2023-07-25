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
                    <h4 class="page-title">Edit Product</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('products.edit', $product->id) }}">Edit
                                        Product</a></li>

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
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <!-- Start Page Content -->
                <div class="row gx-4 gx-lg-5 align-items-start px-2">
                    <div class="col-md-6">
                        <label class="text-light">Product Image</label>
                        <img class="card-img-top mb-5 mb-md-0"
                            src="{{ asset($product->getFirstMediaUrl('product_images')) }}" alt="Product Image" />
                        <label class="mt-3">Product Image</label>
                        <input type="file" name="product_image"
                            class="form-control mt-1 @error('product_image') is-invalid @enderror"
                            accept=".png, .jpeg, .jpg">
                        @error('product_image')
                          <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror    
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name"
                                class="form-control @error('product_name') is-invalid @enderror"
                                value="{{ $product->name }}">
                            @error('product_name')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control @error('category') is-invalid @enderror">
                                @foreach ($categories as $key => $value)
                                    <option @selected($product->category->id == $key) value="{{ $key }}">{{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Brand</label>
                            <select name="brand" class="form-control @error('brand') is-invalid @enderror">
                                @foreach ($brands as $key => $value)
                                    <option @selected($product->brand->id == $key) value="{{ $key }}">{{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                value="{{ $product->price }}">
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" cols="4" rows="4" style="resize: none">{{ $product->description }}</textarea>
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-center">Stocks</label>
                            <div class="row">

                                @foreach ($product->stock as $stock)
                                    <div class="col">
                                        <label>{{ $stock->size_name }}</label>
                                        <input type="number" name="{{ $stock->size_name }}" class="form-control"
                                            value="{{ $stock->quantity }}">
                                    </div>

                                    @error($stock->size_name)
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                @endforeach

                            </div>
                        </div>


                        <div class="form-group float-end">
                          <button type="submit" class="btn btn-primary btn-lg">Update</button>
                        </div>




            </form>


            {{-- <div class="d-flex gap-3 flex-column">
                  <h5>Sizes:</h5>
                  <div class="d-flex align-items-center justify-content-around gap-4">
                    <!-- Radio buttons for selecting sizes -->
                  </div>
                  <div class="d-flex align-items-start gap-2">
                    <h5 class="mt-1">Quantity:</h5>
                    <input class="form-control text-center me-3" id="quantityInput" name="quantity" type="number"  value="1" min="1" style="max-width: 4rem" />
                  </div>
                  <button id="addToCartButton"  class="btn btn-primary flex-shrink-0 py-2" type="submit">
                    Add to cart
                  </button>
                </div> --}}
        </div>
    </div>





    <!-- End PAge Content -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->




@endsection
