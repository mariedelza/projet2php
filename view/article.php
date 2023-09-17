<?php
include 'entete.php';
if (!empty($_GET['id'])) {
    $produit = getproduits($_GET['id']);
}
?>
<div class="home-container">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifier_produit.php" : "../model/ajoutProduit.php" ?>" method="post">
                <label for="nom_produit"> Nom Produit</label>
                <input value="<?= !empty($_GET['id']) ? $produit['nom_produit'] : "" ?>" type="text" name="nom_produit" id="nom_produit" placeholder="veuillez saisir le nom du produits">
                <input value="<?= !empty($_GET['id']) ? $produit['id'] : "" ?>" type="hidden" name="id" id="id">
                <label for="categorie"> Categorie</label>
                <select name="categorie" id="categorie">
                    <option value="" disabled selected>choisir une Categorie</option>
                    <option <?= !empty($_GET['id']) && $produit['categorie'] == "alimentation" ? "selected" : "" ?> value="alimentation">Alimentation</option>
                    <option <?= !empty($_GET['id']) && $produit['categorie'] == "vetements" ? "selected" : "" ?>value="vetements">Vetements</option>
                    <option <?= !empty($_GET['id']) && $produit['categorie'] == "beaute" ? "selected" : "" ?> value="beaute">Beaute</option>
                    <option <?= !empty($_GET['id']) && $produit['categorie'] == "accessoire" ? "selected" : "" ?> value="accessoire">Accesoires</option>
                    <option <?= !empty($_GET['id']) && $produit['categorie'] == "livre" ? "selected" : "" ?> value="livre">Livres</option>
                    <option <?= !empty($_GET['id']) && $produit['categorie'] == "bureau" ? "selected" : "" ?>value="bureau">Decoration bureau</option>
                </select>
                <label for="quantitee"> Quantitee</label>
                <input value="<?= !empty($_GET['id']) ? $produit['quantitee'] : "" ?>" type="number" name="quantitee" id="quantitee" placeholder="veuillez saisir la quantitee">
                <label for="prix_unitaire"> Prix unitaire</label>
                <input value="<?= !empty($_GET['id']) ? $produit['prix_unitaire'] : "" ?>" type="number" name="prix_unitaire" id="prix_unitaire" placeholder="veuillez saisir le prix">
                <label for="date_fabrication"> Date fabrication</label>
                <input value="<?= !empty($_GET['id']) ? $produit['date_fabrication'] : "" ?>" type="datetime-local" name="date_fabrication" id="date_fabrication">
                <label for="date_expiration"> Date d'expiration</label>
                <input value="<?= !empty($_GET['id']) ? $produit['date_expiration'] : "" ?>" type="datetime-local" name="date_expiration" id="date_expiration">
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
                    <th scope="col">Nom Produit</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Quantitee</th>
                    <th scope="col">prix</th>
                    <th scope="col">Date Fabrication</th>
                    <th scope="col">Date Expiration</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <?php
            $produit = getproduits();
            if (!empty($produit) && is_array($produit)) {
                foreach ($produit as $key => $value) {
            ?>
                    <tbody>
                        <tr>
                            <td><?= $value['nom_produit'] ?></td>
                            <td><?= $value['categorie'] ?></td>
                            <td><?= $value['quantitee'] ?></td>
                            <td><?= $value['prix_unitaire'] ?></td>
                            <td><?= date('d/m/y H:i:s', strtotime($value['date_fabrication'])) ?></td>
                            <td><?= date('d/m/y H:i:s', strtotime($value['date_expiration'])) ?></td>
                            <td><a href="?id=<?= $value['id'] ?>"><button class="btn  btn-warning">Modifier</button></a></td>
                            <td><a href="../model/supprimer_produit.php?id=<?= $value['id'] ?>"> <button class="btn  btn-danger" type="submit">supprimer</button></td>

                        </tr>

                    </tbody>
            <?php

                }
            }
            ?>
        </table>
    </div>

</div>


<?php
include 'footer.php';
?>