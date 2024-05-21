<?php
session_start();
include_once('../../Metier/produit.php');
if (!isset($_SESSION['login'])) {
  header("Location: http://localhost/Mini1/");
}

if (isset($_GET)) {
  Produit::deleteProduit($_GET['id']);
}

header("Location: http://localhost/Mini1/Presentation/Produit/afficherProduits.php");
