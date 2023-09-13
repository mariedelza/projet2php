<?php
session_start();
include_once "../model/function.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>gestion stock magasin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">


    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <div class="grid-container">

        <!-- Header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
                <span class="material-icons-outlined">search</span>
            </div>
            <div class="header-right">
               <h4>Nous sommes le marche digital qui vous simplifie la vie !</h4>
            </div>
        </header>
        <!-- End Header -->

        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-icons-outlined">shopping_cart</span> STORE
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <a href="dashboard.php" target="_blank">
                        <span class="material-icons-outlined">dashboard</span> Tableau de Bord
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="article.php" target="_blank">
                        <span class="material-icons-outlined">inventory_2</span> Produits
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="vente.php" target="_blank">
                        <span class="material-icons-outlined">category</span> Vente
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="client.php" target="_blank">
                        <span class="material-icons-outlined">groups</span> Clients
                    </a>
                </li>
               
                <li class="sidebar-list-item">
                    <a href="fournisseur.php" target="_blank">
                        <span class="material-icons-outlined">poll</span> Fournisseur
                    </a>
                </li>
                
            </ul>
        </aside>