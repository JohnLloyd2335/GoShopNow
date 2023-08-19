<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GoShopNow | @yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <!-- Custom CSS -->

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body style="min-height: 100vh;
display: flex;
flex-direction: column;">


    <!--Main Navigation-->
    <header>
        <!-- Jumbotron -->
        <div class="p-3 text-center bg-white border-bottom">
            <div class="container-fluid">
                <div class="row gy-3">
                    <!-- Left elements -->
                    <div class="col-lg-2 col-sm-4 col-4">
                        <a href="{{ route('home') }}" 
                            class="float-start d-flex gap-2 align-items-center justify-content-center">
                            <img src="{{ asset('assets/images/logo-icon.png') }}" height="35" />
                            <img src="{{ asset('assets/images/logo-text-black.png') }}" height="30" />
                        </a>
                    </div>
                    <!-- Left elements -->

                    <!-- Center elements -->
                    <div class="order-lg-last col-lg-8 col-sm-8 col-12 ms-auto">
                        <div class="d-flex float-end gap-1">


                            <a href="{{ route('showCart') }}"
                                class="border rounded py-1 px-3 nav-link d-flex align-items-center" >
                                <i class="fas fa-shopping-cart m-1 me-md-2"></i>
                                <p class="d-none d-md-block mb-0">My cart</p>
                            </a>


                            <div class="dropdown">
                                <a class="dropdown-toggle border rounded py-1 px-3 nav-link" href="#"
                                    role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-user-alt m-1 me-md-2"></i>
                                    {{ auth()->user()->name }}
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">My Orders</a>
                                    <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('changePassword') }}">Change Password</a>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Center elements -->


                </div>
            </div>
        </div>
        <!-- Jumbotron -->
        @php
    $images = [
            'https://static.vecteezy.com/system/resources/previews/002/294/859/original/flash-sale-web-banner-design-e-commerce-online-shopping-header-or-footer-banner-free-vector.jpg',
            'https://static.vecteezy.com/system/resources/previews/004/299/835/original/online-shopping-on-phone-buy-sell-business-digital-web-banner-application-money-advertising-payment-ecommerce-illustration-search-free-vector.jpg',
            'https://www.internetcreation.net/wp-content/uploads/2015/04/banner-e-commerce1.png',
        ];
@endphp
        <div class="container-fluid p-0 m-0">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                
                <div class="carousel-inner">
                    @foreach ($images as $key => $image)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ $image }}" alt="Image {{ $key + 1 }}" class="d-block w-100" height="400">
                        </div>
                    @endforeach
                </div>
                
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <!-- Heading -->
        <div class="bg-primary mb-4">
            <div class="container py-4">
                <h3 class="text-white mt-2">Every Purchase will be made by Pleasure</h3>

                @yield('breadcrumb')
                
            </div>
        </div>
        <!-- Heading -->
    </header>

    @yield('content')

    <!-- Footer -->
    <footer class="mt-auto">
        <div class="text-center p-3 bg-primary text-light" >
            © 2023 Copyright:
            <a class="text-light" style="text-decoration: none">GoShopNow</a>
        </div>
    </footer>
    <!-- Footer -->

    <!-- All Jquery -->
    <!-- ============================================================== -->



 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    <script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>

    <script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>









</body>

</html>
