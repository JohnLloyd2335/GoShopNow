<html lang="en"><head>
  <meta charset="utf-8">
  <title>GoShopNow | Landing Page</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&amp;family=Roboto:wght@500;700;900&amp;display=swap" rel="stylesheet"> 

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>

<body>

  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn py-3" >
      <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
          <div class="m-0">
            <img src="{{ asset('assets/images/logo-icon.png') }}" height="35" />
            <img src="{{ asset('assets/images/logo-text-black.png') }}" height="30" />
          </div>
      </a>
      <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav ms-auto p-4 p-lg-0">
            <div class="d-flex ">
            @if (Route::has('login'))
                
                    @auth
                      <a href="{{ route('home') }}" class="nav-item nav-link active text-dark">Home</a>
                    @else
                    <a href="{{ route('login') }}" class="nav-item nav-link text-dark">Login</a>
                        @if (Route::has('register'))
                         <a href="{{ route('register') }}" class="nav-item nav-link text-dark">Register</a>
                        @endif
                    @endauth
               
            @endif
          </div>
          
          </div>
          
          
      </div>
  </nav>
  <!-- Navbar End -->


  <!-- Header Start -->
  <div class="container-fluid header bg-primary p-0" style="height: 95vh">
      <div class="row g-0 align-items-center flex-column-reverse flex-lg-row ">
          <div class="col-lg-6 p-5 mt-5" >
              <h1 class="display-4 text-white mb-5">Every Purchase will be made by Pleasure</h1>
              <a href="{{ route('home') }}" class="btn btn-success btn-lg" style="font-size: 30px; cursor: pointer">Shop Now</a>
          </div>
          <div class="col-lg-6 py-5 d-flex align-items-center justify-content-center mt-5">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="">
          </div>
      </div>
  </div>
  <!-- Header End -->

  <footer>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2023 Copyright:
      <a class="text-dark" style="text-decoration: none">GoShopNow</a>
    </div>
  </footer>





 


  

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>