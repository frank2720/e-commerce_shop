<?php
include_once 'functions/common.php';
?>

<?=template_header('Pudfra-Shop')?>
        <header>
            <div class="p-3 text-center bg-white border-bottom">
                <div class="container">
                    <div class="row gy-3">
                        <!--Left elements-->
                         <div class="col-lg-2 col-sm-4 col-4">
                            <a href="index.php" class="float-start">
                                <img src="images/7660092.jpg" height="60" />
                            </a>
                        </div>
                        <!--center elements-->
                        <div class="order-lg-last col-lg-5 col-sm-8 col-8">
                            <div class="d-flex float-end">
                                <a href="user/login.php" class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center"> <i class="fas fa-user-alt m-1 me-md-2"></i><p class="d-none d-md-block mb-0">Sign in</p> </a>
                                <a href="" class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center"> <i class="fas fa-heart m-1 me-md-2"></i><p class="d-none d-md-block mb-0">Wishlist</p> </a>
                                <a href="" class="border rounded py-1 px-3 nav-link d-flex align-items-center"> <i class="fas fa-shopping-cart m-1 me-md-2"></i><p class="d-none d-md-block mb-0">My cart</p> </a>
                            </div>
                        </div>
                        <!-- Right elements -->
                        <div class="col-lg-5 col-md-12 col-12">
                            <form action="" method="get">
                                <div class="input-group float-center">
                                    <input type="search" class="form-control" placeholder="Search" name="search_product" />
                                    <button type="submit" class="btn btn-primary shadow-0 icon-hover" :hover value="search" name="search_data_product"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f5f5f5;">
            <!-- Container wrapper -->
            <div class="container justify-content-center justify-content-md-between">
                <!-- Toggle button -->
                <button 
                class="navbar-toggler border text-dark py-2"
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Hot offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Gift boxes</a>
                    </li>
                    <!-- Navbar dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu">
                            <?php
                            getcategories();
                            ?>
                        </ul>
                    </li>
                </ul>
                 <!-- Left links -->
                </div>
            </div>
            <!-- Container wrapper -->
        </nav>
        </header>
        <!-- Products -->
        <section>
            <div class="container my-5">
                <header class="mb-4">
                    <p class='h5 text-primary'>Products</p>
                </header>

                <div class="row">
                    <?php
                    search_products();
                    category_products();
                    ?>
                </div>
            </div>
        </section>
        
<?=template_footer()?>