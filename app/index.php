<html>
  <head>
    <meta charset="utf-8" />
    <title>App Agili Festa</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="controllers/app1.js"></script>
    <style>
      .card-login {
        padding: 30px 0 0 0;
        width: 350px;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="assets/bolo-de-aniversario.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Agili Festa
      </a>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-login">
          <div class="card">
            <div class="card-header">
              Login
            </div>
            <div class="card-body">
              <form action="controllers/login/valida_login.php" method="post">
                <div class="form-group">
                  <input name="email" type="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <input name="senha" type="password" class="form-control" placeholder="Senha">
                </div>

                
                <?php
                  //isset verifica se a chave esta setada e existe no array
                  if ( isset($_GET["login"]) && $_GET["login"] == "erro" ) {
                ?>
                    
                  <div class="text-danger"> 
                    usuario ou senha invalido(s)
                  </div>
                  
                <?php } // fechamento do if   ?>


                <?php
                  //isset verifica se a chave esta setada e existe no array
                  if ( isset($_GET["login"]) && $_GET["login"] == "erro2" ) {
                ?>
                    
                  <div class="text-danger"> 
                    Faça login para acessar a pagina!
                  </div>
                  
                <?php } // fechamento do if   ?>

                <button class="btn btn-lg btn-info btn-block" type="submit">Entrar</button>
              </form>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>