 <?php
include('../login/connect.php');

if (isset($_GET['deleteid']) AND !empty($_GET['deleteid'])) {
    $id= $_GET['deleteid'];
    $datearchiver=date('y-m-d h:i:s');
    $req=$bdd->prepare("UPDATE User SET etat=0,  date_archivage='$datearchiver' WHERE id='$id'");//code pour archiver en changeant la valeur 1 par 0
    $req->execute();
    if($req){
        header('location: ../pages/pageAdmin.php?reg_err=archive_success');
     }
}
?> 