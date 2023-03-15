<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Welcome to MyTricount!</title>

    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link href="./assets/img/fav_icon.png" rel="icon">
    <link href="./assets/img/touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="./assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="./assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="./assets/css/index.css" rel="stylesheet">
</head>
<body>
<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="hero-container">
        <div data-aos="fade-in">
            <div class="hero-logo">
                <img class="" src="./assets/img/My_logo.png" alt="Imperial">
            </div>

            <h1>Welcome to your Tricount app</h1>
            <h2>Tricount says who owes you ... <span class="typed" data-typed-items="Vacation, Co-renting, mutually paid gifts.."></span></h2>
            <div class="actions">
                <a href="main/login" class="btn-get-started" >Log In</a>
                <a href="main/signup" class="btn-services" >Sign Up</a>
            </div>
        </div>
    </div>
</section><!-- End Hero -->

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo mr-auto"><img src="./assets/img/My_logo.png" alt=""></a>
        <!-- Uncomment below if you prefer to use a text logo -->
        <!-- <h1 class="logo mr-auto"><a href="index.html">Imperial</a></h1> -->
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#services">Services</a></li>
                <li><a class="nav-link scrollto" href="#team">Team</a></li>
                <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">Drop Down 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<!-- Vendor JS Files -->
<script src="./assets/vendor/aos/aos.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="./assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="./assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="./assets/vendor/typed.js/typed.min.js"></script>
<script src="./assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="./assets/js/main_imperial_temp.js"></script>
</body>
</html>
