<?php
  session_start();

  if( !isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != true ){

    header('location: ../index.php?login=erro2') ; //enviando erro via url (get)
  }
?>