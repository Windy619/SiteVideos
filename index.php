<?php

session_start();
require_once './modele/ModeleAffichage.php';
require_once('./Controleur/Controleur.php');

try {
    if (isset($_GET['action'])) {

        // Check action -> afficher une video
        if ($_GET['action'] == 'video') {
            // Check l'id dans l'url
            if (isset($_GET['id'])) {
                video($_GET['id']);
            } else {
                throw new Exception("Cette video n'existe pas.");
            }
        }
        
        

        // Check action  -> afficher la page d'inscription
        if ($_GET['action'] == 'inscription') {
            if (!isset($_SESSION["pseudo"])) {
                inscription();
            } else {
                erreur('Vous êtes déja connecté !');
            }
        }
        // Check action  -> l'utilisateur est inscrit
        if ($_GET['action'] == 'inscrit') {
            inscrit();
        }

        // Check action  -> afficher affiche la page d'ajout de video
        if ($_GET['action'] == 'uploader') {
            if (isset($_SESSION["pseudo"])) {
                Affiche_AjouterVideo();
            } else {
                erreur('Vous devez être connecté pour afficher cette page');
            }
        }
        // Check action  -> upload la video
        if ($_GET['action'] == 'upload') {
            upload();
        }

        // Check action  -> deconnecte l'utilisateur
        if ($_GET['action'] == 'deconnexion') {
            deconnexion();
        }

        // Check action  -> connecte l'utilisateur
        if ($_GET['action'] == 'login') {
            connexion();
        }
    } else {
        accueil();  // action par défaut
    }
} catch (Exception $e) {
    erreur($e->getMessage());
}
?>