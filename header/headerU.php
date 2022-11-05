<header class="header">
    <div class="menu_admin">
        <div class="infos">
            <div>
                <div class="profil d-flex justify-center">
                    <img style="object-fit: cover; width: 100px;height: 100px;" class="img-fluid rounded-circle" src="data:image/jpg;base64,<?= base64_encode($_SESSION['photo']) ?>" alt="">
                </div>
                <p><?php echo $data['matricule']; ?></p>
            </div>
            <div class="nom">
                <h3><?php echo $data['prenom']; ?> <?php echo $data['nom']; ?></h3>
                <p><?php echo $data['rôle']; ?></p>
            </div>
        </div>
        <div class="end">
            <?php
            if ($data['rôle'] == 'Administrateur') {
                echo '<div class=" my-2">
                    <a class="btn btn-primary disabled" href="../pages/pageAdmin.php" role="button">User</a>
                    </div>
                    <div class="my-2">
                    <a class="btn btn-primary" href="../pages/listeArchive.php" role="button">Archivé(é)s</a>
                    </div>';
            } else if ($data['rôle'] == 'Utilisateur') {
                echo '<div class=" my-2">
                    <a class="btn btn-primary disabled" href="../pages/pageUser.php" role="button">User</a>
                    </div>
                    <div class="my-2">
                    <a class="btn btn-primary" href="../pages/listeArchiveU.php" role="button">Archivé(é)s</a>
                </div>';
            }
            ?>
            <div class="dropdown my-2">
                <a class="btn btn-outline-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-gear"></i>
                </a>

                <ul class="dropdown-menu">
                    <li class="dropdown-item"><a class="btn btn-link" style="text-decoration: none;" href="../actions/change_password.php">
                            <i class="fa-solid fa-wrench"></i> Changer mon mot de passe</a>
                    </li>
                    <li class="dropdown-item">
                        <button type="button" class="btn btn-link dropdown-item" style="color: red;" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                            <i class="fa-solid fa-right-from-bracket"></i> Deconnexion
                        </button>
                    </li>
                </ul>
            </div>

            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="exampleModalLabel">Deconnexion</h3>
                        </div>
                        <div class="modal-body">
                            <p>Souhaitez-vous vraiment vous deconnecter ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><a href="pageAdmin.php" style="color: white;">Non</a></button>
                            <button type="button" class="btn btn-danger"><a href="../actions/deconnexion.php" style="color: white;">Oui</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>