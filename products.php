<?php
include_once 'functions/common.php';
?>

<?=template_header('Products')?>

        <header>
            <div class="content-wrapper">
                <h1>Pudfra-Shop</h1>
                <div class="link-icons">
                    <div class="input-group-text border-0">
                    <form action="display_search.php" method="get">
                        <input type="search" placeholder="search product" name="search_product" />
                        <button type="submit" name="search_data_product"><i class="fa fa-search"></i></button>
                    </form>
                    </div>
                    <a href="main.php?page=cart">
                        <i class="fas fa-shopping-cart"></i><span><?=$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;?></span>
                    </a>
                </div>
            </div>
        </header>
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
                        <a class="nav-link text-dark" aria-current="page" href="main.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Hot offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Gift boxes</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-dark" href="main.php?page=products">Products</a>
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

<main>
<div class="products content-wrapper">
    <h1>Products</h1>
    <div class='products-wrapper'>
        <?php 
        getproducts();
        category_products();
        ?>
    </div>
</div>
</main>
<?=template_footer()?>