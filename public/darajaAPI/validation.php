<?php
header("Content-Type:application/json");

$response = '{
    "ResponseCode":"0",
    "ResponseDescription":"Confirmation Received Successfully"
}';

$MpesaResponse = file_get_contents('php://input');
$jsonMpesaResponse = json_decode($MpesaResponse, true);

$log = fopen('MPESA_Response.txt','a');
fwrite($log,$jsonMpesaResponse);
fclose($log);
