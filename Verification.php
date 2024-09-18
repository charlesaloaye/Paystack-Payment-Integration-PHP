<?php
$curl = curl_init();

$reference = isset($_GET['reference']) ?? '';

if (!$reference) {
    die('No Payment Transaction Reference Received');
}

curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "authorization: Bearer " . APP_API_KEY,
            "cache-control: no-cache"
        ],
    )
);

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
    // there was an error contacting the Paystack API
    die('Curl returned error: ' . $err);
}

$tranx = json_decode($response);

if (!$tranx->status) {
    // there was an error from the API
    die('API returned error: ' . $tranx->message);
}

if ('success' == $tranx->data->status) {
    // Your Success Statement

} else {

    // Your Error Statement
}
