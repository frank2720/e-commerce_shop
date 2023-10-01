<?php
include_once 'database/connection.php';
include_once 'functions/common.php';
if (isset($_GET['product_id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $conn->prepare('SELECT * FROM products WHERE product_id = ?');
    $stmt->execute([$_GET['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<?=template_header('product details')?>
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
        <form action="main.php?page=cart" method="post">
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
<?=template_footer()?>