<?php
require_once('../login/connect.php');

if (isset($_GET['switchid'])) {
    $id = $_GET['switchid'];

    $req = $bdd->prepare("SELECT * FROM User WHERE id = $id");
    $req->execute();

    if ($req->rowCount()>0) {
        $data = $req->fetchAll()[0];
        if ($data['rôle'] === 'Administrateur') {
            $req = $bdd-> prepare("UPDATE User SET etat_role = 1, rôle = 'Utilisateur' WHERE id = $id");
            $req->execute();
        }else{
            $req = $bdd-> prepare("UPDATE User SET etat_role = 0, rôle = 'Administrateur' WHERE id = $id");
            $req->execute();
        }
    }
    if ($req) {
        header("Location:../pages/pageAdmin.php"); 
    }
}
?>