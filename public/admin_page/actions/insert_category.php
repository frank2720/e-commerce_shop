<?php
include_once '../database/connection.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
  
  //define the category variable
  $category=$_POST['cat_title'];
  
  //count the number or rows that contains the category
  $sql_select="SELECT COUNT(*) FROM categories WHERE category_title='$category'";
  $select=$conn->query($sql_select);
  $count=$select->fetchColumn();
  
  //check if the category already exist.
  if($count>0){
    echo "<script>alert('already exist!!')</script>";
  }else{
    
    //insert categories if it does not exist
    $sql_insert="INSERT INTO categories (category_title) VALUES ('$category')";
    $insert=$conn->exec($sql_insert);

    if($insert){
      echo "<script>alert('category added successfully')</script>";
    }else{
      echo "<script>alert('failed')</script>";
    }
  }
}
?>
<form action="" method="post">
<div class="input-group mb-3">
  <span class="input-group-text"><img src="assets/img/logo.jpg" height="30" /></span>
  <input type="text" class="form-control" placeholder="Add category.." name="cat_title">
  <input type="submit"  class="btn btn-primary btn-lg" value="Add Category">
</div>
</form>