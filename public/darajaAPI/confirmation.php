<?php
header("Content-Type: application/json;charset=utf-8");

$MpesaResponse = file_get_contents("php://input");

$log = fopen("mpesa_response.json","a");
fwrite($log, $MpesaResponse);
fclose($log);
?>