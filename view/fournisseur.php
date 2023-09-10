<?php
include 'entete.php';
if (!empty($_GET['id'])) {
    $fournisseur = getFournisseur($_GET['id']);
}
?>
<div class="home-container">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifier_fournisseur.php" : "../model/ajoutfournisseur.php" ?>" method="post">
                <label for="nom"> Nom fournisseur</label>
                <input value="<?= !empty($_GET['id']) ? $fournisseur['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="veuillez saisir le nom du fournisseur">
                <input value="<?= !empty($_GET['id']) ? $fournisseur['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="prenom"> Prenom</label>
                <input value="<?= !empty($_GET['id']) ? $fournisseur['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="veuillez saisir le prenom du fournisseur">


                <label for="telephone"> Telephone</label>
                <input value="<?= !empty($_GET['id']) ? $fournisseur['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="veuillez saisir votre numero ">

                <label for="adresse"> Adresse</label>
                <input value="<?= !empty($_GET['id']) ? $fournisseur['adresse'] : "" ?>" type="text" name="adresse" id="adresse" placeholder="veuillez saisir votre adresse">


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
                    <th scope="col">Nom </th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <?php
            $fournisseurs = getFournisseur();

            if (!empty($fournisseurs) && is_array($fournisseurs)) {
                foreach ($fournisseurs as $key => $value) {
            ?>
                    <tbody>
                        <tr>
                            <td><?= $value['nom'] ?></td>
                            <td><?= $value['prenom'] ?></td>
                            <td><?= $value['telephone'] ?></td>
                            <td><?= $value['adresse'] ?></td>
                            <td><a href="?id=<?= $value['id'] ?>"><button class="btn  btn-outline-warning">modifier</button></a></td>
                            <td> <button class="btn  btn-outline-danger">supprimer</button></td>
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