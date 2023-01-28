<?php


$url_del = "http://localhost/app_agilifesta/API_agilifesta/delete" ;


$iniciar = curl_init($url_del ) ; //iniciando requisicao


curl_setopt($iniciar, CURLOPT_URL, $url_del);
curl_setopt($iniciar, CURLOPT_CUSTOMREQUEST, "DELETE");

curl_exec($iniciar); //enviando dados

curl_close($iniciar) ; //fechando requisicao

//header("location: ../../app.php");//retornando a aplicacao