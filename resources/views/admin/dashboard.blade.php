@extends('admin.layouts.sidebar')
@section('title', 'Dashboard')
@section('content')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Dashboard</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('adminDashboard.index') }}">Dashboard</a></li>
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
            <div class="row">
                <!-- Column -->
                <div class="col-md-6 col-lg-3">
                    <div class="card card-hover">
                        <div class="box bg-cyan d-flex align-items-center justify-content-between">
                            <div class="div">
                                <h1 class="font-light text-white"><span class="mdi mdi-cart"></span></h1>
                                <h4 class="text-white">Products</h4>
                            </div>
                            <div class="div">
                                <h1 class="text-light">{{ $product_count }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-3">
                    <div class="card card-hover">
                        <div class="box bg-success d-flex align-items-center justify-content-between">
                            <div class="div">
                                <h1 class="font-light text-white"><span class="mdi mdi-view-list"></span></h1>
                                <h4 class="text-white">Categories</h4>
                            </div>
                            <div class="div">
                                <h1 class="text-light">{{ $category_count }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-3">
                    <div class="card card-hover">
                        <div class="box bg-warning d-flex align-items-center justify-content-between">
                            <div class="div">
                                <h1 class="font-light text-white"><span class="mdi mdi-view-list"></span></h1>
                                <h4 class="text-white">Brands</h4>
                            </div>
                            <div class="div">
                                <h1 class="text-light">{{ $brand_count }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-3">
                    <div class="card card-hover">
                        <div class="box bg-danger d-flex align-items-center justify-content-between">
                            <div class="div">
                                <h1 class="font-light text-white"><span class="mdi mdi-view-list"></span></h1>
                                <h4 class="text-white">Users</h4>
                            </div>
                            <div class="div">
                                <h1 class="text-light">{{ $user_count }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-6">
                    <!-- latest product -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Latest Product</h4>
                        </div>
                        <div class="comment-widgets scrollable ps-container ps-theme-default" data-ps-id="e2ec19fd-ab65-e62a-9a59-707875b0f4cb">

                            @forelse ($latest_products as $latest_product)
                                <!-- Latest Product -->
                                <div class="d-flex flex-row comment-row mt-0">
                                    <div class="p-2"><img src="{{ $latest_product->getFirstMediaUrl('product_images') }}" alt="user" width="50" class="rounded-circle"></div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">{{ $latest_product->name }}</h6>
                                        <span class="mb-3 d-block">{{ $latest_product->description }}</span>
                                        <div class="comment-footer">
                                            <span class="float-end text-dark">{{ $latest_product->created_at->format('M-d-Y') }}</span>
                                            <button type="button" class="btn btn-cyan btn-sm text-white">{{ $latest_product->category->name }}</button>
                                            <button type="button" class="btn btn-success btn-sm text-white">{{ $latest_product->brand->name }}</button>
                                            <button type="button" class="btn btn-danger btn-sm text-white">₱{{ $latest_product->price }}</button>
                                        </div>
                                        <a href="{{ route('products.show',$latest_product->id) }}" class="mt-3 float-end">View</a>
                                    </div>
                                    
                                </div>
                                <!-- Latest Product -->
                            @empty
                                <h3 class="text-center">No Latest Product Found</h3>
                            @endforelse

                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                    </div>
                    <!-- latest product -->
                    <!-- product brands -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Product Brands</h4>
                            <div class="mt-3">
                                <table class="table border">
                                    @forelse ($brands_count as $key => $value)
                                    <tr>
                                        <th><p class="lead">{{ $key }}</p></th>
                                        <th><span class="badge rounded-pill bg-success float-end">{{ $value }} Product/s</span></th>
                                    </tr>
                                    @empty
                                        <tr>
                                            <th class="text-center">No Category Found</th>
                                        </tr>
                                    @endforelse
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- product brands -->
                </div>
                <div class="col-md-6">
                    <!-- product categories -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Product Categories</h4>
                            <div class="mt-3">
                                <table class="table border">
                                    @forelse ($categories_count as $key => $value)
                                    <tr>
                                        <th><p class="lead">{{ $key }}</p></th>
                                        <th><span class="badge rounded-pill bg-success float-end">{{ $value }} Product/s</span></th>
                                    </tr>
                                    @empty
                                        <tr>
                                            <th class="text-center">No Category Found</th>
                                        </tr>
                                    @endforelse
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- product categories -->
                    <!-- latest product -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">New Users</h4>
                        </div>
                        <div class="comment-widgets scrollable ps-container ps-theme-default" data-ps-id="e2ec19fd-ab65-e62a-9a59-707875b0f4cb">

                            @forelse ($new_users as $user)
                                <!-- Latest Product -->
                                <div class="d-flex flex-row comment-row mt-0">
                                    <div class="p-2"><img src="{{ asset('assets/images/users/1.jpg') }}" alt="user" width="50" class="rounded-circle"></div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">{{ $user->name }}</h6>
                                        <span class="d-block">{{ $user->email }}</span>
                                        <span class="d-block">{{ $user->address->address_line_1." ".$user->address->address_line_2." ".$user->address->city_municipality.", ".$user->address->province.", ".$user->address->region." (".$user->address->postal_code.")" }}</span>
                                        <span class="d-block">{{ $user->mobile_number->mobile_number }}</span>
                                        <div class="comment-footer">
                                            <span class="float-end text-dark">{{ $user->created_at->format('M-d-Y') }}</span>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <!-- Latest Product -->
                            @empty
                                <h3 class="text-center">No Latest Product Found</h3>
                            @endforelse

                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                    </div>
                    <!-- latest product -->
                </div>
            </div>

            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
    @endsection
