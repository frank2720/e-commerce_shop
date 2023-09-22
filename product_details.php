<?php
include_once 'functions/common.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta nname="viewport" content="width=device-width, initial-scale=1">
        <title>Pudfra-Shop</title>

        <!-- Favicons -->
        <link href="images/7660092.jpg" rel="icon">
        <link href="images/7660092.jpg" rel="apple-touch-icon">

        <!-- bootstrap CSS link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <!--font awesome link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--css file-->
        <link rel="stylesheet" href="style.css">
    </head>
<body class="font-monospace">
        <!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Toggle button -->
        <button 
            class="navbar-toggler" 
            type="button" 
            data-mdb-toggle="collapse" 
            data-mdb-target="#navbarSupportedContent1" 
            aria-controls="navbarSupportedContent1" 
            aria-expanded="false" 
            aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href=""></a>
                </li>
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
            <!-- Icon -->
            <a class="nav-link me-3" href="#">
                <i class="fas fa-shopping-cart"></i>
                <span class="badge rounded-pill badge-notification bg-danger">1</span>
            </a>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->

<!--Main layout-->
<main class="mt-5 pt-4">
    <div class="container mt-5">
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-md-6 mb-4">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/14.jpg" class="img-fluid" alt="" />
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6 mb-4">
                <!--Content-->
                <div class="p-4">
                    <p class="lead">
                        <span class="me-1">
                            <del>Ksh 200</del>
                        </span>
                        <span>Ksh 100</span>
                    </p>

                    <strong><p style="font-size: 20px;">Description</p></strong>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et dolor suscipit libero eos atque quia ipsa sint voluptatibus! Beatae sit assumenda asperiores iure at maxime atque repellendus maiores quia sapiente.</p>

                    <form class="d-flex justify-content-left">
                        <!-- Default input -->
                        <div class="form-outline me-1" style="width: 100px;">
                            <input type="number" value="1" class="form-control" />
                        </div>
                        <button class="btn btn-primary ms-1" type="submit">
                            Add to cart
                            <i class="fas fa-shopping-cart ms-1"></i>
                        </button>
                    </form>
                </div>
                <!--Content-->
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->

        <hr />

        <!--Grid row-->
        <div class="row d-flex justify-content-center">
            <!--Grid column-->
            <div class="col-md-6 text-center">
                <h4 class="my-4 h4">Additional information</h4>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta odit voluptates, quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-lg-4 col-md-12 mb-4">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid" alt="" />
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" class="img-fluid" alt="" />
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" class="img-fluid" alt="" />
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
</main>
<!--Main layout-->

<!-- footer -->
<footer class="text-center text-white mt-4" style="background-color: #607d8b;">

    <hr class="text-dark" />

    <div class="container">
        <!-- Section: Social media -->
        <section class="mb-3">
            <!-- Facebook -->
            <a class="btn-link btn-floating btn-lg text-white" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-facebook-f"></i></a>

            <!-- Twitter -->
            <a class="btn-link btn-floating btn-lg text-white" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-twitter"></i></a>

            <!-- Google -->
            <a class="btn-link btn-floating btn-lg text-white" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-google"></i></a>

            <!-- Instagram -->
            <a class="btn-link btn-floating btn-lg text-white" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-instagram"></i></a>

            <!-- YouTube -->
            <a class="btn-link btn-floating btn-lg text-white" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-youtube"></i></a>
            <!-- Github -->
            <a class="btn-link btn-floating btn-lg text-white" href="#!" role="button" data-mdb-ripple-color="dark"><i class="fab fa-github"></i></a>
        </section>
        <!-- Section: Social media -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); text-color: #e0e0e0;">
        © 2022 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
</footer>

</body>