<?php
include("connexion.php");
if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['telephone'])
    && !empty($_POST['adresse'])
    && !empty($_POST['id'])
) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $id = $_POST['id'];

        $sql= "UPDATE fournisseur SET nom=:nom,prenom=:prenom,telephone=:telephone,adresse=:adresse
         WHERE id=:fournisseurId";

    $req = $connexion->prepare($sql);

    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':telephone', $telephone);
    $req->bindParam(':adresse', $adresse);
    $req->bindParam(':fournisseurId', $id);



    if ($req->execute() != 0) {
        $_SESSION['message']['text'] = " votre fournisseur a ete modifier avec succee";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = " une erreur lors de la saisie du fournisseur";
        $_SESSION['message']['type'] = "danger";
    }
}

header('Location:../view/fournisseur.php');
    




  
