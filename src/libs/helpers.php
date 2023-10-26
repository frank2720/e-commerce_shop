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


/**
 * Gets products details from the database
 * 
 * Display 8 products in a in a current web page and performs pagination
 */
function getproducts()
{
    
    $num_products_on_each_page = 8;
    
    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

    if (!isset($_GET['category_id'])) {
    
    $select_products=db()->prepare("SELECT * FROM products LIMIT ?,?");
    
    
    $select_products->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->execute();
    
    
    $result = $select_products->fetchAll(PDO::FETCH_ASSOC);

    
    foreach ($result as $column){
       
        $text = $column['product_description'];
        $maxPos = 50;
        if (strlen($text) > $maxPos)
        {
            $lastPos = ($maxPos - 3) - strlen($text);
            $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '......';
        }
        echo "<div class='col-lg-3 col-md-6 mb-4'>
        <div class='card'>
          <div class='bg-image hover-zoom ripple' data-mdb-ripple-color='light'>
            <img src='admin_page/actions/".$column['product_image']."'
              class='w-100 card-img' />
            <a href='product_details.php?product_id=".$column['product_id']."'>              
                <div class='mask'>
                    <div class='d-flex justify-content-start align-items-end h-100'>";

                    if ($column['rrp'] > $column['price']) {
                        echo "<h5>
                        <span class='badge sale-badge ms-2'>".
                          round((($column['price']/$column['rrp'])*100)-100)."%
                        </span>
                      </h5>";
                    }
                    echo "</div>
                </div>
            </a>
          </div>
          <div class='card-body'>
            <a href='product_details.php?product_id=".$column['product_id']."' class='text-reset'>
              <h5 class='card-title mb-2'>".ucfirst(strtolower($column['product_name']))."</h5>
            </a>
            <a href='product_details.php?product_id=".$column['product_id']."' class='text-reset'>
              <p>".ucfirst($text)."</p>
            </a>";

            if ($column['rrp'] > $column['price']) {
              echo "<h6 class='mb-3 price'><s>KES".number_format($column['rrp'])."</s>
              <strong class='ms-2 sale'>KES ".number_format($column['price'])."</strong></h6>";
            }else{
              echo "<h6 class='mb-3 price'>KES ".number_format($column['price'])."</h6>";
            }

          echo"</div>
        </div>
      </div>";
    }

   
    $total_products = db()->query('SELECT * FROM products')->rowCount();

    echo "<div class='buttons'>";
    if ($current_page>1) {
        echo "<a class='btn btn-black btn-rounded' href='products.php?p=".($current_page-1)."'><b>&laquo; Prev</b></a>";
    }
    if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($result)) {
        echo "<a class='btn btn-black btn-rounded' href='products.php?p=".($current_page+1)."'><b>Next &raquo;</b></a>";
    }
    echo "</div>";
}
}

/**
 * Get the searched product or similar search from the database and display it in the web page and performs pagination.
 */
function search_products()
{
    
    $num_products_on_each_page = 8;
    
    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

    if (isset($_GET['search_data_product'])) {
        $product_value=$_GET['search_product'];
    
    $select_products=db()->prepare("SELECT * FROM products WHERE keywords LIKE '%$product_value%' LIMIT ?,?");
    
    $select_products->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->execute();
    
    
    $result = $select_products->fetchAll(PDO::FETCH_ASSOC);

    if(count($result)==0){
        echo "<h1>Product not available</h1>";
        exit;
    }
    foreach ($result as $column){
       
        $text = $column['product_description'];
        $maxPos = 25;
        if (strlen($text) > $maxPos)
        {
            $lastPos = ($maxPos - 3) - strlen($text);
            $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '......';
        }
        echo "<div class='col-lg-3 col-md-6 mb-4'>
        <div class='card'>
          <div class='bg-image hover-zoom ripple' data-mdb-ripple-color='light'>
            <img src='admin_page/actions/".$column['product_image']."'
              class='w-100 card-img' />
            <a href='product_details.php?product_id=".$column['product_id']."'>              
                <div class='mask'>
                    <div class='d-flex justify-content-start align-items-end h-100'>";

                    if ($column['rrp'] > $column['price']) {
                        echo "<h5>
                        <span class='badge sale-badge ms-2'>".
                          round((($column['price']/$column['rrp'])*100)-100)."%
                        </span>
                      </h5>";
                    }
                    echo "</div>
                </div>
            </a>
          </div>
          <div class='card-body'>
            <a href='product_details.php?product_id=".$column['product_id']."' class='text-reset'>
              <h5 class='card-title mb-2'>".ucfirst(strtolower($column['product_name']))."</h5>
            </a>
            <a href='product_details.php?product_id=".$column['product_id']."' class='text-reset'>
              <p>".ucfirst($text)."</p>
            </a>";

            if ($column['rrp'] > $column['price']) {
              echo "<h6 class='mb-3 price'><s>KES".number_format($column['rrp'])."</s>
              <strong class='ms-2 sale'>KES ".number_format($column['price'])."</strong></h6>";
            }else{
              echo "<h6 class='mb-3 price'>KES ".number_format($column['price'])."</h6>";
            }

          echo"</div>
        </div>
      </div>";
    }

     
     $total_products = db()->query("SELECT * FROM products WHERE keywords LIKE '%$product_value%'")->rowCount();

     echo "<div class='buttons'>";
    if ($current_page>1) {
        echo "<a class='btn btn-secondary btn-rounded' href='products.php?p=".($current_page-1)."'><b>&laquo; Prev</b></a>";
    }
    if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($result)) {
        echo "<a class='btn btn-secondary btn-rounded' href='products.php?p=".($current_page+1)."'><b>Next &raquo;</b></a>";
    }
    echo "</div>";
}
}

/**
 * Get products for a specified category from the database and display them in the web page and performs pagination.
 */
function  category_products()
{
    
    $num_products_on_each_page = 8;
    
    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

    if (isset($_GET['category_id'])) {

    $category_id=$_GET['category_id'];
    
    $select_products=db()->prepare("SELECT * FROM products WHERE category_id=$category_id LIMIT ?,?");
    
    $select_products->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->execute();
    
    $result = $select_products->fetchAll(PDO::FETCH_ASSOC);

    if (count($result)==0) {
        echo "<h1>No products in stock for this category</h1>";
        exit;
    }

    foreach ($result as $column){
        //displaying text with more than 25 characters
        $text = $column['product_description'];
        $maxPos = 25;
        if (strlen($text) > $maxPos)
        {
            $lastPos = ($maxPos - 3) - strlen($text);
            $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '......';
        }
        echo "<div class='col-lg-3 col-md-6 mb-4'>
        <div class='card'>
          <div class='bg-image hover-zoom ripple' data-mdb-ripple-color='light'>
            <img src='admin_page/actions/".$column['product_image']."'
              class='w-100 card-img' />
            <a href='product_details.php?product_id=".$column['product_id']."'>              
                <div class='mask'>
                    <div class='d-flex justify-content-start align-items-end h-100'>";

                    if ($column['rrp'] > $column['price']) {
                        echo "<h5>
                        <span class='badge sale-badge ms-2'>".
                          round((($column['price']/$column['rrp'])*100)-100)."%
                        </span>
                      </h5>";
                    }
                    echo "</div>
                </div>
            </a>
          </div>
          <div class='card-body'>
            <a href='product_details.php?product_id=".$column['product_id']."' class='text-reset'>
              <h5 class='card-title mb-2'>".ucfirst(strtolower($column['product_name']))."</h5>
            </a>
            <a href='product_details.php?product_id=".$column['product_id']."' class='text-reset'>
              <p>".ucfirst($text)."</p>
            </a>";

            if ($column['rrp'] > $column['price']) {
              echo "<h6 class='mb-3 price'><s>KES".number_format($column['rrp'])."</s>
              <strong class='ms-2 sale'>KES ".number_format($column['price'])."</strong></h6>";
            }else{
              echo "<h6 class='mb-3 price'>KES ".number_format($column['price'])."</h6>";
            }

          echo"</div>
        </div>
      </div>";
    }

    
    $total_products = db()->query("SELECT * FROM products WHERE category_id=$category_id")->rowCount();

    echo "<div class='buttons'>";
    if ($current_page>1) {
        echo "<a class='btn btn-secondary btn-rounded' href='products.php?p=".($current_page-1)."'><b>&laquo; Prev</b></a>";
    }
    if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($result)) {
        echo "<a class='btn btn-secondary btn-rounded' href='products.php?p=".($current_page+1)."'><b>Next &raquo;</b></a>";
    }
    echo "</div>";
}
}


/**
 * Retrieve categories existing in the database.
 */
function getcategories()
{
    $select_category=db()->prepare("SELECT * FROM categories");
    
    $select_category->execute();
    
    $select_category->setFetchMode(PDO::FETCH_ASSOC);
    $result=$select_category->fetchAll();
    
    foreach ($result as $column) {
        echo "<li>
        <a class='dropdown-item' href='products.php?category_id=".$column['category_id']."'>".$column['category_title']."</a>
        </li>";
    }
}


/**
 * This is a cart system.
 * 
 * If the user clicked the add to cart button on the product page, it checks for the form data: check if the product exists.
 * Fetch the product from the database and return the result as an Array, check if the product exists (array is not empty)
 * create/update the session variable for the cart
 * 
 * If product exists in cart it updates the quantity, if product is not in cart it add the product
 * 
 * Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart,Remove the product from the shopping cart
 * 
 * Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
 * 
 * Loop through the post data so we can update the quantities for every product in cart
 * checks and validation
 * Update new quantity
 */
function cart()
{
    
    if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    
    $stmt = db()->prepare('SELECT * FROM products WHERE product_id = ?');
    $stmt->execute([$_POST['product_id']]);
    
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($product && $quantity > 0) {
      
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: cart.php');
    exit;
}

if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    
    unset($_SESSION['cart'][$_GET['remove']]);
}


if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                
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