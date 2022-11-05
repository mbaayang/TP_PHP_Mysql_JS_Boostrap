<?php 
    include '../login/connect.php'; // On inclu la connexion à la bdd
 


    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['rôle']) && !empty($_POST['passwords']) && !empty($_POST['password_retype']))
{
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $roles = htmlspecialchars($_POST['rôle']);
        $passwords = htmlspecialchars($_POST['passwords']);
        $password_retype = htmlspecialchars($_POST['password_retype']);

        if (!empty($_FILES['photo'])) {
            $photo = file_get_contents($_FILES['photo']['tmp_name']) ?? null;
            $typeFile = $_FILES['photo']['type'];
            $type = ['image/png', 'image/jpg', 'image/jpeg', ''];
            $nameFile = $_FILES['photo']['name'];
            $extensions = ['PNG', 'JPG', 'JPEG'];
            $extension = explode('.', $nameFile);

            $max_size = 1000000;
            if ($_FILES['photo']['size'] > $max_size) {
                header('Location: ../login/inscription.php?reg_err=photo');
                die();
            }
            if (!in_array($typeFile, $type)) {
                header('Location: ../login/inscription.php?reg_err=type');
                die();
            }
            if (count($extension) >= 2 && in_array(strtolower(end($extension)), $extensions)) {
                header('Location: ../login/inscription.php?reg_err=erreur');
                die();
            }
        }
        

        $mat;     
        $res = $bdd->query("SELECT matricule from User");
        if($res->rowCount()>0){
            $matricules = $res->fetchAll();
            $matricule = $matricules[count($matricules) - 1]['matricule'];
            $incr = (int) explode("/", $matricule)[1];
            $increment=$incr+1;
            $mat = "MG_2022/$increment";
        }

        // On vérifie si l'utilisateur existe
        $check = $bdd->prepare('SELECT * FROM User WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..


    // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
    if ($row == 0) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Si l'email est de la bonne forme
            if ($passwords === $password_retype) { // si les deux mdp saisis sont bon

                // On hash le mot de passe avec Bcrypt, via un coût de 12
                $cost = ['cost' => 12];
                $passwords = password_hash($passwords, PASSWORD_BCRYPT, $cost);

                // On insère dans la base de données

                $insert=$bdd->prepare("INSERT INTO User (nom,prenom,email,rôle,photo,passwords,matricule) 
                VALUES (?,?,?,?,?,?,?)");
                
                $insert->bindParam(1, $nom);
                $insert->bindParam(2, $prenom);
                $insert->bindParam(3, $email);
                $insert->bindParam(4, $roles);
                $insert->bindParam(5, $photo);
                $insert->bindParam(6, $passwords);
                $insert->bindParam(7, $mat);
                $insert->execute();

               /*  $insert=$bdd->prepare("INSERT INTO User(nom,prenom,email,rôle,photo,passwords,matricule) 
                VALUES ('$nom','$prenom','$email','$roles','$photo','$passwords','$mat')");
                $insert->execute();  */

                /* $insert = $bdd->prepare('INSERT INTO User(nom, prenom, email, rôle, photo, passwords, matricule) 
                    VALUES(:nom, :prenom, :email, :rôle, :photo, :passwords, :matricule)');
                            $insert->execute(array(
                                'nom' => $nom,
                                'prenom' => $prenom,
                                'email' => $email,
                                'rôle' => $roles,
                                'photo' => $photo,
                                'passwords' => $password,
                                'matricule' => $mat
                            )); */
                                
                
                // On redirige avec le message de succès
                header('Location:../login/inscription.php?reg_err=success');
                die();
            } else {
                header('Location: ../login/inscription.php?reg_err=password');
                die();
            }
        } else {
            header('Location: ../login/inscription.php?reg_err=email');
            die();
        }
    } else {
        header('Location: ../login/inscription.php?reg_err=already');
        die();
    }
}
?> 