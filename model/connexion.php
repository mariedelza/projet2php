<?php
session_start();
/* connexion a la base de donnee */
$nom_serveur="localhost"; 
$nom_base_de_donnee="gestion_stock";
$utilisateur="root";
$mdp="";

/* exception en cas ou la connexion ne passe pas */
try {
    $connexion=new PDO("mysql:host=$nom_serveur;dbname=$nom_base_de_donnee", $utilisateur,$mdp);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connexion;
} catch (Exception $e) {

    die("Erreur de connexion veuillez reessayer :" .$e->getMessage());
    
}