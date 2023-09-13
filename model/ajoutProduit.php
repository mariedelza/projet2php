<?php
include("connexion.php");

if (
    !empty($_POST['nom_produit'])
    && !empty($_POST['categorie'])
    && isset($_POST['quantitee']) && is_numeric($_POST['quantitee']) && $_POST['quantitee'] >= 0
    && isset($_POST['prix_unitaire']) && is_numeric($_POST['prix_unitaire']) && $_POST['prix_unitaire'] >= 0
    && !empty($_POST['date_fabrication'])
    && !empty($_POST['date_expiration'])
) {
    $nom_produit = $_POST['nom_produit'];
    $categorie = $_POST['categorie'];
    $quantitee = $_POST['quantitee'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $date_fabrication = $_POST['date_fabrication'];
    $date_expiration = $_POST['date_expiration'];

    // Vérifier que la date de fabrication est inférieure à la date d'expiration
    if ($date_fabrication <= $date_expiration) {
        // Recherchez si un produit avec le même nom existe déjà
        $existing_product = $connexion->prepare("SELECT * FROM produits WHERE nom_produit = :nom_produit");
        $existing_product->bindParam(':nom_produit', $nom_produit);
        $existing_product->execute();
        $existing_product_data = $existing_product->fetch();

        if ($existing_product_data) {
            // Le produit existe déjà, mettez à jour la quantité
            $new_quantity = $existing_product_data['quantitee'] + $quantitee;
            $update_product = $connexion->prepare("UPDATE produits SET quantitee = :new_quantity WHERE nom_produit = :nom_produit");
            $update_product->bindParam(':new_quantity', $new_quantity);
            $update_product->bindParam(':nom_produit', $nom_produit);
            if ($update_product->execute()) {
                $_SESSION['message']['text'] = "La quantité du produit a été mise à jour avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Une erreur est survenue lors de la mise à jour du produit";
                $_SESSION['message']['type'] = "danger";
            }
        } else {
            // Le produit n'existe pas, insérez-le normalement
            $sql = "INSERT INTO produits(nom_produit, categorie, quantitee, prix_unitaire, date_fabrication, date_expiration)
                    VALUES(:nom_produit, :categorie, :quantitee, :prix_unitaire, :date_fabrication, :date_expiration)";

            $req = $connexion->prepare($sql);
            $req->bindParam(':nom_produit', $nom_produit);
            $req->bindParam(':categorie', $categorie);
            $req->bindParam(':quantitee', $quantitee);
            $req->bindParam(':prix_unitaire', $prix_unitaire);
            $req->bindParam(':date_fabrication', $date_fabrication);
            $req->bindParam(':date_expiration', $date_expiration);

            if ($req->execute() != 0) {
                $_SESSION['message']['text'] = "Votre produit a été ajouté avec succès";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Une erreur est survenue lors de l'ajout du produit";
                $_SESSION['message']['type'] = "danger";
            }
        }
    } else {
        $_SESSION['message']['text'] = "erreur lors de la saisie des dates reessayer";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    // Messages d'erreur pour les conditions non satisfaites
    if (empty($_POST['nom_produit'])) {
        $_SESSION['message']['text'] = "Le nom du produit est obligatoire";
    } elseif (empty($_POST['categorie'])) {
        $_SESSION['message']['text'] = "La catégorie du produit est obligatoire";
    } elseif (!isset($_POST['quantitee']) || !is_numeric($_POST['quantitee']) || $_POST['quantitee'] < 0) {
        $_SESSION['message']['text'] = "La quantité du produit doit être un nombre positif";
    } elseif (!isset($_POST['prix_unitaire']) || !is_numeric($_POST['prix_unitaire']) || $_POST['prix_unitaire'] < 0) {
        $_SESSION['message']['text'] = "Le prix unitaire du produit doit être un nombre positif";
    } elseif (empty($_POST['date_fabrication']) || empty($_POST['date_expiration'])) {
        $_SESSION['message']['text'] = "Les dates de fabrication et d'expiration du produit sont requises";
    } else {
        $_SESSION['message']['text'] = "Informations obligatoires non renseignées ou invalides";
    }
    $_SESSION['message']['type'] = "warning";
}

header('Location:../view/article.php');
