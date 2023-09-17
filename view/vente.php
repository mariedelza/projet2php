<?php
include 'entete.php';
include '../model/connexion.php';
$sql = " SELECT * FROM vente INNER JOIN produits on vente.id_produit=produits.id 
        INNER JOIN client on vente.id_client=client.id
";
$req = $connexion->query($sql);
$ventes = $req->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="home-container">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifier_vente.php" : "../model/ajoutvente.php" ?>" method="post">

                <input value="<?= !empty($_GET['id']) ? $produit['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="id_produit"> Articles</label>
                <select onchange="setPrix()" name="id_produit" id="id_produit">
                    <option value="" disabled selected>choisir un article</option>

                    <?php

                    $produit = getproduits();

                    if (!empty($produit) && is_array($produit)) {
                        foreach ($produit as $key => $value) {
                    ?>
                            <option data-prix="<?= $value['prix_unitaire'] ?>" value="<?= $value['id'] ?>"><?= $value['nom_produit'] . "-" . $value['quantitee'] . " disponible" ?></option>
                    <?php


                        }
                    }

                    ?>
                </select>

                <label for="id_client"> Clients</label>
                <select name="id_client" id="id_client">
                    <option value="" disabled selected>choisir un client</option>
                    <?php

                    $clients = getclient();

                    if (!empty($clients) && is_array($clients)) {
                        foreach ($clients as $key => $value) {
                    ?>
                            <option value="<?= $value['id'] ?>"><?= $value['nom'] . " " . $value['prenom']  ?></option>
                    <?php


                        }
                    }

                    ?>
                </select>





                <label for="quantitee"> Quantitee</label>
                <input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ? $produit['quantitee'] : "" ?>" type="number" name="quantitee" id="quantitee" placeholder="veuillez saisir la quantitee">


                <label for="prix"> Prix </label>
                <input value="<?= !empty($_GET['id']) ? $produit['prix'] : "" ?>" type="number" name="prix" id="prix" placeholder="veuillez saisir le prix">


                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                <?php
                }
                ?>

            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">produits</th>
                    <th scope="col">Clients</th>
                    <th scope="col">Quantitee</th>
                    <th scope="col">prix</th>
                    <th scope="col">Date</th>
                  
                </tr>
            </thead>

            <tbody>
                <?php foreach ($ventes as $vente) : ?>
                    <tr>
                        <td><?= $vente['nom_produit'] ?></td>
                        <td><?= $vente['prenom'] ?></td>
                        <td><?= $vente['quantitee'] ?></td>
                        <td><?= $vente['prix'] ?></td>
                        <td><?= $vente['date_vente'] ?></td>


                    </tr>
                <?php endforeach; ?>

            </tbody>

        </table>
    </div>

</div>


<?php
include 'footer.php';
?>
<script>
    function setPrix() {
        var produit = document.querySelector('#id_produit');
        var quantitee = document.querySelector('#quantitee');
        var prix = document.querySelector('#prix');

        var prixUnitaire = produit.options[produit.selectedIndex].getAttribute('data-prix');

        prix.value = Number(quantitee.value) * Number(prixUnitaire);
    }
</script>