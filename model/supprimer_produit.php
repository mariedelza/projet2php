<?php
include("connexion.php");

if (!empty($_POST['id'])) {
    // Récupérez l'identifiant du produit à supprimer
    $id = $_POST['id'];

    // Écrivez la requête SQL pour supprimer le produit avec cet identifiant
    $sql = "DELETE FROM produits WHERE id = :produitId";

    // Préparez la requête SQL
    $req = $connexion->prepare($sql);

    // Liez l'identifiant du produit à la requête
    $req->bindParam(':produitId', $id);

    // Exécutez la requête SQL
    if ($req->execute()) {
        // Si la suppression a réussi, redirigez l'utilisateur vers une page de confirmation
        $_SESSION['message']['text'] = "Le produit a été supprimé avec succès.";
        $_SESSION['message']['type'] = "success";
    } else {
        // En cas d'erreur lors de la suppression, affichez un message d'erreur
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de la suppression du produit.";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    // Si l'identifiant du produit n'a pas été passé en POST, redirigez l'utilisateur vers une page d'erreur
    $_SESSION['message']['text'] = "L'identifiant du produit n'a pas été spécifié.";
    $_SESSION['message']['type'] = "danger";
}

header('Location:../view/article.php');
