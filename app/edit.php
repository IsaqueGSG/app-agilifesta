<?php

use Illuminate\Support\Facades\Response;

require_once "controllers/login/validador_acesso.php"; 
?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>App App Agili Festa</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    
    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
      
      .card-abrir-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    
    </style>
  </head>

  <body >

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="assets/bolo-de-aniversario.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App App Agili Festa
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="./controllers/login/logoff.php" class="nav-link">SAIR</a>
        </li>
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

      <!-- INICIO CADASTRO DE USUARIOS -->
      <div class="card-abrir-chamado">
          <div class="card">
            <div class="card-header">
              Editar Evento
            </div>
            <div class="card-body">
              <form id="form" method="post" action="controllers/https/put.php">

                <?php
                  include "controllers/https/Api_request.php";
                  $API = new Requests;
                  $response = $API->get($_GET["id"])[0];
                ?>
                <input type="hidden" id="id" name="id" value="<?= $response->id ?>">
                <div class="row">
                  <div class="col">
                    
                      <div class="form-group">
                        <label>Título <?= $response->categoria ?></label>
                        <input type="text" class="form-control" placeholder="Título" name="titulo" id="titulo" value="<?= $response->titulo ?>">
                      </div>
                      
                      <input type="hidden" name="categoria_pass" id="categoria_pass" value=" <?= $response->categoria ?>">
                      <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control" name="categoria" id="categoria">
                          <option>Categoria</option>
                          <option>Festa Aniversario</option>
                          <option>Festa Casamento</option>
                          <option>Balada</option>
                        </select>
                      </div>
                      

                     

                      
                      <div class="form-group row">
                        <div class="col-10">

                          <label>convidado</label>
                          <input type="text" class="form-control" placeholder="Convidado - CPF"  id="convidado">
                        </div>
                        <div class="col-2">

                          <label>Adicionar</label>
                          <button type="button" onclick="cadastrar_convidado() " class="form-control" >
                            &#10010;
                          </button> 
                        </div>
                      </div>

                      <p class="position-static font-weight-bold"> Lista de convidados</p>
                      <div class="form-group" style="max-height: 150px ; overflow: auto">
                      
                        <table class="table" >
                          <tbody id="Tbody_convidados" ></tbody>
                        </table>

                        <input type="hidden" id="lista_convidados" name="lista_convidados" value="<?= $response->lista_convidados ?>">
                      </div>
                     
                  </div>

                  <!-- lado direito -->
                  <div class="col">
                    
                      <div class="form-group row">
                        <div class="col-8">

                          <label>Organizador</label>
                          <input type="text" class="form-control" placeholder="Organizador" name="organizador" id="organizador" value="<?= $response->organizador?>">
                        </div>
                        <div class="col">

                          <label>CPF</label>
                          <input type="text" class="form-control" placeholder="CPF" name="cpf" id="cpf_organizador" value="<?= $response->cpf ?>">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="col-8">

                          <label>Endereço</label>
                          <input type="text" class="form-control" placeholder="Endereco" name="endereco" id="endereco" value="<?= $response->endereco ?>">
                        </div>
                        <div class="col">

                          <label>Cep</label>
                          <input type="text" class="form-control" placeholder="Cep" name="cep" id="cep" value="<?= $response->cep ?>">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="col-8">

                          <label>Data</label>
                          <input type="date" class="form-control" name="data" id="data" value="<?= $response->data ?>">
                        </div>
                        <div class="col">

                          <label>Hora</label>
                          <input type="time" class="form-control" name="hora" id="hora" value="<?= $response->hora ?>">
                        </div>
                    </div>
                    <div class="form-group col">
                    
                        <input class="btn btn-lg btn-success " type="button" value="&#10004; Atualizar Evento " id="btn_submit" />
                       
                        <a class="btn btn-lg btn-danger " href="./app.php">&#10008; Cancelar</a>                    
                    </div>
                    
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      <!-- FINAL CADASTRO DE USUARIOS -->

    </div>
  </body>

  <script src="controllers/app.js" ></script>
  <script defer>
    
    // carregando categoria
    let texto =  document.querySelector("#categoria_pass").value ;
    
    let select = document.querySelector("#categoria") ;
    
    for (let i = 0; i < 4 ; i++){
      
      
      if(select.options[i].text.trim() === texto.trim()){
        //console.log(select.options[i].text.trim() )
        select.selectedIndex = i ;
        
        break;
      }
    }

    //carregando lista de convidados
    
  string_convidados = document.querySelector("#lista_convidados").value

  array_convidados = string_convidados.split("/")

  _ = array_convidados.pop() ;

  array_convidados.forEach( convidado =>{

    if(convidado != ""){
      
      cadastrar_convidado(convidado)
    }
  })

</script>
</html>