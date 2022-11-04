<?php   
    // Démarrage de la session 
    session_start();
    // Include de la base de données
    require_once ('../login/connect.php');

    // Si la session n'existe pas 
    if(!isset($_SESSION['user']))
    {
        header('Location:../login/connexion.php');
        die();
    }


    // Si les variables existent 
    if(!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['new_password_retype'])){
        $current_password = htmlspecialchars($_POST['current_password']);
        $new_password = htmlspecialchars($_POST['new_password']);
        $new_password_retype = htmlspecialchars($_POST['new_password_retype']);

        // On récupère les infos de l'utilisateur
        $check_password  = $bdd->prepare("SELECT * FROM User WHERE matricule = ?");
        $check_password->execute(array($_SESSION['user']));
        $data_password = $check_password->fetch();

        // Si le mot de passe est le bon
        if(password_verify($current_password, $data_password['passwords']))
        {
            // Si le mot de passe tapé est bon
            if($new_password === $new_password_retype){

                // On chiffre le mot de passe
                $cost = ['cost' => 12];
                $new_password = password_hash($new_password, PASSWORD_BCRYPT, $cost);
                // On met à jour la table utiisateurs
               /*  $update = $bdd->prepare("UPDATE User SET passwords = $new_password WHERE id = $id");
                $update->execute(); */

                $update = $bdd->prepare('UPDATE User SET passwords = :passwords WHERE matricule = :matricule');
                $update->execute(array(
                    "passwords" => $new_password,
                    "matricule" => $_SESSION['user']
                ));
                // On redirige
                header('Location:../actions/change_password.php?reg_err=success_password');
                die();
            }else{
                header('Location:../actions/change_password.php?reg_err=new_password');
            die();
            }
        }else{
            header('Location:../actions/change_password.php?reg_err=current_password');
            die();
        }
    }else{
        header('Location:../actions/change_password.php');
        die();
    }
?>