<?php

require __DIR__ . '/../src/bootstrap.php';

if (isset($_GET['product_id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = db()->prepare('SELECT * FROM products WHERE product_id = ?');
    $stmt->execute([$_GET['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<?php view('page_header', ['title' => 'Home']) ?>
<header>
    <div class="content-wrapper">
        <h1>Pudfra-Shop</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="products.php">Products</a>
        </nav>
        <div class="link-icons">
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i><span><?=$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;?></span>
            </a>
        </div>

        <div class="link-icons">
            <?php
            if (isset($_SESSION['username'])) {
                echo "<div class='dropdown'>
                <a class='nav-link dropdown-toggle' href='' id='profiledetails' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                <img style='height: 1.5em;display: inline-block' src='imgs/profile.png'>
                <b>".ucfirst($_SESSION['username'])."</b>
                </a>
                <ul class='dropdown-menu' aria-labelledby='profiledetails'>
                    <li><a class='dropdown-item' href='profile.php'>Account</a></li>
                    <hr>
                    <li><a class='dropdown-item' href='logout.php'>Logout</a></li>
                </ul>
                </div>";
            }else {
                echo "<a href='login.php'></i><b>Login </b>|<b> Signup</b></a>";
            }   
            ?>
        </div>

    </div>
</header>

<main>
    <div class="product content-wrapper">
    <img src="admin_page/actions/<?=$product['product_image']?>" width="60%" height="500" alt="<?=$product['product_name']?>">
    <div>
        <h1 class="name"><?=$product['product_name']?></h1>
        <span class="price">
            Ksh <?=number_format($product['price'])?>
            <?php if ($product['rrp'] > 0): ?>
            <span class="rrp">Ksh <?=number_format($product['rrp'])?></span>
            <?php endif; ?>
        </span>
        <form action="cart.php" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['product_id']?>">
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$product['product_description']?>
        </div>
    </div>
</div>
<!--Main layout-->
</main>
<?php view('page_footer') ?>