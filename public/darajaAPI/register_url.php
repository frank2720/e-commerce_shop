<?php

$ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');

curl_setopt($ch, CURLOPT_HTTPHEADER, [

    'Authorization: Bearer bXuHFzMmFt44hTqChMBYvJ0TQIAE',

    'Content-Type: application/json'

]);

$data = array(
    "ShortCode"=>600998,

    "ResponseType"=>"Completed",

    "ConfirmationURL"=>"https://3906-154-122-121-38.ngrok-free.app/pudfra/darajaAPI/confirmation.php",

    "ValidationURL"=>"https://3906-154-122-121-38.ngrok-free.app/pudfra/darajaAPI/validation.php",

) ;

$json_data = json_encode($data);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response     = curl_exec($ch);

curl_close($ch);

echo $response;