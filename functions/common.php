<?php
include_once './database/connection.php';

//function of getting products to index.php
function getproducts(){
    global $conn;
    if (!isset($_GET['category_id'])) {
    
    $select_products=$conn->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 12");
    //execute query
    $select_products->execute();
    
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
        <div class='card' style='width: 18rem;'>
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
        <div class='card' style='width: 18rem;'>
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
        <div class='card' style='width: 18rem;'>
        <img src='admin_page/actions/".$column['product_image']."' class='card-img-top' alt='".$column['product_name']." image'>
        <div class='card-body'>
        <a href='' class='btn btn-light border px-2 pt-2 float-end icon-hover'><i class='fas fa-heart fa-lg px-1 text-secondary'></i></a>
        <p class='card-text'>".$text."</p>
        <small><p class='card-title'><b>".$column['product_name'].":- Ksh ".number_format($column['price'])."</b></p></small>
        <a href='' class='btn btn-primary'>Add to cart</a>
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

//getting user ipAdress

function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
?>