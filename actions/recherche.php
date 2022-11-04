<?php
require_once '../login/connect.php'; // On inclu la connexion à la bdd

    $lister = $bdd->query("SELECT * FROM User ORDER BY id DESC");
    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $recherche = htmlspecialchars($_POST['search']);
        $lister = $bdd->query('SELECT nom FROM User WHERE nom LIKE "%'.$recherche.'%" ORDER BY id DESC');
    }
?>