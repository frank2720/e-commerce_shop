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
	$stmt = $conn->prepare("SELECT * FROM users WHERE username='$username'");
	$stmt->execute();
	$count = $stmt->rowCount();

	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$users=$stmt->fetchAll();
    
    if($count==1) {
		foreach ($users as $user) {
			if(password_verify($password,$user['password'])){
				header("location: user_page.php");
			}else {
				echo "<script language='javascript'>";
				echo "alert('password is incorrect!')";
				echo "</script>";
			}
		}
    }
    else {
        echo "<script language='javascript'>";
        echo "alert('no user found')";
        echo "</script>";
    }
	
}
?>