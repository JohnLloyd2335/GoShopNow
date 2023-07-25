@extends('customer.layouts.header-footer')
@section('title', 'Product')
@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="d-flex mb-2">
    <h6 class="mb-0">
        <a href="{{ route('home') }}" class="text-white-50">Home</a>
        <span class="text-white-50 mx-2"> > </span>
        <a href="{{ route('showProduct',$product->id) }}" class="text-white-50">Product</a>
    </h6>
</nav>
<!-- Breadcrumb -->
@endsection
@section('content')
    <!-- sidebar + content -->
    <section class="">
        <div class="container-fluid my-5">
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
            <!-- Start Page Content -->
            <div class="row gx-4 gx-lg-5 align-items-start px-2">
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <img class="card-img-top mb-5 mb-md-0" height="600"
                        src="{{ asset($product->getFirstMediaUrl('product_images')) }}" alt="Product Image" />
                </div>
                <div class="col-md-6">

                    <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                    <p class="lead"><span class="h5">Category: </span>{{ $product->category->name }}</p>
                    <p class="lead"><span class="h5">Brand: </span> {{ $product->brand->name }}</p>
                    <p class="lead"><span class="h5 ">Price: </span> ₱{{ number_format($product->price, 2) }}</p>
                    <p class="lead"><span class="h5">Description: </span></p>
                    <p class="lead" style="text-align: justify; text-justify:"><span>{{ $product->description }}</span>
                    </p>


                    <p><strong class="h5">Stocks: </strong></p>
                    <p class="lead">
                        @foreach ($product->stock as $stockItem)
                            @if ($loop->last)
                                {{ $stockItem->size_name . '(' . $stockItem->quantity . ')' }}
                            @else
                                {{ $stockItem->size_name . '(' . $stockItem->quantity . '), ' }}
                            @endif
                        @endforeach
                    </p>
                    <hr>
                    <form action="{{ route('addToCart',$product->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="d-flex gap-3 flex-column">
                
                            <h5>Sizes:</h5>
                            <div class="d-flex align-items-center justify-content-arround gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" id="exampleRadios2"
                                        value="S" required checked>
                                    <label class="form-check-label" for="exampleRadios2">
                                        S
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" id="exampleRadios3"
                                        value="M" required>
                                    <label class="form-check-label" for="exampleRadios3">
                                        M
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" id="exampleRadios4"
                                        value="L" required>
                                    <label class="form-check-label" for="exampleRadios4">
                                        L
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" id="exampleRadios5"
                                        value="XL" required>
                                    <label class="form-check-label" for="exampleRadios5">
                                        XL
                                    </label>
                                </div>

                            </div>
                            <div class="d-flex align-items-start gap-2">
                                <h5 class="mt-1">Quantity:</h5> <input class="form-control text-center me-3"
                                    id="quantityInput" name="quantity" type="number" max="${product.stocks}" value="1"
                                    min="1" style="max-width: 4rem" />
                            </div>
                            <button id="addToCartButton" data-product='${productString}'
                                class="btn btn-primary flex-shrink-0 py-2 w-100" type="submit">
                                Add to cart
                            </button>


                        </div>
                    </form>

                </div>
            </div>





            <!-- End PAge Content -->
        </div>
    </section>

@endsection
