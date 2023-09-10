<?php
include 'entete.php';
if (!empty($_GET['id'])) {
    $client = getclient($_GET['id']);
}
?>
<div class="home-container">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifier_client.php" : "../model/ajoutclient.php" ?>" method="post">
                <label for="nom"> Nom client</label>
                <input value="<?= !empty($_GET['id']) ? $client['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="veuillez saisir le nom du client">
                <input value="<?= !empty($_GET['id']) ? $client['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="prenom"> Prenom</label>
                <input value="<?= !empty($_GET['id']) ? $client['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="veuillez saisir le prenom du client">


                <label for="telephone"> Telephone</label>
                <input value="<?= !empty($_GET['id']) ? $client['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="veuillez saisir votre numero ">

                <label for="adresse"> Adresse</label>
                <input value="<?= !empty($_GET['id']) ? $client['adresse'] : "" ?>" type="text" name="adresse" id="adresse" placeholder="veuillez saisir votre adresse">


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
            $clients = getclient();

            if (!empty($clients) && is_array($clients)) {
                foreach ($clients as $key => $value) {
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