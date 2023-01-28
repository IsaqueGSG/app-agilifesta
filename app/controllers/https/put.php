<?php
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
 

$id = $_POST["id"];
$url = "http://localhost/app_agilifesta/API_agilifesta/put/$id" ;


$iniciar = curl_init($url) ; //iniciando requisicao
curl_setopt($iniciar, CURLOPT_RETURNTRANSFER, true ) ;
curl_setopt($iniciar, CURLOPT_CUSTOMREQUEST, "PUT"); 




// curl_setopt($iniciar, CURLOPT_URL, $url);
// curl_setopt($iniciar, CURLOPT_PUT, true);
// curl_setopt($iniciar, CURLOPT_RETURNTRANSFER, true);

// $headers = array(
//    "Content-Type: application/x-www-form-urlencoded",
// );
// curl_setopt($iniciar, CURLOPT_HTTPHEADER, $headers);


curl_setopt($iniciar, CURLOPT_POSTFIELDS, http_build_query($dados)); //preparando dados para envio
curl_exec($iniciar); //enviando dados
curl_close($iniciar) ; //fechando requisicao

header("location: ../../app.php");//retornando a aplicacao
