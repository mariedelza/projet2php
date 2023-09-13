<?php
include 'entete.php';
?>
<main class="main-container">
    <div class="main-title">
        <h2>TABLEAU DE BORD</h2>
    </div>

    <div class="main-cards">

        <div class="card">
            <div class="card-inner">
                <h3>Produits</h3>
                <span class="material-icons-outlined">inventory_2</span>
            </div>
            <h1><?php echo getAllProduct()['nbre']; ?></h1>
        </div>

        <div class="card">
            <div class="card-inner">
                <h3>Vente</h3>
                <span class="material-icons-outlined">category</span>
            </div>
            <h1><?php echo getAllVente()['nbre']; ?></h1>
        </div>

        <div class="card">
            <div class="card-inner">
                <h3>Clients</h3>
                <span class="material-icons-outlined">groups</span>
            </div>
            <h1><?php echo getAllClient()['nbre']; ?></h1>
        </div>

        <div class="card">
            <div class="card-inner">
                <h3>Fournisseur</h3>
                <span class="material-icons-outlined">poll</span>
            </div>
            <h1><?php echo getAllFouriseur()['nbre']; ?></h1>
        </div>

    </div>



    <div class="charts-card">
        <h2 class="chart-title">Les ventes les plus récentes</h2>
        <?php
        $product = getLastVente();
        ?>
        <div class="sales-details">
            <ul class="details">
                <li class="topic">Date</li>
                <?php
                foreach ($product as $value) {
                ?>
                    <li><a href="#"><?php echo date('d M Y', strtotime($value['date_vente'])) ?></a></li>
                <?php
                }
                ?>
            </ul>
            <ul class="details">
                <li class="topic">Clients</li>
                <?php
                foreach ($product as $value) {
                ?>
                    <li><a href="#"><?php echo $value['nom'] . " " . $value['prenom'] ?></a></li>
                <?php
                }
                ?>
            </ul>
            <ul class="details">
                <li class="topic">Produits</li>
                <?php
                foreach ($product as $value) {
                ?>
                    <li><a href="#"><?php echo $value['nom_produit'] ?></a></li>
                <?php
                }
                ?>
            </ul>
            <ul class="details">
                <li class="topic">Prix</li>
                <?php
                foreach ($product as $value) {
                ?>
                    <li><a href="#"><?php echo number_format($value['prix'], 0, ",", "") . "F" ?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="charts-card">
        <h2 class="chart-title">Les produits les plus vendus</h2>
        <?php
        $products = getMostVente();
        ?>
        <div class="sales-details">
            <ul class="details">
                <li class="topic">Produits</li>
                <?php
                foreach ($products as $product) {
                ?>
                    <li><a href="#"><?php echo $product['nom_produit']; ?></a></li>
                <?php
                }
                ?>
            </ul>
            <ul class="details">
                <li class="topic">Prix total</li>
                <?php
                foreach ($products as $product) {
                ?>
                    <li><a href="#"><?php echo number_format($product['total_prix'], 0, ",", "") . "F" ?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
    </div>





</main>


</div>


<?php
include 'footer.php';
?>