<?php
include_once 'access_token.php';

$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //Setting custom header

$curl_post_data = array(
    'ShortCode'=> '174379',
    'ResponseType'=> 'Completed',
    'ConfirmationURL'=> 'https://e70f-102-212-11-14.ngrok-free.app/ecommerce/public/transact/confirmation.php',
    'ValidationURL'=> 'https://e70f-102-212-11-14.ngrok-free.app/ecommerce/public/transact/validation.php',
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);

echo $curl_response;
?>