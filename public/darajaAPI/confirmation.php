<?php
header("Content-Type:application/json");

$response = '{
    "ResponseCode":"0",
    "ResponseDescription":"Confirmation Received Successfully"
}';

$MpesaResponse = file_get_contents('php://input');

$info = fopen('MPESA_Response.txt','a');
fwrite($info,$MpesaResponse);
fclose($info);
