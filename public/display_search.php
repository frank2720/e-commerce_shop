<?php

require __DIR__ . '/../src/bootstrap.php';
?>

<?php view('page_header', ['title' => 'Search products']) ?>

<header>
    <div class="content-wrapper">
        <h1>Pudfra-Shop</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="products.php">Products</a>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                        <?=getcategories()?>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="input-group-text border-0">
            <form action="display_search.php" method="get">
                <input type="search" placeholder="search product" name="search_product" />
                <input type="submit" name="search_data_product" value="search"/>
            </form>
        </div>
        
        <div class ="link-icons">
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i><span><?=$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;?></span>
            </a>
        </div>

        <div class="link-icons">
            <?php
            if (isset($_SESSION['username'])) {
                echo "<a href='profile.php'><i class='fas fa-user-circle'></i><b>".$_SESSION['username']."</b></a>";
            }else {
                echo "<a href='login.php'></i><b>Login </b>|<b> Signup</b></a>";
            }   
            ?>
        </div>

    </div>
</header>
<main>
<div class="products content-wrapper">
    <h1>Products</h1>
    <?php 
    search_products();
    category_products();
    ?>
</div>
</main>
<?php view('page_footer') ?>