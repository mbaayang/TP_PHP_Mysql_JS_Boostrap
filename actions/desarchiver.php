<?php
include('../login/connect.php');

if (isset($_GET['deleteid']) AND !empty($_GET['deleteid'])) {
    $id= (int) $_GET['deleteid'];
    $datearchiver=date('y-m-d h:i:s');
    $req=$bdd->prepare("UPDATE User SET etat=1,  date_archivage='$datearchiver' WHERE id='$id'");//code pour archiver en changeant la valeur 0 par 1
    $req->execute();
    if($req){
        header('location:../pages/listeArchive.php?reg_err=desarchive_success');
     }
}
?> 

