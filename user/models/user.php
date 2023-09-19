<?php
include_once '../database/connection.php';

function user_input($data) {
	
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$username = user_input($_POST["username"]);
	$password = user_input($_POST["password"]);
	$stmt = $conn->prepare("SELECT * FROM users WHERE username='$username' AND password='$password'");
	$stmt->execute();
	$count = $stmt->rowCount();
    
    if($count==1) {
        header("location: user_page.php");
    }
    else {
        echo "<script language='javascript'>";
        echo "alert('wrong information')";
        echo "</script>";
    }
	
}
?>