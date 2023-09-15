<?php
include_once './database/connection.php';

//function of getting products to index.php
function getproducts(){
    global $conn;
    $select_products=$conn->prepare("SELECT * FROM products ORDER BY RAND()");
    //execute query
    $select_products->execute();
    
    $r=$select_products->setFetchMode(PDO::FETCH_ASSOC);
    $result=$select_products->fetchAll();
    
    foreach ($result as $column){
        echo "<div class='col-lg-3 col-md-6 col-sm-6 mb-2'>
        <div class='card' style='width: 18rem;'>
        <img src='admin_page/actions/".$column['product_image']."' class='card-img-top' alt='".$column['product_name']." image'>
        <div class='card-body'>
        <a href='#!' class='btn btn-light border px-2 pt-2 float-end icon-hover'><i class='fas fa-heart fa-lg px-1 text-secondary'></i></a>
        <h5 class='card-title'>".$column['product_name']."</h5>
        <p class='card-text'>".$column['product_description']."</p>
        <a href='#' class='btn btn-primary'>Add to cart</a>
        <a href='#' class='btn btn-secondary'>View more</a>
        </div>
        </div>
        </div>";
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
?>