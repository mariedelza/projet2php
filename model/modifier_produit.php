<?php
include("connexion.php");
if (
    !empty($_POST['nom_produit'])
    && !empty($_POST['categorie'])
    && !empty($_POST['quantitee'])
    && !empty($_POST['prix_unitaire'])
    && !empty($_POST['date_fabrication'])
    && !empty($_POST['date_expiration'])
    && !empty($_POST['id'])
) {
    $nom_produit = $_POST['nom_produit'];
    $categorie = $_POST['categorie'];
    $quantitee = $_POST['quantitee'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $date_fabrication = $_POST['date_fabrication'];
    $date_expiration = $_POST['date_expiration'];
    $id = $_POST['id'];

        $sql= "UPDATE produits SET nom_produit=:nom_produit,categorie=:categorie,quantitee=:quantitee,prix_unitaire=:prix_unitaire,date_fabrication=:date_fabrication,
            date_expiration=:date_expiration WHERE id=:produitId";

    $req = $connexion->prepare($sql);

    $req->bindParam(':nom_produit', $nom_produit);
    $req->bindParam(':categorie', $categorie);
    $req->bindParam(':quantitee', $quantitee);
    $req->bindParam(':prix_unitaire', $prix_unitaire);
    $req->bindParam(':date_fabrication', $date_fabrication);
    $req->bindParam(':date_expiration', $date_expiration);
    $req->bindParam(':produitId', $id);



    if ($req->execute() != 0) {
        $_SESSION['message']['text'] = " votre produit a ete modifier avec succee";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = " une erreur lors de la saisie du produit";
        $_SESSION['message']['type'] = "danger";
    }
}

header('Location:../view/article.php');
    




  
