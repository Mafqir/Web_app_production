<?php
session_start();
include_once('../../Metier/client.php');
if (!isset($_SESSION['login'])) {
  header("Location: http://localhost/Mini1/");
}
if (isset($_POST)) {

  if (extract($_POST)) {
    $c = new Client($nom, $adresse, $telephone, $email);
    $c->setId($id);
    $dao = new DAO();
    $dao->updateClient($c);
    $succes = true;
    unset($_POST);
  }
  unset($_POST);
}
header("Location: http://localhost/Mini1/Presentation/Client/afficherClients.php");
