<?php
$consumerKey = 'SjZbcsIER1TDuqchIaELunXYCKpdB76K';
$consumerSecret = 'EFnHQ1maJbY9fr5W';


$headers = ['Content-Type:application/json; charset=utf8'];

$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$curl = curl_init($url);

curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey .':'. $consumerSecret);

$response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$response = json_decode($response);

$access_token = $response->access_token;

$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //Setting custom header

$curl_post_data = array(
    'ShortCode'=> '600982',
    'ResponseType'=> 'Completed',
    'ConfirmationURL'=> 'https://e70f-102-212-11-14.ngrok-free.app/ecommerce/public/transact/confirmation.php',
    'ValidationURL'=> 'https://e70f-102-212-11-14.ngrok-free.app/ecommerce/public/transact/validation.php',
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;
?>