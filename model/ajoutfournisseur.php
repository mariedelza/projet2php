<?php
include("connexion.php");
if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['telephone'])
    && !empty($_POST['adresse'])
   
) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
  
    $sql = "INSERT INTO fournisseur(nom,prenom,telephone,adresse)
            VALUES(:nom,:prenom,:telephone,:adresse)";

    $req = $connexion->prepare($sql);
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':telephone', $telephone);
    $req->bindParam(':adresse', $adresse);
    
    
    if ( $req->execute()!=0) {
        $_SESSION['message']['text'] = " votre fournisseur a ete ajouter avec succee";
        $_SESSION['message']['type'] = "success";
    }else {
        $_SESSION['message']['text'] = " une erreur lors de la saisie des informations fournisseur";
        $_SESSION['message']['type'] = "danger";
    }
   
} else {
    $_SESSION['message']['text'] = " information obligatoire non renseigner";
    $_SESSION['message']['type'] = "warning";
}

header('Location:../view/fournisseur.php');
