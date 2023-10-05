<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: userauth/login.html');
    exit;
}
include_once 'functions/common.php';
?>
<?=template_header('Place Order')?>
<header>
    <div class="content-wrapper">
        <h1>Pudfra-Shop</h1>
        <nav>
            <a href="main.php">Home</a>
            <a href="main.php?page=products">Products</a>
        </nav>
        <div class="link-icons">
            <a href="main.php?page=cart">
                <i class="fas fa-shopping-cart"></i><span><?=$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;?></span>
            </a>
        </div>
        <div class="link-icons">
            <a href="main.php?page=profile"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </div>
</header>
<main>
<div class="placeorder content-wrapper">
    <h1>Your Order Has Been Placed</h1>
    <p>Thank you for ordering with us! We'll contact you by message with your order details.</p>
</div>
</main>

<?=template_footer()?>