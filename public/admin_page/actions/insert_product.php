<?php

require __DIR__ . '/../../../src/bootstrap.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    // defining values
    $name=$_POST['product_name'];
    $cat=$_POST['product_category'];
    $price=$_POST['product_price'];
    $keywords=$_POST['product_keywords'];
    $description=$_POST['about_product'];

    //accessing image
    
	$extension = array("jpeg", "jpg", "png");
	$uploaddir = 'uploads/';

    foreach ($_FILES['productimage']['tmp_name'] as $key => $tmp_name) {
            
            $imagename=$uploaddir . basename($_FILES['productimage']['name'][$key]);
            $tempname = $_FILES['productimage']['tmp_name'][$key];

            $uploadOk = true;
            $ext = pathinfo($imagename,PATHINFO_EXTENSION);

            if (in_array($ext,$extension)==false) {
                $uploadOk = false;
            }

            if ($uploadOk == true) {
                move_uploaded_file($tempname,$imagename);
                
                $sql="INSERT INTO products (product_name,category_id,price,product_image,keywords,product_description) VALUES ('$name','$cat','$price','$imagename','$keywords','$description')";
                $insert=db()->exec($sql);
                
                if ($insert) {
                    echo "<script>alert('product added successfully')</script>";
                }else {
                    echo "<script>alert('possible file upload attack!')</script>";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta nname="viewport" content="width=device-width, initial-scale=1">
        <title>Insert products</title>

        <!-- Favicons -->
        <link href="../../imgs/favicon.jpg" rel="icon">
        <link href="../../imgs/favicon.jpg" rel="apple-touch-icon">

        <!-- bootstrap CSS link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <!--font awesome link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--css file-->
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body class="font-monospace bg-light">
        <div class="container">
        <form enctype="multipart/form-data" action="" method="POST">
            <div class="row">
                <div class="col-25">
                    <label for="ProductName">Product name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="ProductName" placeholder="Enter product name" name="product_name" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="keywords">Keywords</label>
                </div>
                <div class="col-75">
                    <input type="text" id="keywords" name="product_keywords" placeholder="keywords for product search e.g phone,laptop,Oppo,HP" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="Productprice">Price</label>
                </div>
                <div class=" col-75">
                    <input type="number" id="Productprice" name="product_price" min="1" placeholder="Kenya shillings" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="RetailPrice">Retail Price</label>
                </div>
                <div class=" col-75">
                    <input type="number" id="RetailPrice" name="rrp" min="1" placeholder="Kenya shillings" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="category">Category</label>
                </div>

                <div class="col-75">
                <select id="category" required name="product_category">
                    <option selected disabled class="text-primary">Select category</option>
                    <?php
                    $sql=db()->prepare("SELECT * FROM categories");
                    $sql->execute();
                    
                    $r=$sql->setFetchMode(PDO::FETCH_ASSOC);
                    $result=$sql->fetchAll();

                    foreach ($result as $column) {
                        echo "<option value=".$column['category_id'].">".$column['category_title']."</option>";
                    }
                    ?>
                </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="image">Product Image</label>
                </div>
                <div class="col-75">
                    <input name="productimage[]" id="image" type="file" value="" required multiple/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="description" class="form-label">Description</label>
                </div>
                <div class="col-75">
                    <textarea id="description" name="about_product" placeholder="Write a short description about the product..." style="height:200px" required></textarea>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" name="upload">Add product</button>
            </div>
        </form>
        </div>
        <!--bootstrap Js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>