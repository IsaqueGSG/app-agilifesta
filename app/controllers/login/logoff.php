<?php
    //removendo o indice da session que valida se o usuario esta autenticado

    //removendo indice especifico
    //unset()

    //destruindo a variavel global session
    //session_destroy()

    session_start();

    //removendo apenas um array da $session se ele existir
    //unset($_SESSION['autenticado']) ;

    // a sessao sera destruida apenas quando a pagina for recarregada (quando for aberta uma nova requisicao)
    session_destroy();

    // forcando o refresh
    header('location: ../../index.php ')

?>