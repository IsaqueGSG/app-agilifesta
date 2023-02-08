<?php

$url = "http://localhost/app_agilifesta/API_agilifesta/";

if ( isset($_GET['id']) ){
    $url = "http://localhost/app_agilifesta/API_agilifesta/" . $_GET['id'];
}

$curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode( curl_exec($curl) );
    curl_close($curl);
?>

