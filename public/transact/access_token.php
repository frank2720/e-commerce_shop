<?php
$consumerKey = 'SjZbcsIER1TDuqchIaELunXYCKpdB76K';
$consumerSecret = 'EFnHQ1maJbY9fr5W';


$headers = array('Content-Type:application/json');

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
echo $access_token;