<?php
include_once 'database/connection.php';
include_once 'functions/common.php';
if (isset($_GET['product_id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $conn->prepare('SELECT * FROM products WHERE product_id = ?');
    $stmt->execute([$_GET['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
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
    
<header>
    <div class="content-wrapper">
        <h1>Pudfra-Shop</h1>
        <nav>
            <a href="main.php">Home</a>
            <a href="main.php?page=products">Products</a>
        </nav>
        <div class="link-icons">
            <a href="main.php?page=cart">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </div>
    </div>
</header>

<main>
<div class="product content-wrapper">
    <img src="admin_page/actions/<?=$product['product_image']?>" width="500" height="500" alt="<?=$product['product_name']?>">
    <div>
        <h1 class="name"><?=$product['product_name']?></h1>
        <span class="price">
            &dollar;<?=$product['price']?>
            <?php if ($product['rrp'] > 0): ?>
            <span class="rrp">&dollar;<?=$product['rrp']?></span>
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