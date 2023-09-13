<?php
session_start();
include 'entete.php';
include '../model/connexion.php';

// Vérifiez si un ID de vente est passé en paramètre dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = [
        'type' => 'error',
        'text' => 'ID de vente non valide.'
    ];
    header('Location: vente.php'); // Redirige vers la page des ventes
    exit();
}

$id_vente = $_GET['id'];

// Récupérez les données de la vente à partir de la base de données
$sql = "SELECT * FROM vente WHERE id = :id_vente";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':id_vente', $id_vente, PDO::PARAM_INT);
$stmt->execute();
$vente = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifiez si la vente existe
if (!$vente) {
    $_SESSION['message'] = [
        'type' => 'error',
        'text' => 'Vente non trouvée.'
    ];
    header('Location: vente.php'); // Redirige vers la page des ventes
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $id = $_POST['id'];
    $id_produit = $_POST['id_produit'];
    $id_client = $_POST['id_client'];
    $quantitee = $_POST['quantitee'];
    $prix = $_POST['prix'];

    // Effectuez la mise à jour dans la base de données
    $sql = "UPDATE vente SET id_produit = :id_produit, id_client = :id_client, quantitee = :quantitee, prix = :prix WHERE id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
    $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
    $stmt->bindParam(':quantitee', $quantitee, PDO::PARAM_INT);
    $stmt->bindParam(':prix', $prix, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['message'] = [
            'type' => 'success',
            'text' => 'Vente modifiée avec succès.'
        ];
    } else {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => 'Erreur lors de la modification de la vente.'
        ];
    }

    header('Location: vente.php'); // Redirige vers la page des ventes après la modification
    exit();
}
?>

