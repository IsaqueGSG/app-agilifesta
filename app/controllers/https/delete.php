<?php


$url = "http://localhost/app_agilifesta/API_agilifesta/delete" ;

if ( isset($_GET['id'])){
    $url = "http://localhost/app_agilifesta/API_agilifesta/delete/" . $_GET['id'] ;
}

$curl = curl_init($url ) ; //iniciando requisicao
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_exec($curl);

header("location: ../../app.php");//retornando a aplicacao