<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("connexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "DELETE FROM fournisseur WHERE id = :fournisseurId";
    $req = $connexion->prepare($sql);
    $req->bindParam(':fournisseurId', $id, PDO::PARAM_INT); // Assurez-vous que $id est de type entier

    if ($req->execute()) { 
        $_SESSION['message']['text'] = "Le fournisseur a été supprimé avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de la suppression du fournisseur";
        $_SESSION['message']['type'] = "danger";
    }
}

header('Location:../view/fournisseur.php');
