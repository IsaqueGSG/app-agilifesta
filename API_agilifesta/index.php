<?php

// padrao SR-7
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require "vendor/autoload.php" ;

$app = new \Slim\App([
    "settings" => [ 
        "displayErrorDetails" => true 
    ]
]) ;


//USANDO BANCO DE DADOS COM ILUMINATE   
use Illuminate\Database\Capsule\Manager as Capsule;

//configuracao do banco de dados
$container = $app->getContainer() ;
$container['bd'] = function(){

    $capsule = new Capsule ;

    $capsule->addConnection([
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'agili_festa',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    
    return $capsule ;
};




$app->get("/createBD" , function (Request $request , Response $response){
    
    $bd = $this->get("bd") ; //acessando a variavel bd do container e o metodo schema()
  
    $bd->schema()->dropIfExists("eventos") ; //criando tabela
    
    $bd->schema()->create("eventos", function($table){
        $table->increments('id');
        $table->string('titulo');
        $table->string('organizador');
        $table->string('cpf');
        $table->string('categoria');
        $table->string('endereco');
        $table->string('cep');
        $table->string('lista_convidados');
        $table->string('data');
        $table->string('hora');
        //$table->timestamps();
    }) ;
});



$app->get("/[{id}]", function(Request $request, Response $response){

    //listar

    $id = $request->getAttribute("id") ;
    $bd = $this->get("bd") ; //acessando a variavel bd do container e o metodo schema()
    
    $evento = $bd->table("eventos")->get() ;

    if( $id != ""){
        $evento = $bd->table("eventos")->where("id",$id)->get() ;

    }

    $response = $response->withHeader('Content-Type', 'application/json');  
    $response->getBody()->write(json_encode($evento));
});    

$app->post("/post", function(Request $request, Response $response){
    
    //inserindo dados
    $post = $request->getParsedBody() ;
    
    $titulo = $post['titulo'] ;
    $organizador = $post['organizador'] ;
    $cpf = $post['cpf'] ;
    $categoria = $post['categoria'] ;
    $endereco = $post['endereco'] ;
    $cep = $post['cep'] ;
    $lista_convidados = $post['lista_convidados'] ;
    $data = $post['data'] ;
    $hora = $post['hora'] ;

    //logica insert
    $bd = $this->get("bd") ; //acessando a variavel bd do container e o metodo schema()
    
    $bd->table("eventos")->insert([
        //id auto incremento
        "titulo" => $titulo,
        "organizador" => $organizador,
        "cpf" => $cpf,
        "categoria" => $categoria,
        "endereco" => $endereco,
        "cep" => $cep,
        "lista_convidados" => $lista_convidados,
        "data" => $data,
        "hora" => $hora,
    ]);
});



$app->delete("/delete/{id}",function(Request $request, Response $response){
    //delete
    $bd = $this->get("bd") ; //acessando a variavel bd do container e o metodo schema()

    $id = $request->getAttribute("id") ;

    $bd->table("eventos")->where("id",$id)->delete(); 
});



$app->put("/put/{id}", function(Request $request, Response $response, $args){
    //atualizando (put)
    
    $id = $request->getAttribute("id") ;
    
    
    $post = $request->getParsedBody() ;
    
    $titulo = $post['titulo'] ;
    $organizador = $post['organizador'] ;
    $cpf = $post['cpf'] ;
    $categoria = $post['categoria'] ;
    $endereco = $post['endereco'] ;
    $cep = $post['cep'] ;
    $lista_convidados = $post['lista_convidados'] ;
    $data = $post['data'] ;
    $hora = $post['hora'] ;
    
    
    
    $bd = $this->get("bd") ; //acessando a variavel bd do container e o metodo schema()
    
    $bd->table("eventos")->where("id",$id)->update([
        //id auto incremento
        "titulo" => $titulo,
        "organizador" => $organizador,
        "cpf" => $cpf,
        "categoria" => $categoria,
        "endereco" => $endereco,
        "cep" => $cep,
        "lista_convidados" => $lista_convidados,
        "data" => $data,
        "hora" => $hora,
    ]);

});


$app->run() ;

?>