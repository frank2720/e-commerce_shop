<?php
header("Content-Type: application/json;charset=utf-8");

$MpesaResponse = file_get_contents("php://input");
$jsonMpesaResponse = json_decode($MpesaResponse, true);

$log = fopen("mpesa_validation_response.txt","a");
fwrite($log, $jsonMpesaResponse);
fclose($log);
?>