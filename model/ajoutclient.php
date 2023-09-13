<?php
include("connexion.php");

// Ajout de la contrainte d'unicité à la colonne "telephone"
$sql = "ALTER TABLE client ADD UNIQUE (telephone)";
$connexion->exec($sql);

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

    // Vérifier si le numéro de téléphone est valide
    if (preg_match('/^(78|77|75|70|76)\d{7}$/', $telephone)) {
        // Vérifier si le numéro de téléphone existe déjà
        $checkSql = "SELECT COUNT(*) FROM client WHERE telephone = :telephone";
        $checkStmt = $connexion->prepare($checkSql);
        $checkStmt->bindParam(':telephone', $telephone);
        $checkStmt->execute();
        $existingRows = $checkStmt->fetchColumn();

        if ($existingRows > 0) {
            // Le numéro de téléphone existe déjà
            $_SESSION['message']['text'] = "Le numéro de téléphone existe déjà.";
            $_SESSION['message']['type'] = "danger";
        } else {
            // Le numéro de téléphone est valide et unique, insérer dans la base de données
            $sql = "INSERT INTO client(nom, prenom, telephone, adresse)
                    VALUES(:nom, :prenom, :telephone, :adresse)";
            $req = $connexion->prepare($sql);
            $req->bindParam(':nom', $nom);
            $req->bindParam(':prenom', $prenom);
            $req->bindParam(':telephone', $telephone);
            $req->bindParam(':adresse', $adresse);

            if ($req->execute()) {
                $_SESSION['message']['text'] = "Votre client a été ajouté avec succès.";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Une erreur est survenue lors de l'ajout des informations client.";
                $_SESSION['message']['type'] = "danger";
            }
        }
    } else {
        // Le numéro de téléphone est invalide
        $_SESSION['message']['text'] = "Le numéro de téléphone est invalide.";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Des informations obligatoires ne sont pas renseignées.";
    $_SESSION['message']['type'] = "warning";
}

header('Location: ../view/client.php');
