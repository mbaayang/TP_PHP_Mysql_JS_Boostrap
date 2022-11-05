<?php
session_start();
require_once('../login/connect.php');

// si la session existe pas soit si l'on est pas connecté on redirige
if (!isset($_SESSION['user'])) {
    header('Location:../login/connexion.php');
    die();
}

// On récupere les données de l'utilisateur
$req = $bdd->prepare('SELECT * FROM User WHERE matricule = ?');
$req->execute(array($_SESSION['user']));
$data = $req->fetch();

if (isset($_POST) & !empty($_POST)) {
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$email = htmlspecialchars($_POST['email']);

	$id=$_GET['id'];  //stoque le id recupèré dans l'url
	$datemodifier=date('y-m-d h:i:s');

	$UpdateSql = $bdd->prepare( "UPDATE `User` SET nom='$nom',	prenom='$prenom', email='$email', date_modification='$datemodifier' WHERE id='$id'");

	$UpdateSql->execute();

	if($UpdateSql){
        header('Location:../pages/pageAdmin.php?reg_err=success');
         die();
    }else { die('Erreur : '.$e->getMessage());}
	
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
	<script src="https://kit.fontawesome.com/431fa92df2.js" crossorigin="anonymous"></script>
    <title>Modifier</title>
</head>

<body>

	<header class="header">
        <div class="menu_admin">
            <div class="infos">
                <div>
                    <div class="profil">
                        <img src="" alt="">
                    </div>
                    <p><?php echo $data['matricule']; ?></p>
                </div>
                <div class="nom">
                    <h2><?php echo $data['prenom']; ?> <?php echo $data['nom']; ?></h2>
                    <p><?php echo $data['rôle']; ?></p>
                </div>
            </div>
            <div class="end">
                <a class="btn btn-primary my-2" href="../pages/pageAdmin.php" role="button">User</a>
                <a class="btn btn-primary my-2" href="../pages/listeArchive.php" role="button">Archivé(é)s</a>
                <a class="btn btn-outline-danger my-2" href="../actions/deconnexion.php" role="button">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
        </div>
    </header>

	<div class="container my-3 w-50 bg-light" style="box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);">
		<?php

		if(isset($_GET["id"])){
			$id = $_GET["id"];
			if(!empty($id) && is_numeric($id)){
				$lister = "SELECT * FROM User where id=$id";
				$result = $bdd->query($lister);
				$row = $result->fetch();
					$id = $row["id"]; 
					$prenom = $row["prenom"];
					$nom = $row["nom"];
					$email = $row["email"];


			echo"<form class='row g-3 my-5' id='inscription' method='POST' action=''>
			<h2>Modifier</h2>
			<div class='col-md-6'>
				<label for='nom' class='form-label'>Nom</label>
				<input type='text' class='form-control' id='nom' name='nom' value='$nom'>
				<p id='error1' style='color: red; font-size:10px;'></p>
			</div>
			<div class='col-md-6'>
				<label for='prenom' class='form-label'>Prenom</label>
				<input type='text' class='form-control' id='prenom' name='prenom' value='$prenom'>
				<p id='error2' style='color: red; font-size:10px;'></p>
			</div>
			<div class='col-md-6'>
				<label for='email' class='form-label'>Adresse email</label>
				<input type='email' class='form-control' id='Email' name='email' value='$email'>
				<p id='error3' style='color: red; font-size:10px;'></p>
			</div>
			<div class='col-8'>
				<button type='submit' class='btn btn-primary mb-3' name='submit' value='Modifier'>Modifier</button>
			</div>
		</form>";		
			}
		}
		?>
		
	</div>

	<script src="../js/scripts.js"></script>
</body>
</html>