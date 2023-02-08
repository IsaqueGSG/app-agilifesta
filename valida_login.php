<?php


// recuperando parametros da pag index via post/get
// os metodos $_GET e $_POST recebem os valores do form e organiza em um array
// a chave é o name do input
/* EX: $_POST = [
    'email'= "isaque@123" , 
    'senha'= "123456" , 
    ]
    */
    
    session_start();

    $email_recebido = $_POST['email'] ;
    $senha_recebida = $_POST['senha'] ;

    //usuarios do sistema
    $perfis = array(
       1=> "Gestor" , 
    ) ;

    $contas_autenticadas= array(
        array(
            "id"=> 1, 
            "email"=>"adm@adm", 
            "senha"=>"adm", 
            "perfil_id"=>1
        )
    );

    //autenticando usuario
    $usuario_autenticado = false ;
    $usuario_id = null ;
    $usuario_perfil_id = null ;

    foreach($contas_autenticadas as $user){

        $email_autenticado = $user['email'];
        $senha_autenticada = $user['senha'];

        if($email_autenticado === $email_recebido && $senha_autenticada === $senha_recebida){
            $usuario_autenticado = true ;
            $usuario_id = $user["id"] ;
            $usuario_perfil_id = $user["perfil_id"];
        }

    }

    if($usuario_autenticado){
        echo 'usuario autenticado' ;
        $_SESSION['autenticado'] = true ;
        $_SESSION['id'] = $usuario_id ;
        $_SESSION['perfil_id'] = $usuario_perfil_id ;
        header('location: ../../app.php') ;
    } else {
        $_SESSION['autenticado'] = false ;
        header('location: ../../index.php?login=erro') ; //enviando erro via url (get)
    }

?>


