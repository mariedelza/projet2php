<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("connexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $connexion->query("SET FOREIGN_KEY_CHECKS = 0");
    $sql = "DELETE FROM produits WHERE id = :produitId"; 
    $req = $connexion->prepare($sql);
    $req->bindParam(':produitId', $id);

    if ($req->execute()) { 
        $_SESSION['message']['text'] = "Le produit a été supprimé avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de la suppression du produit";
        $_SESSION['message']['type'] = "danger";
    }
    $connexion->query("SET FOREIGN_KEY_CHECKS = 1");
}

header('Location:../view/article.php');
