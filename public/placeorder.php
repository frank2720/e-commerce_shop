<?php

require __DIR__ . '/../src/bootstrap.php';

require_login();
?>
<?php view('page_header', ['title' => 'Order placement']) ?>
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
                echo "<a href='profile.php'><i class='fas fa-user-circle'></i><b>".$_SESSION['username']."</b></a>";
            }else {
                echo "<a href='login.php'></i><b>Login </b>|<b> Signup</b></a>";
            }   
            ?>
        </div>

    </div>
</header>
<main>
<div class="placeorder content-wrapper">
    <h1>Your Order Has Been Placed</h1>
    <p>Thank you for ordering with us! We'll contact you by message with your order details.</p>
</div>
</main>

<?php view('page_footer') ?>