<?php 
    session_start(); // Démarrage de la session
    require_once '../login/connect.php'; // On inclut la connexion à la base de données

    if(!empty($_POST['email']) && !empty($_POST['passwords'])) // Si il existe les champs email, password et qu'il sont pas vident
    {
        
        $email = htmlspecialchars($_POST['email']); 
        $passwords = htmlspecialchars($_POST['passwords']);
        
        $email = strtolower($email); // email transformé en minuscule
        
        // On regarde si l'utilisateur est inscrit dans la table utilisateurs
        $check = $bdd->prepare('SELECT * FROM User WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();
        
        

        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            // Si le mail est bon niveau format
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                // Si le mot de passe est le bon
                if(password_verify($passwords, $data['passwords']))
                {
                    // On créer la session et on redirige 
                    $_SESSION['user'] = $data['matricule'];
                    $_SESSION['photo'] = $data['photo'];

                    if($data['etat'] == 0){
                        header('Location: ../login/connexion.php?login_err=compte'); die();
                        die();
                    }elseif ($data['rôle'] =='Administrateur') {
                        header('Location: ../pages/pageAdmin.php');
                    }
                    else{
                        header('Location: ../pages/pageUser.php');
                        die();
                    }
                }else{ header('Location: ../login/connexion.php?login_err=password'); die(); }
            }else{ header('Location: ../login/connexion.php?login_err=email'); die(); }
        }else{ header('Location: ../login/connexion.php?login_err=already'); die(); }
    }else{ header('Location: ../login/connexion.php'); die();} // si le formulaire est envoyé sans aucune données
