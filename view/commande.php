<?php
include 'entete.php';
include '../model/connexion.php';
$sql = " SELECT * FROM commande INNER JOIN produits on commande.id_produit=produits.id 
        INNER JOIN fournisseur on commande.id_fournisseur=fournisseur.id
";
$req = $connexion->query($sql);
$commandes = $req->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="home-container">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifier_commande.php" : "../model/ajoutcommande.php" ?>" method="post">

                <input value="<?= !empty($_GET['id']) ? $produit['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="id_produit"> Produits </label>
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

                <label for="id_fournisseur"> fournisseurs</label>
                <select name="id_fournisseur" id="id_fournisseur">
                    <option value="" disabled selected>choisir un fournisseur</option>
                    <?php

                    $fournisseurs = getfournisseur();

                    if (!empty($fournisseurs) && is_array($fournisseurs)) {
                        foreach ($fournisseurs as $key => $value) {
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
                    <th scope="col">fournisseurs</th>
                    <th scope="col">Quantitee</th>
                    <th scope="col">prix</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($commandes as $commande) : ?>
                    <tr>
                        <td><?= $commande['nom_produit'] ?></td>
                        <td><?= $commande['prenom'] ?></td>
                        <td><?= $commande['quantitee'] ?></td>
                        <td><?= $commande['prix'] ?></td>
                        <td><?= $commande['date_commande'] ?></td>
                        <td>
                            <a href="recucommande.php?id=<?= $value['id']?>"><i class="fa-solid fa-file-invoice">imprimer</i></a>

                        </td>

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