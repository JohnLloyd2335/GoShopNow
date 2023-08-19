@extends('customer.layouts.header-footer')
@section('title', 'Product')
@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="d-flex mb-2">
    <h6 class="mb-0">
        <a href="{{ route('home') }}" class="text-white-50">Home</a>
        <span class="text-white-50 mx-2"> > </span>
        <a href="{{ route('showCart') }}" class="text-white-50">Cart</a>
    </h6>
</nav>
<!-- Breadcrumb -->
@endsection
@section('content')

    <!-- sidebar + content -->
    <section class="">
        <div class="container-fluid my-5">
         
            <!-- Start Page Content -->
            <section class="bg-light my-5 mb-5">
              <div class="container">
               
                <div class="row">
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
                  <!-- cart -->
                  <div class="col-lg-9">
                    <div class="card border shadow-0">
                      <div class="m-4">
                        <h3 class="card-title mb-4">Cart Items</h3>
                        @forelse ($user_cart_items as $cart_item)
                          <div class="row gy-3 mb-4">
                            <div class="col-lg-5">
                              <div class="me-lg-5">
                                <div class="d-flex">
                                  <img src="{{ $cart_item->product->getFirstMediaUrl('product_images') }}" class="border rounded me-3" style="width: 96px; height: 96px;" />
                                  <div class="">
                                    <a class="nav-link">{{ $cart_item->product->name }}</a>
                                    <p class="text-muted">{{ $cart_item->product->category->name }}, {{ $cart_item->product->brand->name }}, {{ $cart_item->size }}</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                              <div class="">
                                <input style="width: 100px;" class="form-control me-4" readonly value="{{ $cart_item->quantity }}"/>
                                  
                              </div>
                              <div class="">
                                <text class="h6">₱{{ $cart_item->product->price *  $cart_item->quantity}}</text> <br />
                                <small class="text-muted text-nowrap"> ₱{{ $cart_item->product->price }} / per item </small>
                              </div>
                            </div>
                            <div class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
                              <div class="float-md-end">
                                <form action="{{ route('deleteCartItem',$cart_item->id) }}" method="post">
                                  @method('DELETE')
                                  @csrf
                                  <input a type="hidden" name="cart_id" value="{{ $cart_item->cart->id }}" />
                                  <input type="hidden" name="cart_item_id" value="{{ $cart_item->id }}">
                                  <button type="submit" class="btn btn-danger border text-light icon-hover-danger"><i class="fa-solid fa-x"></i></button>
                                </form>
                               
                              </div>
                            </div>
                          </div>
                        @empty
                            <div class="d-flex align-items-center justify-content-center">
                              <h3 class="text-danger">Cart is Empty</h3>
                            </div>
                        @endforelse
                      </div>

                      <div id="pagination">
                        <!-- Pagination -->
                        {!! $user_cart_items->withQueryString()->links('pagination::bootstrap-5') !!}
                        <!-- Pagination -->
                      </div>
            
                     
                    </div>
                  </div>
                  <!-- cart -->
                  <!-- summary -->
                  <div class="col-lg-3">
                    <div class="card mb-3 border shadow-0">
                      <div class="card-header">
                        <h3>Order Summary</h3>
                      </div>
                      <div class="card-body">

                      </div>
                    </div>
                    <div class="card shadow-0 border">
                      <div class="card-body">
                        
                        <hr />
                        <div class="d-flex justify-content-between">
                          <p class="mb-2">Total price:</p>
                          <p class="mb-2 fw-bold">₱{{ number_format($total,2) }}</p>
                        </div>
            
                        <div class="mt-3">
                          <form action="{{ route('checkout') }}" method="post">
                            @method('POST')
                            @csrf
                            <button  type="submit" class="btn btn-success w-100 shadow-0 mb-2">Checkout</button>
                          </form>
                          
                          <a href="{{ route('home') }}" class="btn btn-light w-100 border mt-2"> Back to shop </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- summary -->
                </div>
              </div>
            </section>
            <!-- End Page Content -->
        </div>
    </section>

@endsection
