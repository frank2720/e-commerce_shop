<?php

require __DIR__ . '/../src/bootstrap.php';

cart();
// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = db()->prepare('SELECT * FROM products WHERE product_id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['product_id']];
    }
}
?>

<?php view('page_header', ['title' => 'Cart details']) ?>

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
    </div>
</header>
<main>
<div class="cart content-wrapper">
    <form action="cart.php" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="product_details.php?product_id=<?=$product['product_id']?>">
                            <img src="admin_page/actions/<?=$product['product_image']?>" width="50" height="50" alt="<?=$product['product_name']?>">
                        </a>
                    </td>
                    <td>
                        <a href="product_details.php?product_id=<?=$product['product_id']?>"><?=$product['product_name']?></a>
                        <br>
                        <a href="cart.php?remove=<?=$product['product_id']?>" class="remove">Remove</a>
                    </td>
                    <td class="price">Ksh <?=number_format($product['price'])?></td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['product_id']?>" value="<?=$products_in_cart[$product['product_id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                    </td>
                    <td class="price">Ksh <?=number_format($product['price'] * $products_in_cart[$product['product_id']])?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price">Ksh <?=number_format($subtotal)?></span>
        </div>
        <div class="buttons">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder">
        </div>
    </form>
</div>
</main>

<?php view('page_footer') ?>