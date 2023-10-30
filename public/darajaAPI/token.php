<?php
/**
 * Used to access token key, for use in other APIs
 */
function access_token(){
    $consumer_key = 'SjZbcsIER1TDuqchIaELunXYCKpdB76K';
    $consumer_secret = 'EFnHQ1maJbY9fr5W';

    $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERPWD, $consumer_key .':'. $consumer_secret);

    $response = curl_exec($ch);
    curl_getinfo($ch, CURLINFO_HTTP_CODE);

    $response = json_decode($response,true);
    curl_close($ch);
    echo $response["access_token"];
}