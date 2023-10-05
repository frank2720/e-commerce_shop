<?php
session_start();
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
	$stmt = $conn->prepare("SELECT * FROM accounts WHERE username='$username'");
	$stmt->execute();
	$count = $stmt->rowCount();

	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$users=$stmt->fetchAll();
    
    if($count==1) {
		foreach ($users as $user) {
			if(password_verify($password,$user['password'])){

				// Verification success! User has logged-in!
				// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
				session_regenerate_id();
				$_SESSION['loggedin'] = true;
				$_SESSION['name']=$username;
				$_SESSION['id']=$user['id'];
				header("location: ../index.php");
			}else {
				echo "<script language='javascript'>";
				echo "alert('password is incorrect!')";
				echo "</script>";
				include_once 'login.html';
			}
		}
    }
    else {
        echo "<script language='javascript'>";
        echo "alert('user does not exist!')";
        echo "</script>";
		include_once 'login.html';
    }
	
}
?>