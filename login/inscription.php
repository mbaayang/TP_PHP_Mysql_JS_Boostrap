<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styleForm.css">
    <title>Inscription</title>
</head>
<style>
    .en-tête img{
        width: 100%;
        height: 250px;
        opacity: 0.6;
    }
</style>
<body>
    <div class="en-tête">
    <img src="../images/img.jpeg" alt="">
    </div>
    <div class="container my-3 w-50 bg-light" style="box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);">
    <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'photo':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> image trop lourd
                            </div>
                        <?php
                        break;

                        case 'type':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Merci de mettre une image
                                </div>
                            <?php
                            break;

                        case 'erreur':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> type fichier non pris en charge
                                </div>
                            <?php
                            break;

                        case 'success':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> inscription réussie !
                            </div>
                        <?php
                        break;

                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe différent
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email non valide
                            </div>
                        <?php
                        break;

                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte deja existant
                            </div>
                        <?php 

                    }
                }
                ?>
        <form class="row g-3" id="inscription" method="POST" action="../traitement/traitementInscription.php" enctype="multipart/form-data">
            <h2>S'inscrire</h2>
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder=" Nom" autocomplete="on">
                <p id="error1" style="color: red; font-size:10px;"></p>
            </div>
            <div class="col-md-6">
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder=" Prenom" autocomplete="on">
                <p id="error2" style="color: red; font-size:10px;"></p>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="Email" name="email" placeholder="Adresse email" autocomplete="on">
                <p id="error3" style="color: red; font-size:10px;"></p>
            </div>
            <div class="col-md-6">
                <label for="rôle" class="form-label">Rôle</label>
                <select name="rôle" id="role" class="form-select">
                <option selected></option>
                <option value="Administrateur">Administrateur</option>
                <option value="Utilisateur">Utilisateur</option>
                </select>
                <p id="error4" style="color: red; font-size:10px;"></p>
            </div>
            <div class="col-md-6">
                <label for="passwords" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="mdp1" name="passwords" placeholder="Mot de passe" autocomplete="off">
                <p id="error5" style="color: red; font-size:10px;"></p>
            </div>
            <div class="col-md-6">
                <label for="password_retype" class="form-label">Ressaisissez le mot de passe</label>
                <input type="password" name="password_retype" class="form-control" id="mdp2" placeholder="Ressaisissez le mot de passe" autocomplete="off">
                <p class="error6" style="color: red; font-size:10px;"></p>
            </div>
            <div class="col-md-6">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo">
            </div>
            <div class="col-8">
                <button type="submit" class="btn btn-primary mb-3" name="submit">S'inscrire</button>
            </div>    
            <div class="col-4">
                <p><a href="connexion.php"> Se connecter ? </a></p>
            </div>         
        </form>
    </div>

    <script src="../js/scripts.js"></script> 
</body>
</html>