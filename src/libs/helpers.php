<?php

/**
 * Display a view
 *
 * @param string $filename
 * @param array $data
 * @return void
 */
function view(string $filename, array $data = []): void
{
    // create variables from the associative array
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once __DIR__ . '/../inc/' . $filename . '.php';
}


/**
 * Return the error class if error is found in the array $errors
 *
 * @param array $errors
 * @param string $field
 * @return string
 */
function error_class(array $errors, string $field): string
{
    return isset($errors[$field]) ? 'error' : '';
}

/**
 * Return true if the request method is POST
 *
 * @return boolean
 */
function is_post_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}

/**
 * Return true if the request method is GET
 *
 * @return boolean
 */
function is_get_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'GET';
}

/**
 * Redirect to another URL
 *
 * @param string $url
 * @return void
 */
function redirect_to(string $url): void
{
    header('Location:' . $url);
    exit;
}

/**
 * Redirect to a URL with data stored in the items array
 * @param string $url
 * @param array $items
 */
function redirect_with(string $url, array $items): void
{
    foreach ($items as $key => $value) {
        $_SESSION[$key] = $value;
    }

    redirect_to($url);
}

/**
 * Redirect to a URL with a flash message
 * @param string $url
 * @param string $message
 * @param string $type
 */
function redirect_with_message(string $url, string $message, string $type = FLASH_SUCCESS)
{
    flash('flash_' . uniqid(), $message, $type);
    redirect_to($url);
}

/**
 * Flash data specified by $keys from the $_SESSION
 * @param ...$keys
 * @return array
 */
function session_flash(...$keys): array
{
    $data = [];
    foreach ($keys as $key) {
        if (isset($_SESSION[$key])) {
            $data[] = $_SESSION[$key];
            unset($_SESSION[$key]);
        } else {
            $data[] = [];
        }
    }
    return $data;
}


//function of getting products to index.php
function getproducts()
{
    // The amounts of products to show on each page
    $num_products_on_each_page = 8;
    // The current page - in the URL, will appear as products.php?p=1, products.php?p=2, etc...
    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

    if (!isset($_GET['category_id'])) {
    
    $select_products=db()->prepare("SELECT * FROM products ORDER BY time_added DESC LIMIT ?,?");
    
    // bindValue will allow us to use an integer in the SQL statement, which we need to use for the LIMIT clause
    $select_products->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->execute();
    
    // Fetch the products from the database and return the result as an Array
    $result = $select_products->fetchAll(PDO::FETCH_ASSOC);

    
    echo "<div class='products-wrapper'>";
    foreach ($result as $column){
        //displaying text with more than 50 characters
        $text = $column['product_description'];
        $maxPos = 25;
        if (strlen($text) > $maxPos)
        {
            $lastPos = ($maxPos - 3) - strlen($text);
            $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '......';
        }
        echo "<a href='product_details.php?product_id=".$column['product_id']."' class='product'>
        <img src='admin_page/actions/".$column['product_image']."' width='200' height='200' alt='".$column['product_name']." image'>
        <span class='name'>".$column['product_name']."</span>
        <span class='price'>Ksh ".number_format($column['price'])."
        ";
        if ($column['rrp']>0) {
            echo "<span class='rrp'>Ksh ".number_format($column['rrp'])."</span>";
        }
        echo "</span></a>";
    }
    echo "</div>";

    // Get the total number of products
    $total_products = db()->query('SELECT * FROM products')->rowCount();

    echo "<div class='buttons'>";
    if ($current_page>1) {
        echo "<a href='products.php?p=".($current_page-1)."'>&laquo; Prev</a>";
    }
    if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($result)) {
        echo "<a href='products.php?p=".($current_page+1)."'>Next &raquo;</a>";
    }
    echo "</div>";
}
}


# search products
function search_products()
{
    // The amounts of products to show on each page
    $num_products_on_each_page = 8;
    // The current page - in the URL, will appear as products.php?p=1, products.php?p=2, etc...
    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

    if (isset($_GET['search_data_product'])) {
        $product_value=$_GET['search_product'];
    
    $select_products=db()->prepare("SELECT * FROM products WHERE keywords LIKE '%$product_value%' LIMIT ?,?");
    // bindValue will allow us to use an integer in the SQL statement, which we need to use for the LIMIT clause
    $select_products->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->execute();
    
    // Fetch the products from the database and return the result as an Array
    $result = $select_products->fetchAll(PDO::FETCH_ASSOC);

    if(count($result)==0){
        echo "<h1>Product not available</h1>";
        exit;
    }
    echo "<div class='products-wrapper'>";
    foreach ($result as $column){
        //displaying text with more than 50 characters
        $text = $column['product_description'];
        $maxPos = 25;
        if (strlen($text) > $maxPos)
        {
            $lastPos = ($maxPos - 3) - strlen($text);
            $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '......';
        }
        echo "<a href='product_details.php?product_id=".$column['product_id']."' class='product'>
        <img src='admin_page/actions/".$column['product_image']."' width='200' height='200' alt='".$column['product_name']." image'>
        <span class='name'>".$column['product_name']."</span>
        <span class='price'>Ksh ".number_format($column['price'])."
        ";
        if ($column['rrp']>0) {
            echo "<span class='rrp'>Ksh ".number_format($column['rrp'])."</span>";
        }
        echo "</span>
        </a>";
    }
    echo "</div>";

     // Get the total number of products
     $total_products = db()->query("SELECT * FROM products WHERE keywords LIKE '%$product_value%'")->rowCount();

     echo "<div class='buttons'>";
     if ($current_page>1) {
         echo "<a href='products.php?p=".($current_page-1)."'>&laquo; Prev</a>";
     }
     if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($result)) {
         echo "<a href='products.php?p=".($current_page+1)."'>Next &raquo;</a>";
     }
     echo "</div>";
}
}


//getting products from specific categories
function  category_products()
{
    // The amounts of products to show on each page
    $num_products_on_each_page = 8;
    // The current page - in the URL, will appear as products.php?p=1, products.php?p=2, etc...
    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

    if (isset($_GET['category_id'])) {

    $category_id=$_GET['category_id'];
    
    $select_products=db()->prepare("SELECT * FROM products WHERE category_id=$category_id LIMIT ?,?");
    
    // bindValue will allow us to use an integer in the SQL statement, which we need to use for the LIMIT clause
    $select_products->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->execute();
    
    // Fetch the products from the database and return the result as an Array
    $result = $select_products->fetchAll(PDO::FETCH_ASSOC);

    if (count($result)==0) {
        echo "<h1>No products in stock for this category</h1>";
        exit;
    }

    echo "<div class='products-wrapper'>";
    foreach ($result as $column){
        //displaying text with more than 25 characters
        $text = $column['product_description'];
        $maxPos = 25;
        if (strlen($text) > $maxPos)
        {
            $lastPos = ($maxPos - 3) - strlen($text);
            $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '......';
        }
        echo "<a href='product_details?product_id=".$column['product_id']."' class='product'>
        <img src='admin_page/actions/".$column['product_image']."' width='200' height='200' alt='".$column['product_name']." image'>
        <span class='name'>".$column['product_name']."</span>
        <span class='price'>Ksh ".number_format($column['price'])."
        ";
        if ($column['rrp']>0) {
            echo "<span class='rrp'>Ksh ".number_format($column['rrp'])."</span>";
        }
        echo "</span>
        </a>";
    }
    echo "</div>";

    // Get the total number of products
    $total_products = db()->query("SELECT * FROM products WHERE category_id=$category_id")->rowCount();

    echo "<div class='buttons'>";
    if ($current_page>1) {
        echo "<a href='products.php?p=".($current_page-1)."'>&laquo; Prev</a>";
    }
    if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($result)) {
        echo "<a href='products.php?p=".($current_page+1)."'>Next &raquo;</a>";
    }
    echo "</div>";
}
}

//function for getting categories to the dropdown in the index.php file

function getcategories()
{
    $select_category=db()->prepare("SELECT * FROM categories");
    //execute query
    $select_category->execute();
    
    $select_category->setFetchMode(PDO::FETCH_ASSOC);
    $result=$select_category->fetchAll();
    
    foreach ($result as $column) {
        echo "<li>
        <a class='dropdown-item' href='products.php?category_id=".$column['category_id']."'>".$column['category_title']."</a>
        </li>";
    }
}



function cart()
{
    
    // If the user clicked the add to cart button on the product page we can check for the form data
    if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = db()->prepare('SELECT * FROM products WHERE product_id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: cart.php');
    exit;
}

    // Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: cart.php');
    exit;
}

// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: placeorder.php');
    exit;
}
}
?>