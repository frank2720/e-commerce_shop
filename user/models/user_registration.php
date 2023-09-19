<?php
include_once '../database/connection.php';

function new_user_input($data) {
	
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$username = new_user_input($_POST["username"]);
    $phone=new_user_input($_POST['phone']);
    $email=new_user_input($_POST['email']);
	$password = new_user_input($_POST["password"]);
    $cpassword = new_user_input($_POST['confirm_password']);

    $stmt2 = $conn->prepare("SELECT * FROM users WHERE username='$username'");
	$stmt2->execute();
	$count = $stmt2->rowCount();
    
    if($count==0) {
        if($password==$cpassword){
            $hash = password_hash($password,PASSWORD_DEFAULT);
            #using password hashing
            $stmt1 = $conn->prepare("INSERT INTO users (username,password,email,phone) VALUES ('$username','$hash','$email','$phone')");
            if($stmt1->execute()){
                header('Location: login.php');
            }
        }else{
            echo "<script>alert('password does not match')</script>"; 
        }
    }
    elseif ($count>0) {
        echo "<script>alert('username available')</script>";
    } 
	
}
?>