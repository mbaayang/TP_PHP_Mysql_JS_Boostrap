<?php
session_start();
require_once '../login/connect.php'; // On inclu la connexion à la bdd


// si la session existe pas soit si l'on est pas connecté on redirige
if (!isset($_SESSION['user'])) {
    header('Location:../login/connexion.php');
    die();
}

// On récupere les données de l'utilisateur
$req = $bdd->prepare('SELECT * FROM User WHERE matricule = ?');
$req->execute(array($_SESSION['user']));
$data = $req->fetch();
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/stylePages.css">
    <link rel="stylesheet" href="../css/styleForm.css">
    <script src="https://kit.fontawesome.com/431fa92df2.js" crossorigin="anonymous"></script>
    <title>Page admin</title>
</head>

<body>
<header class="header">
    <?php
    include('../header/header.php');
    ?>
</header>
    <main>
        <div class="login-form my-5">
        <?php
        if (isset($_GET['reg_err'])) {
            $err = htmlspecialchars($_GET['reg_err']);

            switch ($err) {
                case 'current_password':
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Le mot de passe actuel est incorrect
                    </div> 
                    <?php
                break;
                case 'new_password':
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Veillez saisir des mots de passe identiques
                    </div>
                    <?php
                break;
                case 'success_password':
                    ?>
                    <div class="alert alert-success" role="alert">
                        Le mot de passe a bien été modifié ! 
                    </div>
                    <?php
                break; 
            }
        }
        ?>
        <form action="../traitement/traitementPassword.php" method="POST">
            <h4 class="text-center">Changer mon mot de passe</h4>
            <div class="form-group inputs my-3">
                <label for="current_password">Mot de passe actuel</label>
                <input type="password" name="current_password" class="form-control" autocomplete="off">
            </div>
            <div class="form-group inputs">
                <label for="new_password">Nouveau mot de passe</label>
                <input type="password" name="new_password" class="form-control" autocomplete="off">
            </div>
            <div class="form-group inputs">
                <label for="new_password_retype">Re-tapez le nouveau mot de passe</label>
                <input type="password" name="new_password_retype" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="submit">Sauvegarder</button>
            </div>
        </form>
        </div>
    </main>

 <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>