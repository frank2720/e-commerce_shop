<?php
include_once './database/connection.php';

//function of getting products to index.php
function getproducts(){
    global $conn;
    // The amounts of products to show on each page
    $num_products_on_each_page = 8;
    // The current page - in the URL, will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

    if (!isset($_GET['category_id'])) {
    
    $select_products=$conn->prepare("SELECT * FROM products ORDER BY time_added DESC LIMIT ?,?");
    
    // bindValue will allow us to use an integer in the SQL statement, which we need to use for the LIMIT clause
    $select_products->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
    $select_products->execute();
    
    // Fetch the products from the database and return the result as an Array
    $result = $select_products->fetchAll(PDO::FETCH_ASSOC);

    

    foreach ($result as $column){
        //displaying text with more than 50 characters
        $text = $column['product_description'];
        $maxPos = 50;
        if (strlen($text) > $maxPos)
        {
            $lastPos = ($maxPos - 3) - strlen($text);
            $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '......';
        }
        echo "<div class='col-lg-3 col-md-6 col-sm-6 mb-2'>
        <div class='card h-100'>
        <img src='admin_page/actions/".$column['product_image']."' class='card-img-top' alt='".$column['product_name']." image'>
        <div class='card-body'>
        <a href='#!' class='btn btn-light border px-2 pt-2 float-end icon-hover'><i class='fas fa-heart fa-lg px-1 text-secondary'></i></a>
        <p class='card-text'>".$text."</p>
        <small><p class='card-title'><b>".$column['product_name'].":- Ksh ".number_format($column['price'])."</b></p></small>
        <a href='#' class='btn btn-primary'>Add to cart</a>
        <a href='product_details.php?product_id=".$column['product_id']."' class='btn btn-secondary'>View more</a>
        </div>
        </div>
        </div>";
    }

    // Get the total number of products
    $total_products = $conn->query('SELECT * FROM products')->rowCount();

    if ($current_page>1) {
        echo "<a href='main.php?page=products&p=".($current_page-1)."'>&laquo; Prev</a>";
    }
    if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($result)) {
        echo "<a href='main.php?page=products&p=".($current_page+1)."'>Next &raquo;</a>";
    }
}
}

# search products
function search_products(){
    global $conn;
    if (isset($_GET['search_data_product'])) {
        $product_value=$_GET['search_product'];
    
    $select_products=$conn->prepare("SELECT * FROM products WHERE keywords LIKE '%$product_value%' ORDER BY RAND()");
    //execute query
    $select_products->execute();

    $count=$select_products->rowCount();

    if($count==0){
        echo "<small class='text-center text-danger h5'>Product not available</small>";
    }
    $r=$select_products->setFetchMode(PDO::FETCH_ASSOC);
    $result=$select_products->fetchAll();
    
    foreach ($result as $column){
        //displaying text with more than 50 characters
        $text = $column['product_description'];
        $maxPos = 50;
        if (strlen($text) > $maxPos)
        {
            $lastPos = ($maxPos - 3) - strlen($text);
            $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '......';
        }
        echo "<div class='col-lg-3 col-md-6 col-sm-6 mb-2'>
        <div class='card h-100'>
        <img src='admin_page/actions/".$column['product_image']."' class='card-img-top' alt='".$column['product_name']." image'>
        <div class='card-body'>
        <a href='#!' class='btn btn-light border px-2 pt-2 float-end icon-hover'><i class='fas fa-heart fa-lg px-1 text-secondary'></i></a>
        <p class='card-text'>".$text."</p>
        <small><p class='card-title'><b>".$column['product_name'].":- Ksh ".number_format($column['price'])."</b></p></small>
        <a href='#' class='btn btn-primary'>Add to cart</a>
        <a href='product_details.php?product_id=".$column['product_id']."' class='btn btn-secondary'>View more</a>
        </div>
        </div>
        </div>";
    }
}
}
//getting products from specific categories
function category_products(){
    global $conn;
    if (isset($_GET['category_id'])) {
    $category_id=$_GET['category_id'];
    $select_products=$conn->prepare("SELECT * FROM products WHERE category_id=$category_id ORDER BY RAND() LIMIT 12");
    //execute query
    $select_products->execute();

    $count = $select_products->rowCount();
    if ($count==0) {
        echo "<small class='text-center text-danger h5'>No products in stock for this category</small>";
    }
    $r=$select_products->setFetchMode(PDO::FETCH_ASSOC);
    $result=$select_products->fetchAll();
    
    foreach ($result as $column){
        //displaying text with more than 50 characters
        $text = $column['product_description'];
        $maxPos = 50;
        if (strlen($text) > $maxPos)
        {
            $lastPos = ($maxPos - 3) - strlen($text);
            $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '......';
        }
        echo "<div class='col-lg-3 col-md-6 col-sm-6 mb-2'>
        <div class='card h-100'>
        <img src='admin_page/actions/".$column['product_image']."' class='card-img-top' alt='".$column['product_name']." image'>
        <div class='card-body'>
        <a href='#!' class='btn btn-light border px-2 pt-2 float-end icon-hover'><i class='fas fa-heart fa-lg px-1 text-secondary'></i></a>
        <p class='card-text'>".$text."</p>
        <small><p class='card-title'><b>".$column['product_name'].":- Ksh ".number_format($column['price'])."</b></p></small>
        <a href='#' class='btn btn-primary'>Add to cart</a>
        <a href='product_details.php?product_id=".$column['product_id']."' class='btn btn-secondary'>View more</a>
        </div>
        </div>
        </div>";
    }
}
}

//function for getting categories to the dropdown in the index.php file

function getcategories(){
    global $conn;
    $select_category=$conn->prepare("SELECT * FROM categories");
    //execute query
    $select_category->execute();
    
    $r=$select_category->setFetchMode(PDO::FETCH_ASSOC);
    $result=$select_category->fetchAll();
    
    foreach ($result as $column) {
        echo "<li>
        <a class='dropdown-item' href='index.php?category_id=".$column['category_id']."'>".$column['category_title']."</a>
        </li>";
    }
}

// Template header, feel free to customize this
function template_header($title) {
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
        <meta charset="utf-8">
        <meta nname="viewport" content="width=device-width, initial-scale=1">
        <title>$title</title>

        <!-- Favicons -->
        <link href="images/7660092.jpg" rel="icon">
        <link href="images/7660092.jpg" rel="apple-touch-icon">

        <!-- bootstrap CSS link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <!--font awesome link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--css file-->
        <link rel="stylesheet" href="style.css" type="text/css">
        </head>
    <body>
            
EOT;
}

// Template footer
function template_footer() {
    $year = date('Y');
    echo <<<EOT
            <footer>
                <!-- Copyright -->
                <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                  <p>&copy; $year, Pudfra-Shop</p>
                </div>
                <!-- Copyright -->
            </footer>
        <!--bootstrap Js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        </body>
        </html>
    EOT;
    }
?>