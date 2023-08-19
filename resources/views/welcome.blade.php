@extends('layouts.app')
@section('title', 'Landing Page')
@section('content')


   <!-- Header Start -->
<div class="container-fluid header bg-primary p-0" style="min-height: 95vh">
    <div class="row g-0 align-items-center flex-column-reverse flex-lg-row">
        <div class="col-lg-6 p-5 mt-lg-5">
            <h1 class="display-4 text-white mb-3" id="header-title">Every Purchase will be made by Pleasure.</h1>
            <a href="{{ route('home') }}" class="btn btn-success btn-lg"
                style="cursor: pointer" id="shopnow">Shop Now</a>
        </div>
        <div class="col-lg-6 py-3 py-lg-5 d-flex align-items-center justify-content-center">
            <img src="{{ asset('assets/images/landing-page-leftside.png') }}" alt=""
                class="img-fluid">
        </div>
    </div>
</div>
<!-- Header End -->

<footer class="bg-primary text-light text-center py-3">
    <p class="mb-0">© 2023 Copyright: <a class="text-light" style="text-decoration: none" href="#">GoShopNow</a></p>
</footer>

<style>
#header-title{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: 900;
    font-size: 80px;
}
#shopnow{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: 600;
    font-size: 30px;
}
</style>


@endsection

</body>

</html>
