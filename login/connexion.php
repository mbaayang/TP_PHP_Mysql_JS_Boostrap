<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="NoS1gnal" />
    <link rel="stylesheet" href="../css/styleForm.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Connexion</title>
</head>

<body>
    <div class="en-tête">
        <img src="../images/img.jpeg" alt="">
    </div>
    <div class="login-form">
        <?php
        if (isset($_GET['login_err'])) {
            $err = htmlspecialchars($_GET['login_err']);

            switch ($err) {
                case 'password':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> mot de passe incorrect
                    </div>
                <?php
                    break;

                case 'email':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> email incorrect
                    </div>
                <?php
                    break;

                case 'compte':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> Votre compte n'existe plus
                        </div>
                    <?php
                        break;

                case 'already':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> compte non existant
                    </div>
                <?php
                    break;
            }
        }
        ?>

        <form id="connexion" action="../traitement/traitementConnexion.php" method="post">
            <h2 class="text-center">Connexion</h2>
            <div class="form-group inputs">
                <label for="email">Adresse mail</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" autocomplete="on">
                <p id="error1" style="color: red; font-size:10px;"></p>
            </div>
            <div class="form-group inputs">
                <label for="passwords">Mot de passe</label>
                <input type="password" name="passwords" class="form-control" id="mdp" placeholder="Mot de passe" autocomplete="on">
                <p id="error2" style="color: red; font-size:10px;"></p>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="submit">Connexion</button>
            </div>
            <p class="text-center"><a href="inscription.php">Inscription ?</a></p>
        </form>

    </div>
</body>
<script>
    document.getElementById("connexion").addEventListener("submit", function(e){
    var error1, error2;
    var email = document.getElementById("email");
    var password = document.getElementById("mdp");

    if (!email.value.trim()) {
        error1 = "Veillez renseigner l'adresse mail";
    }
    if (error1) {
        e.preventDefault();
        document.getElementById("error1").innerHTML = error1;
        return false;
    }else{
        document.getElementById("error1").innerHTML = "";
    }


    if (!password.value) {
        error2 = "Veillez renseigner le mot de passe";
    }
    if (error2) {
        e.preventDefault();
        document.getElementById("error2").innerHTML = error2;
        return false;
    }else{
        document.getElementById("error2").innerHTML = "";
    }
 })
</script> 

</html>