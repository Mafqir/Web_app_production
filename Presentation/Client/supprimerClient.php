<?php 
  session_start();
  include_once('../../Metier/client.php');
  if(!isset($_SESSION['login'])){
    header("Location: http://localhost/Mini1/");
  }

    if(isset($_GET)){
      DAO::deleteClient($_GET['id']);
    }

    header("Location: http://localhost/Mini1/Presentation/Client/afficherClients.php");
