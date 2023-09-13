<?php
//connect to database
include_once '../../database/connection.php';


if($_SERVER['REQUEST_METHOD']=='POST'){
    // defining values
    $name=$_POST['product_name'];
    $cat=$_POST['product_category'];
    $price=$_POST['product_price'];
    $description=$_POST['about_product'];

    //images directory 
    $imagedir = 'uploads/';

    //accessing image
    $image=$imagedir . basename($_FILES['productimage']['name']);
    //accessing image tmp_name and uploading it.
    move_uploaded_file($_FILES['productimage']['tmp_name'],$image);

    $sql="INSERT INTO products (product_name,category,price,product_image,product_description) VALUES ('$name','$cat','$price','$image','$description')";
    $insert=$conn->exec($sql);
    if($insert){
        echo "<script>alert('product added sucessfully')</script>";
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
        <link href="images/7660092.jpg" rel="icon">
        <link href="images/7660092.jpg" rel="apple-touch-icon">

        <!-- bootstrap CSS link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <!--font awesome link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--css file-->
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="p-3 mb-2 bg-secondary text-white">
        <form class="mx-auto p" style="width: 200px;" enctype="multipart/form-data" action="" method="POST">
            <div class="form-group mb-3">
                <label for="ProductName">Product name</label>
                <input type="text" class="form-control form-control-sm" id="ProductName" name="product_name" required>
            </div>
            <div class="form-group mb-3">
                <label for="ProductName">Price</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="text" class="form-control form-control-sm" id="Productprice" name="product_price" required>
                </div>
            </div>
            <div class="form-group mb-3">
                <select class="form-select" id="category" required name="product_category">
                    <option selected disabled class="text-primary">Select category</option>
                    <?php
                    $sql=$conn->prepare("SELECT * FROM categories");
                    $sql->execute();
                    
                    $r=$sql->setFetchMode(PDO::FETCH_ASSOC);
                    $result=$sql->fetchAll();

                    foreach ($result as $column) {
                        echo "<option>".$column['category_title']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <!-- MAX_FILE_SIZE must precede the file input field -->
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <!-- Name of input element determines name in $_FILES array -->
                <input name="productimage" type="file" />
            </div>
            <div class="form-group mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="about_product" required></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Add product">
        </form>
        <!--bootstrap Js link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>