<?php
include_once 'functions/common.php';
?>

<?=template_header('Pudfra-Shop')?>
<header>
    <div class="content-wrapper">
        <h1>Pudfra-Shop</h1>
        <nav>
            <a href="main.php">Home</a>
            <a href="main.php?page=products">Products</a>
        </nav>
        <div class="link-icons">
            <div class="input-group-text border-0">
                <form action="main.php?page=display_search" method="get">
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

<main>
<div class="products content-wrapper">
    <h1>Products</h1>
    <div class='products-wrapper'>
        <?php 
        search_products();
        category_products();
        ?>
    </div>
</div>
</main>
        
<?=template_footer()?>