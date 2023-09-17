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




function getAllVente()
{
    $sql = "SELECT COUNT(*) AS nbre FROM vente";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute(); 

    return $req->fetch();
}


function getAllProduct()
{
    $sql = "SELECT COUNT(*) AS nbre FROM produits";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute();

    return $req->fetch();
}


function getAllClient()
{
    $sql = "SELECT COUNT(*) AS nbre FROM client";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute();

    return $req->fetch();
}


function getAllFouriseur()
{
    $sql = "SELECT COUNT(*) AS nbre FROM fournisseur";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute();

    return $req->fetch();
}


function getLastVente()
{
    try {
        $sql = "SELECT c.nom, c.prenom, v.quantitee, a.nom_produit, v.prix, v.date_vente
                FROM vente AS v
                INNER JOIN client AS c ON v.id_client = c.id
                INNER JOIN produits AS a ON v.id_produit = a.id
                ORDER BY v.date_vente DESC
                LIMIT 10";

        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
       
        echo "Erreur de base de données : " . $e->getMessage();
        return array(); 
    }
}



function getMostVente()
{
    try {
        $sql = "SELECT a.nom_produit, SUM(v.prix) AS total_prix
                FROM vente AS v
                INNER JOIN client AS c ON v.id_client = c.id
                INNER JOIN produits AS a ON v.id_produit = a.id
                GROUP BY a.nom_produit
                ORDER BY total_prix DESC
                LIMIT 10";

        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
       
        echo "Erreur de base de données : " . $e->getMessage();
        return array(); 
    }
}





