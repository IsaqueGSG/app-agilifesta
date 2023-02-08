<?php

use LDAP\Result;
use Slim\Http\Request;

require_once "controllers/login/validador_acesso.php"; 

?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>App Agili Festa</title>

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
        App Agili Festa
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
              Cadastro de Evento
            </div>
            <div class="card-body">
              <form id="form" method="post" action="controllers/https/post.php">
                <div class="row">
                  <div class="col">
                    
                      <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" placeholder="Título" name="titulo" id="titulo">
                      </div>
                      
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

                      <div class="form-group" >

                        <table class="table" >
                          <thead > <th> Lista de convidados</th></thead>
                          <tbody id="Tbody_convidados"  style="max-height: 150px ; overflow: auto; "> </tbody>
                        </table>

                        <input type="hidden" id="lista_convidados" name="lista_convidados">
                      </div>
                     
                  </div>

                  <!-- lado direito -->
                  <div class="col">
                    
                      <div class="form-group row">
                        <div class="col-8">

                          <label>Organizador</label>
                          <input type="text" class="form-control" placeholder="Organizador" name="organizador" id="organizador">
                        </div>
                        <div class="col">

                          <label>CPF</label>
                          <input type="text" class="form-control" placeholder="CPF" name="cpf" id="cpf_organizador" >
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="col-8">

                          <label>Endereço</label>
                          <input type="text" class="form-control" placeholder="Endereco" name="endereco" id="endereco">
                        </div>
                        <div class="col">

                          <label>Cep</label>
                          <input type="text" class="form-control" placeholder="Cep" name="cep" id="cep">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="col-8">

                          <label>Data</label>
                          <input type="date" class="form-control" name="data" id="data">
                        </div>
                        <div class="col">

                          <label>Hora</label>
                          <input type="time" class="form-control" name="hora" id="hora">
                        </div>
                      </div>
                    
                        <div class="col">
                        <input class="btn btn-lg btn-info btn-block" type="button" id="btn_submit" value="Cadastrar Evento"  >
                          
                        </div>
                      </div>
                  
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      <!-- FINAL CADASTRO DE USUARIOS -->


      <!-- INICIO CONSULTA DE USUARIOS -->
        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de Eventos
            </div>
            
            <div class="card-body">
            <?php
              include "controllers/https/get.php";
              foreach ( $response as $evento){
            ?>  

              <div class="card mb-3 bg-light">
                <div class="card-body row">
                  <div class="col">
                    <h5 class="card-title"> <?= $evento->categoria . " - " . $evento->titulo  ?> </h5>
                    <h6 class="card-subtitle mb-2 text-muted"> Data: <?= $evento->data . " as " . $evento->hora ?> </h6>
                    <p class="card-text"> Endereço: <?= $evento->endereco . " - " . $evento->cep ?> </p>
                    <p class="card-text"> Orgazinador: <?= $evento->organizador . " - " . $evento->cpf ?> </p>

                    <a class="btn btn-lg btn-danger mr-4" href="controllers/https/delete.php?id=<?= $evento->id ?>">
                    &#10008; Excluir Evento
                    </a>

                    <a class="btn btn-lg btn-info mr-4" href="edit.php?id=<?= $evento->id ?>">
                      &#9998; Editar Evento
                    </a>

                </div>

                  <div class="col">
                    <h5 class="card-title"> CONVIDADOS </h5>
                    <p class="card-text " style="height: 150px ; overflow: auto"> 
                      <?php
                        $convidados = explode("/",$evento->lista_convidados);
                       
                        foreach($convidados as $convidado){
                          echo $convidado . "</br>";
                      } ?> 
                    </p>
                    
                  </div>
                  
                </div>
              </div>

              <?php } ?>

            </div>
          </div>
        </div>
      <!-- Final consultas -->    


    </div><!-- FINAL CONTAINER -->
    
  </body>
  
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
  <script src="controllers/app.js"></script>
  

</html>