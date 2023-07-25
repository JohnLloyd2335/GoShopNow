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
                    <h4 class="page-title">View Archive Product</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('archives.index') }}">Archives</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('archives.show', $product->id) }}">View Archive Product</a></li>
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
                <img class="card-img-top mb-5 mb-md-0"  src="{{ asset($product->getFirstMediaUrl('product_images')); }}" alt="Product Image"/>
              </div>
              <div class="col-md-6">
                
                <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                <p class="lead"><span class="h5">Category: </span>{{ $product->category->name }}</p>
                <p class="lead"><span class="h5">Brand: </span> {{ $product->brand->name }}</p>
                <p class="lead"><span class="h5">Price: </span> ₱{{ number_format($product->price,2) }}</p>  
                <p class="lead"><span class="h5">Description: </span></p>
                <p class="lead" style="text-align: justify; text-justify:">{{ $product->description }}</p>

              
                  <p><strong class="h5">Stocks: </strong></p>
                  <p class="lead">
                    @foreach($product->stock as $stockItem)
                      @if ($loop->last)
                        {{ $stockItem->size_name."(".$stockItem->quantity.")"}}
                      @else
                        {{ $stockItem->size_name."(".$stockItem->quantity."), " }}
                      @endif
                    @endforeach
                  </p>
                
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
