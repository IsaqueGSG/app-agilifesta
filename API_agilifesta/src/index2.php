<?php

require "vendor/autoload.php" ;

$app = new \Slim\App([
    "settings" => [ 
        "displayErrorDetails" => true 
    ]
]) ;

//primeiro parametro é a rota, a segunda é a resposta

//retorno da rota - retorna todos os dados
$app->get( "/"  , function(){
    echo "pagina GET , retorna tudo " ; //retorno da rota 
}) ;















//retorno da rota - retorna todos os usuarios
$app->get( "/usuarios"  , function(){
    echo "retorna todos os usuarios" ;
}) ;

































//retorno da rota - retorna apenas um usuario com base no id
$app->get( "/usuarios/{id}"  , function( $request , $response ){
   
    $id = $request->getAttribute("id") ; //recupera o id da url " {id} "

    echo "retorna o usuario do id : ". $id ;
}) ;


//recebendo varios parametros
$app->get( "/lista/{itens:.*}"  , function( $request , $response ){
   
    $itens = $request->getAttribute("itens") ; //recupera o id da url " {id} "
    
    echo $itens . "</br>" ;


    var_dump(explode( "/", $itens )) ; //separando os parametros, se haver mais de um parametro

}) ;


//nomeando rotas

$app->get( "/blog/postagens/{id}"  , function(){
    echo "Blog" ;
    echo "Blog" ;
}) -> setName("blog"); //setando nome aqui


$app->get( "/meuSite"  , function(){
    
    $retorno = $this->get("router")->pathFor("blog", ["id" => "5"]) ; //recuperando a rota blob e passando ID

    echo $retorno ;
}) ;


//agrupando rotas

$app->group( "/v1"  , function(){
    
    $this->get( "/usuarios" , function(){
        echo "agrupando" ;
    }) ;

    $this->get( "/produtos" , function(){
        echo "agrupando" ;
    }) ;
}) ;


// padrao SR-7
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get("/padrao_sr7" , function (Request $request , Response $response){
    
    $response->getBody()->write(" saida de dados padrao sr7s ");

    return $response ;
});


$app->post("/post" , function (Request $request , Response $response){
    
    
    $post = $request->getParsedBody() ;

    $nome = $post['nome'] ;
    $email = $post['email'] ;

    //logica insert
    
    $response->getBody()->write( "email recebido: " . $email . "</br> nome recebido " . $nome );
    
    return $response ;
});


$app->put("/put" , function (Request $request , Response $response){
    
    
    $post = $request->getParsedBody() ;

    $id = $post["id"] ;
    $nome = $post['nome'] ;
    $email = $post['email'] ;

    //logica update
    
    $response->getBody()->write( "id:" . $id ."email recebido: " . $email . "</br> nome recebido " . $nome );
    
    return $response ;
});

$app->delete("/delete/{id}" , function (Request $request , Response $response){
    
    
    // $post = $request->getParsedBody() ;

    $id = $request->getAttribute("id") ;

    //logica delete
    
    $response->getBody()->write( "excluindo dado de ID : " . $id );
    
    return $response ;
});


//dependencias e serviços
//injecao
class Servico {

}
$servico = new Servico;


//$app->get("/servico" , function( Request $request , Response $response) use ($servico) { });

//container pimple
$container = $app->getContainer() ;
$container['servico'] = function(){
    return new Servico ;
} ;

$app->get("/servico" , function( Request $request , Response $response){

    $servico = $this->get('servico'); //acessando o container
    var_dump($servico) ;
});


//controllers como servico
$container = $app->getContainer() ;
$container['View'] = function(){
    //return new MyApp\View ;
} ;

$app->get("/usuario" , "\MyApp\controllers\Home:index") ;


//tipos de respostas
//cabeçalho, texto ,Json, XML

$app->get("/header" , function( Request $request , Response $response){

    $response->getBody()->write( "retorno Header " );
    //$response->withHeader() ;
});

$app->get("/json" , function( Request $request , Response $response){

    //$response->getBody()->write( ' {"nome" : "isaque" } ' );

    //$response->withJson([ "nome" => "isaque" ]) ;

    $response->getBody()->write(json_encode(['nome' => "isaque "]));

    $request->withHeader('Content-Type', 'application/json'); 

    $response = $response->withHeader('Content-Type', 'application/json');

    return $response ;
});


//middleware
//camadas pre executadas, antes das rotas

//adicionando middlewares
$app->add(function($request, $response, $next){
   
    $response->getBody()->write( " camada 1: " );
    
    //return $next($request, $response) ; //$next carrega as rotas

    $response = $next($request, $response) ;

    $response->write("fim camada 1") ;

    return $response ;
}) ; 

/*
$app->add(function($request, $response, $next){
   
    $response->getBody()->write( " camada 2: " );
    
    return $next($request, $response) ;
}) ;  */

//sentido de carregamento dos middleware: de baixo para cima ^^

//rotas
$app->get("/auth" , function( Request $request , Response $response){

    $response->getBody()->write( "middleware autenticacao " );
});

$app->get("/getBD" , function( Request $request , Response $response){

    $response->getBody()->write( "middleware carrega os dados " );
});


//USANDO BANCO DE DADOS COM ILUMINATE   
use Illuminate\Database\Capsule\Manager as Capsule;

$container = $app->getContainer() ;
$container['db'] = function(){

    $capsule = new Capsule ;

    $capsule->addConnection([
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'slim',
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


$app->get("/get_bd_usuarios" , function (Request $request , Response $response){
    
    $db = $this->get("db") ; //acessando a variavel bd do container e o metodo schema()
    
    $db->schema()->dropIfExists("usuarios") ; //criando tabela

    
    $db->schema()->create("usuarios", function($table){
        $table->increments('id');
        $table->string('nome');
        $table->string('email');
        $table->timestamps();
    }) ;
    

    //inserindo dados

    $db->table("usuarios")->insert([
        //id auto incremento
        "nome" => "isaque",
        "email" => "isaque@adm",
    ]);

    //atualizando (put)
    $db->table("usuarios")->where("id",1)->update([ 
        "email" => "email@email"
    ]);

    //delete
    //$db->table("usuarios")->where("id",1)->delete(); 

    //listar
    $usuarios = $db->table("usuarios")->get() ;
    foreach ($usuarios as $user) {
        print_r( $user ) ; 

        echo $user->nome ;
        echo $user->email ;
    }



});

$app->run() ;