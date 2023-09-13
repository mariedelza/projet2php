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

    // Vérifier si le numéro de téléphone est valide
    if (preg_match('/^(77|78|76|75|70)[0-9]{7}$/', $telephone)) {
        // Vérifier si le numéro de téléphone existe déjà parmi les fournisseurs
        $checkSql = "SELECT COUNT(*) FROM fournisseur WHERE telephone = :telephone";
        $checkStmt = $connexion->prepare($checkSql);
        $checkStmt->bindParam(':telephone', $telephone);
        $checkStmt->execute();
        $existingRows = $checkStmt->fetchColumn();

        if ($existingRows > 0) {
            // Le numéro de téléphone existe déjà parmi les fournisseurs
            $_SESSION['message']['text'] = "Le numéro de téléphone existe déjà.";
            $_SESSION['message']['type'] = "danger";
        } else {
            // Le numéro de téléphone est unique, insérer dans la base de données
            $sql = "INSERT INTO fournisseur(nom, prenom, telephone, adresse)
                    VALUES(:nom, :prenom, :telephone, :adresse)";
            $req = $connexion->prepare($sql);
            $req->bindParam(':nom', $nom);
            $req->bindParam(':prenom', $prenom);
            $req->bindParam(':telephone', $telephone);
            $req->bindParam(':adresse', $adresse);

            if ($req->execute()) {
                $_SESSION['message']['text'] = "Votre fournisseur a été ajouté avec succès.";
                $_SESSION['message']['type'] = "success";
            } else {
                $_SESSION['message']['text'] = "Une erreur est survenue lors de l'ajout des informations fournisseur.";
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

header('Location:../view/fournisseur.php');
?>
