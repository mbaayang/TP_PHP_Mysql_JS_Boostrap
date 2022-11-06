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
        include('../header/headerA.php')
        ?>
    </header>
    <main>
        <form action="" class="d-flex ml-auto col-4 my-4" role="search" method="GET">
            <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Search" name="cherche" value="<?php if(isset($_GET['cherche'])){echo $_GET['cherche'];}?>">
            <button class="btn btn-outline-dark" type="submit" name="recherche">Rechercher</button>
        </form>
        <table class="table table-hover my-3">
            <thead>
                <tr class="bg-dark line">
                    <th scope="col">Prenom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Matricule</th>
                    <th scope="col">Date d'archivage</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //On determine sur quelle page on se trouve
                if (isset($_GET['page']) && !empty($_GET['page'])) {
                    $currentPage = (int) strip_tags($_GET['page']);
                } else {
                    $currentPage = 1;
                }
                // On determine le nombre total d'utilisateurs
                $lister = $bdd->prepare('SELECT COUNT(*) AS nb_user FROM User WHERE etat=0');
                $lister->execute();
                // On recupére le nombre d'utilisateurs
                $result = $lister->fetch();
                $nbUser = (int) $result['nb_user'];
                //On determine le nombre d'user par page
                $parPage = 8;
                //On calcule le nombre de pages total
                $pages = ceil($nbUser / $parPage);
                //Calcul du premier user de la page
                $premier = ($currentPage * $parPage) - $parPage;

                $id=$data['id'];

                $lister = $bdd->prepare("SELECT * FROM User WHERE etat=0 AND id!=$id ORDER BY id DESC LIMIT $premier, $parPage;");
                $lister->execute();

                if (isset($_GET['cherche'])) {
                    $values = $_GET['cherche'];
                    $lister = $bdd->prepare("SELECT * FROM User WHERE CONCAT(prenom,nom,email) LIKE '%$values%'");
                    $lister->execute();

                    if ($lister->rowCount() > 0) {

                        if (isset($_SESSION['user'])) {
                            $matSession = $_SESSION['user'];
                        } 
                        while ($row = $lister->fetch(PDO::FETCH_ASSOC)) {
                            $prenom = $row['prenom'];
                            $nom = $row['nom'];
                            $email = $row['email'];
                            $mat = $row['matricule'];
                            $date_inscription = $row['date_inscription'];
                            $etat = $row['etat'];
                            $id = $row['id'];
    
    
                            if ($etat == 0 && $mat != $matSession) {
                                echo '<tr>
                                <td>' . $prenom . '</td>
                                <td>' . $nom . '</td>
                                <td>' . $email . '</td>
                                <td>' . $mat . '</td>
                                <td>' . $date_inscription . '</td>
                                </tr>';
                            }
                        }
                    
                    }
                }else{

                    if (isset($_SESSION['user'])) {
                        $matSession = $_SESSION['user'];
                    }
                    while ($row = $lister->fetch(PDO::FETCH_ASSOC)) {
                        $prenom = $row['prenom'];
                        $nom = $row['nom'];
                        $email = $row['email'];
                        $mat = $row['matricule'];
                        $dateArchivage = $row['date_archivage'];
                        $etat = $row['etat'];
                        $id = $row['id'];

                        if ($mat != $matSession) {
                            echo '<tr>
                            <td>' . $prenom . '</td>
                            <td>' . $nom . '</td>
                            <td>' . $email . '</td>
                            <td>' . $mat . '</td>
                            <td>' . $dateArchivage . '</td>
                            </tr>';
                        }
                    }
                }
                ?>
            </tbody>
        </table>
        <!-- -------------Pagination----------------- -->
        <nav aria-label="Page navigation example">
            <ul class="pagination fixed-bottom justify-content-center">
                <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>"><a class="page-link" href="?page=<?= $currentPage - 1 ?>">Precedent</a></li>
                <?php
                for ($page = 1; $page <= $pages; $page++) : ?>
                    <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                        <a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a>
                    </li>
                <?php endfor ?>
                <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>"><a class="page-link" href="?page=<?= $currentPage + 1 ?>">Suivant</a></li>
            </ul>
        </nav>
    </main>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>