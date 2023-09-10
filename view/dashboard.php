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
            <h1>249</h1>
        </div>

        <div class="card">
            <div class="card-inner">
                <h3>Ventes</h3>
                <span class="material-icons-outlined">category</span>
            </div>
            <h1>25</h1>
        </div>

        <div class="card">
            <div class="card-inner">
                <h3>Commandes</h3>
                <span class="material-icons-outlined">fact_check</span>
            </div>
            <h1>1500</h1>
        </div>

        <div class="card">
            <div class="card-inner">
                <h3>Fournisseur</h3>
                <span class="material-icons-outlined">poll</span>
            </div>
            <h1>56</h1>
        </div>

    </div>

    <div class="charts">

        <div class="charts-card">
            <h2 class="chart-title">Top 5 Products</h2>
            <div id="bar-chart"></div>
        </div>

        <div class="charts-card">
            <h2 class="chart-title">Purchase and Sales Orders</h2>
            <div id="area-chart"></div>
        </div>

    </div>
</main>
<!-- End Main -->

</div>


<?php
include 'footer.php';
?>