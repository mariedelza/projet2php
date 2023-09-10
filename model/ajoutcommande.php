<?php


include("connexion.php");
include_once "function.php";


if (
    !empty($_POST['id_produit'])
    && !empty($_POST['id_fournisseur'])
    && !empty($_POST['quantitee'])
    && !empty($_POST['prix'])

) {
    $id_produit = $_POST['id_produit'];
    $id_fournisseur = $_POST['id_fournisseur'];
    $quantitee = $_POST['quantitee'];
    $prix = $_POST['prix'];

    $sql = "INSERT INTO commande(id_produit,id_fournisseur,quantitee,prix)
            VALUES(:id_produit,:id_fournisseur,:quantitee,:prix)";

    $req = $connexion->prepare($sql);
    $req->bindParam(':id_produit', $id_produit);
    $req->bindParam(':id_fournisseur', $id_fournisseur);
    $req->bindParam(':quantitee', $quantitee);
    $req->bindParam(':prix', $prix);


    if ($req->rowCount() !=0) {
        $sql = "UPDATE produits SET quantitee=quantitee+:quantitee WHERE id=:produits_id";

        $req = $connexion->prepare($sql);
        $req->bindParam(':quantitee', $quantitee);
        $req->bindParam(':produits_id', $id_produit);
        $req->execute();
        
        if ($req->rowCount() !=0){
           
            $_SESSION['message']['text'] = " votre commande a ete ajouter avec succee";
            $_SESSION['message']['type'] = "success";
        }else {
            $_SESSION['message']['text'] = "impossible d'effectuer une commande";
            $_SESSION['message']['type'] = "danger";
        }
    }else {
        
        $_SESSION['message']['text'] = " une erreur de saisie reessayer";
        $_SESSION['message']['type'] = "warning";
   
    }

} else {
    $_SESSION['message']['text'] = " information obligatoire non renseignee";
    $_SESSION['message']['type'] = "danger";
}
header('Location:../view/commande.php');
