<?php
include 'entete.php';
include '../model/connexion.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_vente = $_GET['id'];

    // Sélectionnez toutes les ventes du client associé à cette vente
    $sql = "SELECT vente.id, vente.date_vente, vente.id_client, produits.nom_produit, vente.quantitee, vente.prix
            FROM vente
            INNER JOIN produits ON vente.id_produit = produits.id
            WHERE vente.id_client = (
                SELECT id_client
                FROM vente
                WHERE vente.id = :id
            )";

    $req = $connexion->prepare($sql);
    $req->bindParam(':id', $id_vente, PDO::PARAM_INT);
    $req->execute();
    $ventes = $req->fetchAll(PDO::FETCH_ASSOC);

    // Vérifiez si des ventes existent pour ce client
    if (!$ventes) {
        header('Location: page_d_erreur.php');
        exit();
    }

    // Maintenant, récupérez les informations du client associé à cette vente (elles seront les mêmes pour toutes les ventes du client)
    $client_id = $ventes[0]['id_client'];
    $sql_client = "SELECT client.prenom, client.nom, client.telephone, client.adresse
                   FROM client
                   WHERE client.id = :client_id";

    $req_client = $connexion->prepare($sql_client);
    $req_client->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $req_client->execute();
    $client = $req_client->fetch(PDO::FETCH_ASSOC);
} else {
    header('Location: page_d_erreur.php');
    exit();
}
?>

<div class="home-container">
    <div class="page">
        <div class="cote-a-cote">
            <h2>MA BOUTIQUE SHOP</h2>
            <div>
                <p>Reçu No #<?= $ventes[0]['id'] ?></p>
                <p>Date: <?= date('d/m/y H:i:s', strtotime($ventes[0]['date_vente'])) ?></p>
            </div>
        </div>
        <div class="cote-a-cote" style="width: 50%;">
            <p> Reçu de :</p>
            <p><?= $client['prenom'] . " " . $client['nom'] ?></p>
        </div>
        <div class="cote-a-cote" style="width: 50%;">
            <p>Téléphone :</p>
            <p><?= $client['telephone'] ?></p>
        </div>
        <div class="cote-a-cote" style="width: 50%;">
            <p>Adresse :</p>
            <p><?= $client['adresse'] ?></p>
        </div>
        <table class="table" style="width: 100vh;">
            <thead>
                <tr>
                    <th scope="col">Designation</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix Unitaire</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventes as $vente) { ?>
                    <tr>
                        <td><?= $vente['nom_produit'] ?></td>
                        <td><?= $vente['quantitee'] ?></td>
                        <td><?= $vente['prix'] / $vente['quantitee'] ?></td>
                        <td><?= $vente['prix'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>