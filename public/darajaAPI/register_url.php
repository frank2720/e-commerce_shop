<?php
require __DIR__ ."token_auth.php";

$ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.token(),'Content-Type: application/json;charset=utf-8'));
curl_setopt($ch, CURLOPT_POST, true);

$data = array(
    "ShortCode"=> 600984,
    "ResponseType"=> "Completed",
    "ConfirmationURL"=> "https://f5da-102-212-11-14.ngrok-free.app/pudfra/darajaAPI/confirmation.php",
    "ValidationURL"=> "https://f5da-102-212-11-14.ngrok-free.app/pudfra/darajaAPI/validation.php",
);
$json_data = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>