<?php
include"connexion.php";

function getproduits($id=null){
    if (!empty($id)) {
        $sql = "SELECT * FROM produits WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    }else {
        $sql = "SELECT * FROM produits";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }

    

}



function getclient($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM client WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM client";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function getvente($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT nom_produit, nom, prenom, v.quantitee, prix, date_vente ,v.id,prix_unitaire,adresse,telephone
        
         FROM client AS c, vente AS v,article AS a WHERE v.id_produit=a.id AND 
        v.id_client=c.id AND v.id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_produit, nom, prenom, v.quantitee, prix, date_vente  FROM client AS c, vente AS v,article AS a WHERE v.id_produit=a.id AND 
        v.id_client=c.id";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}




function getFournisseur($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM fournisseur WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM fournisseur";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function getcommande($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT nom_produit, nom, prenom, co.quantitee, prix, date_commande ,co.id,prix_unitaire,adresse,telephone
        
         FROM client AS c, commande AS co,article AS a WHERE co.id_produit=a.id AND 
        co.id_fournisseur=c.id AND v.id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_produit, nom, prenom, co.quantitee, prix, date_commande  FROM client AS co, vente AS v,article AS a WHERE co.id_produit=a.id AND 
        co.id_fournisseur=c.id";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}