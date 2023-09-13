<?php
include("connexion.php");
include_once "function.php";

if (
    !empty($_POST['id_produit'])
    && !empty($_POST['id_client'])
    && isset($_POST['quantitee']) && is_numeric($_POST['quantitee']) && $_POST['quantitee'] > 0 // Check if quantity is numeric and positive
    && !empty($_POST['prix'])
) {
    $id_produit = $_POST['id_produit'];
    $id_client = $_POST['id_client'];
    $quantitee = $_POST['quantitee'];
    $prix = $_POST['prix'];

    $sql = "SELECT quantitee FROM produits WHERE id=:produits_id";
    $req = $connexion->prepare($sql);

    $req->bindParam(':produits_id', $id_produit);
    $req->execute();
    // Transforme cette ligne en tableau associatif
    $row = $req->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['quantitee'] >= $quantitee) {
        // Quantité en stock suffisante
        $sql = "INSERT INTO vente(id_client,id_produit,quantitee,prix) VALUE(:id_client,:id_produit,:quantitee,:prix)";
        $req = $connexion->prepare($sql);
        $req->bindParam(':id_client', $id_client);
        $req->bindParam(':id_produit', $id_produit);
        $req->bindParam(':quantitee', $quantitee);
        $req->bindParam(':prix', $prix);

        $req->execute();

        $sql = "UPDATE produits SET quantitee=quantitee-:quantitee WHERE id=:produits_id";

        $req = $connexion->prepare($sql);
        $req->bindParam(':quantitee', $quantitee);
        $req->bindParam(':produits_id', $id_produit);

        $req->execute();
        $_SESSION['message']['text'] = "Votre vente a été ajoutée avec succès.";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Quantité demandée non disponible en stock.";
        $_SESSION['message']['type'] = "warning";
    }
} else {
    $_SESSION['message']['text'] = "la quantitée ne doit pas etre negatif";
    $_SESSION['message']['type'] = "danger";
}

header('Location:../view/vente.php');
