<?php

$url_post = "http://localhost/app_agilifesta/API_agilifesta/post" ;

// criando array para enviar para a API
$dados = array(
    //id auto incremento
    "titulo" => $_POST['titulo'] ,
    "organizador" => $_POST['organizador'] ,
    "cpf" => $_POST['cpf'],
    "categoria" => $_POST['categoria'] ,
    "endereco" => $_POST['endereco'] ,
    "cep" => $_POST['cep'],
    "lista_convidados" => $_POST['lista_convidados'],
    "data" => $_POST['data'],
    "hora" => $_POST['hora'],
) ;

$iniciar = curl_init($url_post ) ; //iniciando requisicao


curl_setopt($iniciar, CURLOPT_RETURNTRANSFER, true ) ;
curl_setopt($iniciar, CURLOPT_POST, true ) ; //setando metodo POST
curl_setopt($iniciar, CURLOPT_POSTFIELDS, $dados ) ; //preparando dados para envio


curl_exec($iniciar); //enviando dados

curl_close($iniciar) ; //fechando requisicao

header("location: ../../app.php");//retornando a aplicacao