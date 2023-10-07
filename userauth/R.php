<?php
include_once '../database/connection.php';

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['phone'], $_POST['email'], $_POST['password'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['phone']) || empty($_POST['email']) || empty($_POST['password'])) {
	// One or more values are empty.
	exit('Please complete the registration form');
}

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
    $cpassword = new_user_input($_POST["confirm_password"]);
    $code = uniqid();

    $stmt2 = $conn->prepare("SELECT * FROM accounts WHERE username='$username'");
	$stmt2->execute();
	$count = $stmt2->rowCount();
    
    if($count==0) {
        if($password==$cpassword){
            $hash = password_hash($password,PASSWORD_DEFAULT);
            #using password hashing
            $stmt1 = $conn->prepare("INSERT INTO accounts (username,phone,email,password,activation_code) VALUES ('$username','$phone','$email','$hash','$code')");
            if($stmt1->execute()){
                $from    = 'noreply@yourdomain.com';
                $subject = 'Account Activation Required';
                $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
                // Update the activation variable below
                $activate_link = 'http://yourdomain.com/phplogin/activate.php?email=' . $_POST['email'] . '&code=' . $code;
                $message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
                mail($_POST['email'], $subject, $message, $headers);
                echo 'Please check your email to activate your account!';
            }
        }else{
            echo "<script>alert('password does not match')</script>"; 
            include_once 'register.html';

        }
    }
    elseif ($count>0) {
        echo "<script>alert('username available')</script>";
        include_once 'register.html';
    } 
	
}

?>