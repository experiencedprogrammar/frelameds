<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FrelaMed pharmaceuticals</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Frelamed" name="keywords">
    <meta content="Frela-med pharmaceuticals" name="description">

    <!-- Favicon -->
    <link href="frontend/img/logo.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/frontend/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/frontend/css/style.css" rel="stylesheet">

    <style>
        .progress-container {
    position: fixed;
    top: 0;
    width: 100%;
    height: 4px;
    background: transparent;
    z-index: 1040;
}

.progress-bar {
    height: 4px;
    background: #0088fe;
    width: 0%;
    transition: width 0.3s ease;
}
        /* Moving text animation - Vertical */
        .text-scroll-container {
            height: 25px;
            overflow: hidden;
            position: relative;
        }
        
        .scrolling-text {
            position: absolute;
            width: 100%;
            text-align: center;
            animation: scrollText 10s infinite;
            font-weight: 800;
            color: white;
            font-size:1.25rem;
        }
        
        .scrolling-text:nth-child(2) {
            animation-delay: 5s;
        }
        
        @keyframes scrollText {
            0% { transform: translateY(100%); opacity: 0; }
            10% { transform: translateY(0); opacity: 1; }
            40% { transform: translateY(0); opacity: 1; }
            50% { transform: translateY(-100%); opacity: 0; }
            100% { transform: translateY(-100%); opacity: 0; }
        }

        /* Sticky container for logo + navbar */
        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .brand-logo {
            height: 50px;
            width: auto;
            margin-right: 8px;
            opacity: 1;
        }

        /* Custom notification popup */
        .notification-popup {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border-radius: 4px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            padding: 10px 15px;
            display: flex;
            align-items: center;
            z-index: 9999;
            transform: translateX(120%);
            transition: transform 0.2s ease-in-out;
            max-width: 350px;
            border-left: 2px solid #28a745;
        }
        
        .notification-popup.show {
            transform: translateX(0);
        }
        
        .notification-icon {
            margin-right: 15px;
            font-size: 18px;
            color: #28a745;
        }
        
        .notification-content {
            flex: 1;
        }
        
        .notification-title {
            font-weight: 600;
            margin-bottom: 3px;
            color: #333;
        }
        
        .notification-message {
            margin-bottom: 8px;
            color: #666;
        }
        
        .notification-buttons {
            display: flex;
            gap: 8px;
        }
        
        .notification-btn {
            padding: 4px 8px;
            border-radius: 2px;
            font-size: 12px;
            cursor: pointer;
            border: none;
            transition: background-color 0.2s;
        }
        
        .btn-view-cart {
            background-color: #007bff;
            color: white;
        }
        
        .btn-view-cart:hover {
            background-color: #0069d9;
        }
        
        .btn-close-notification {
            background-color: #f8f9fa;
            color: #6c757d;
        }
        
        .btn-close-notification:hover {
            background-color: #e2e6ea;
        }
    </style>
</head>
<body>
    <div class="progress-container">
    <div class="progress-bar" id="myProgressBar"></div>
</div>
   <!-- Topbar Start -->
   <div class="container-fluid py-1 px-xl-5" style="background-color:#0C8281;">
        <div class="row">
            <div class="col-12">
                <div class="text-scroll-container">
                    <h4 class="m-0 scrolling-text">CALL/WHATSAPP 0748 482 869 TO ORDER</h4>
                    <h4 class="m-0 scrolling-text">FREE DELIVERY FOR ORDERS ABOVE KES 3,000</h4>
                </div>
            </div>
        </div>
    </div>
   <!-- Topbar End -->

   <!-- Sticky Header (Logo + Navbar) -->
   <div class="sticky-header">
       <!-- Header with Logo -->
       <div class="row align-items-center bg-light py-2 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4 d-flex align-items-center">
                <a href="" class="text-decoration-none d-flex align-items-center">
                    <!-- brand Logo -->
                    <img src="frontend/img/Logo4.png" alt="Logo" class="brand-logo">
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text"name="search" class="form-control" placeholder="Search products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
       <!-- Header with logo End -->

       <!-- Navbar Start -->
       <div class="container-fluid bg-dark mb-30">
            <div class="row px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a class="btn d-flex align-items-center justify-content-between w-100" 
                       data-toggle="collapse" href="#navbar-vertical" 
                       style="height: 65px; padding: 0 30px; background-color:#0088fe">
                        <h6 class="text-dark m-0">
                            <i class="fa fa-bars mr-2"></i>Categories
                        </h6>
                        <i class="fa fa-angle-down text-white"></i>
                    </a>
                    <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" 
                         id="navbar-vertical" 
                         style="width: calc(100% - 30px); z-index: 999;">
                        <div class="navbar-nav w-100">
                            <div class="nav-item dropdown dropright">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    Prescription-Only-Medicines(POM) 
                                    <i class="fa fa-angle-right float-right mt-1"></i>
                                </a>
                                <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                    <a href="" class="dropdown-item">Men</a>
                                    <a href="" class="dropdown-item">Women</a>
                                    <a href="" class="dropdown-item">Babys</a>
                                </div>
                            </div>
                            <a href="" class="nav-item nav-link">Over-The-Counter(OTC)</a>
                            <a href="" class="nav-item nav-link">Behind-The-Counter Medicines</a>
                            <a href="" class="nav-item nav-link">Medical Devices & Aids</a>
                            <a href="" class="nav-item nav-link">Supplements</a>
                            <a href="" class="nav-item nav-link">Personal Care& Wellness</a>
                            <a href="" class="nav-item nav-link">Fisrt Aid & Emergency</a>
                            <a href="" class="nav-item nav-link">Skin Care Related</a>
                            <a href="" class="nav-item nav-link">Mother& Baby Care</a>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-9">
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                        <a href="" class="text-decoration-none d-block d-lg-none">
                            <span class="h1 text-uppercase text-dark bg-light px-2">FRELA</span>
                            <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">MED</span>
                        </a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="{{ route('shop') }}" class="nav-item nav-link active">Home</a>
                                <a href="{{ route('shop') }}" class="nav-item nav-link">Shop</a>
                                <a href="{{ route('shop') }}" class="nav-item nav-link">About</a>
                                <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
                            </div>
                            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                              <a href="{{ route('view.cart') }}" class="btn px-0 ml-3">
                                  <i class="fas fa-shopping-cart fa-2x text-primary mr-1"></i>
                                  <span class="badge text-secondary border border-secondary text-center rounded-circle">
                                      {{ session('cart') ? count(session('cart')) : 0 }}
                                  </span>
                              </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
       <!-- Navbar End -->
   </div>
   <!-- Sticky Header End -->

   <!-- Custom Notification Popup -->
   <div class="notification-popup" id="cart-notification">
        <div class="notification-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="notification-content">
            <div class="notification-title">Success!</div>
            <div class="notification-message">Product added to cart successfully!</div>
            <div class="notification-buttons">
                <button class="notification-btn btn-view-cart" onclick="window.location.href='{{ route('view.cart') }}'">View Cart</button>
                <button class="notification-btn btn-close-notification" onclick="hideNotification()">Close popup</button>
            </div>
        </div>
   </div>
   <script>
// Scroll progress indicator
window.onscroll = function() {
    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;
    document.getElementById("myProgressBar").style.width = scrolled + "%";
};
</script>
</body>
</html>
