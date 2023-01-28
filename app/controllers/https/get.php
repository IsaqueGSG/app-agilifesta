<?php

$url = "http://localhost/app_agilifesta/API_agilifesta/";

if ( isset($id_get )){

    $url = "http://localhost/app_agilifesta/API_agilifesta/$id_get";
}

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($curl);
curl_close($curl);


?>

