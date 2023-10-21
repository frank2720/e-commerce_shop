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

$url2 = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';

$curl2 =curl_init();
curl_setopt($curl2, CURLOPT_URL, $url);
curl_setopt($curl2, CURLOPT_HTTPHEADER,array('Content-Type:application/json','Authorization: Bearer '.$access_token));

$curl_post_data = array(
    "ShortCode"=> "600977",
    "CommandID"=> "CustomerPayBillOnline",
    "Amount"=> "503",
    "Msisdn"=> "254708374149",
    "BillRefNumber"=> "inv362"
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl2, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl2, CURLOPT_POST,true);
curl_setopt($curl2, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl2);
print_r($curl_response);
?>