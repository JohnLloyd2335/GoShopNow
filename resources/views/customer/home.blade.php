@extends('customer.layouts.header-footer')
@section('title', 'Home')
@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="d-flex mb-2">
    <h6 class="mb-0">
        <a href="{{ route('home') }}" class="text-white-50">Home</a>
        {{-- <span class="text-white-50 mx-2"> > </span>
        <a href="" class="text-white-50">Library</a>
        <span class="text-white-50 mx-2"> > </span>
        <a href="" class="text-white"><u>Data</u></a> --}}
    </h6>
</nav>
<!-- Breadcrumb -->
@endsection
@section('content')
    <!-- sidebar + content -->
    <section class="">
        <div class="container">
            <div class="row">
                <!-- sidebar -->
                <div class="col-lg-3">
                    <!-- Toggle button -->
                    <button class="btn btn-outline-secondary mb-3 w-100 d-lg-none" type="button" data-mdb-toggle="collapse"
                        data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span>Show filter</span>
                    </button>
                    <!-- Collapsible wrapper -->
                    <div class="collapse card d-lg-block mb-5" id="navbarSupportedContent">
                        <form action="{{ route('filterProductsWithPriceRange') }}" method="get">
                            @csrf
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseOne"
                                            aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                            Category
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne">
                                        <div class="accordion-body">
                                            <select name="category" class="form-control" id="category">
                                                <option selected disabled>SELECT CATEGORY</option>
                                                @foreach ($categories as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseTwo"
                                            aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                            Brands
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo">
                                        <div class="accordion-body">
                                            <select name="brand" class="form-control" id="brand">
                                                <option selected disabled>SELECT BRAND</option>
                                                @foreach ($brands as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseThree"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                            Price
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree">
                                        <div class="accordion-body">
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        Min
                                                    </p>
                                                    <div class="form-outline">
                                                        <input type="number" name="min" id="typeNumber"
                                                            class="form-control @error('min') is-invalid @enderror" value="0"/>

                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        Max
                                                    </p>
                                                    <div class="form-outline">
                                                        <input type="number" name="max" id="typeNumber"
                                                            class="form-control @error('max') is-invalid @enderror" value="0" />

                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-white w-100 border border-secondary mb-2">Apply</button>
                                            <a href="{{ route('home') }}"
                                                class="btn btn-white w-100 border border-secondary">Clear</a>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </form>
                    </div>
                </div>
                <!-- sidebar -->
                <!-- content -->
                <div class="col-lg-9">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row pb-1">
                        <form action="{{ route('searchProductByName') }}" method="post" style="display: inline-block">
                            <div class="col-lg-12 col-md-12 col-12 d-flex align-items-center justify-content-between gap-2">

                                @csrf
                                <input type="search" name="search" id="form1" class="form-control"
                                    placeholder="Search..." />
                                <button type="submit" class="btn btn-primary shadow-0">
                                    <i class="fas fa-search"></i>
                                </button>


                            </div>
                        </form>
                    </div>
                    <header class="d-sm-flex align-items-center border-bottom mb-1 pb-1">

                        <strong class="d-block py-2"><span id="product_count"> {{ $product_count }} </span> Total
                            Products</strong>

                    </header>

                    <div class="row" id="filteredResults">
                        @forelse ($products as $product)
                            <a class="col-lg-4 col-md-6 col-sm-6 d-flex" style="text-decoration: none; cursor: pointer" href="{{ route('showProduct', $product->id) }}">
                                <div class="card w-100 my-2 shadow-2-strong">
                                    <img src="{{ $product->getFirstMediaUrl('product_images') }}" class="card-img-top"
                                        height="300" />
                                    <div class="card-body d-flex flex-column">
                                        <h3>{{ $product->name }}</h3>
                                        <h5 class="card-title text-danger">₱{{ $product->price }}</h5>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-md-12 d-flex align-items-center justify-content-center py-5">
                                <h3>No Products Found.</h3>
                            </div>
                        @endforelse


                    </div>

                    <hr />

                    <div id="pagination">
                        <!-- Pagination -->
                        {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
                        <!-- Pagination -->
                    </div>



                </div>
            </div>
        </div>
    </section>
    <!-- sidebar + content -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#category').on('change', function(e) {
                let cat_id = e.target.value;
                let brand_id = $('#brand').val();

                $.ajax({
                    url: "{{ route('filteredProducts') }}",
                    type: "POST",
                    data: {
                        cat_id: cat_id,
                        brand_id: brand_id
                    },
                    success: function(data) {

                        $('#filteredResults').html('');
                        data.products.data.forEach(product => {

                            $('#filteredResults').append(
                                '<div class="col-lg-4 col-md-6 col-sm-6 d-flex">' +
                                '<div class="card w-100 my-2 shadow-2-strong">' +
                                '<img src="' + product.media[0].original_url +
                                '" class="card-img-top" height="300" />' +
                                '<div class="card-body d-flex flex-column">' +
                                '<h3>' + product.name + '</h3>' +
                                '<h5 class="card-title text-danger">₱' + product
                                .price + '</h5>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                        });
                        $('#product_count').html('');
                        $('#product_count').html(data.product_count);
                    }
                });
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#brand').on('change', function(e) {
                let brand_id = e.target.value;
                let cat_id = $('#category').val();

                $.ajax({
                    url: "{{ route('filteredProducts') }}",
                    type: "POST",
                    data: {
                        cat_id: cat_id,
                        brand_id: brand_id
                    },
                    success: function(data) {

                        $('#filteredResults').html('');
                        data.products.data.forEach(product => {

                            $('#filteredResults').append(
                                '<div class="col-lg-4 col-md-6 col-sm-6 d-flex">' +
                                '<div class="card w-100 my-2 shadow-2-strong">' +
                                '<img src="' + product.media[0].original_url +
                                '" class="card-img-top" height="300" />' +
                                '<div class="card-body d-flex flex-column">' +
                                '<h3>' + product.name + '</h3>' +
                                '<h5 class="card-title text-danger">₱' + product
                                .price + '</h5>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                        });
                        $('#product_count').html('');
                        $('#product_count').html(data.product_count);

                    }
                });
            });
        });
    </script>

@endsection
