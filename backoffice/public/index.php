<!DOCTYPE html>
<html class="h-100" lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Figurine manga.">
    <title>ShippudenShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../public/ressource/css/style.css">

</head>

<body>
    <?php
    session_start();

    if (isset($_SESSION['idUser'])) {
        if ($_SESSION['idRoleUser'] == 4 || $_SESSION['idRoleUser'] == 5) {
            include "../front//header.php";
    ?>
            <!-- Début de la Side Bar -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 supvhmobile-side">
                            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                                <li class="nav-item mb-4 mt-5">
                                    <a href="../public/index.php?page=1" class="nav-link align-middle px-0">
                                        <i class="bi bi-house fs-3 text-light"></i><span class="ms-1 d-none d-sm-inline text-light">Accueil</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-4">
                                    <a href="../public/index.php?page=2" class="nav-link align-middle px-0">
                                        <i class="bi bi-file-earmark-plus fs-3 text-light"></i><span class="ms-1 d-none d-sm-inline text-light">Produits</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-4">
                                    <a href="../public/index.php?page=3" class="nav-link align-middle px-0">
                                        <i class="bi-person fs-3 text-light"></i><span class="ms-1 d-none d-sm-inline text-light">Utilisateurs</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-4">
                                    <a href="../public/index.php?page=4" class="nav-link align-middle px-0">
                                        <i class="bi bi-file-earmark-text fs-3 text-light"></i><span class="ms-1 d-none d-sm-inline text-light">Catégories</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-4">
                                    <a href="../public/index.php?page=11" class="nav-link align-middle px-0">
                                        <i class="bi bi-calendar2-plus fs-3 text-light"></i><span class="ms-1 d-none d-sm-inline text-light">Réductions</span>
                                    </a>
                                </li>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle bg-dark border-0 mb-4 dropMsg" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-chat-right-text fs-3 text-light me-2" data-bs-toggle="dropdown" aria-expanded="false"></i><span class="ms-1 d-none d-sm-inline text-light">Messages</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item mb-4"><a class="dropdown-item" href="../public/index.php?page=15">Reçus</a></li>
                                        <li class="nav-item mb-4"><a class="dropdown-item" href="../public/index.php?page=16">Répondu</a></li>
                                        <li class="nav-item mb-4"><a class="dropdown-item" href="../public/index.php?page=17">Archiver</a></li>
                                        <li class="nav-item mb-4"><a class="dropdown-item" href="../public/index.php?page=18">Supprimer</a></li>
                                    </ul>
                                </div>
                            </ul>
                            <hr class="d-none d-sm-block">
                        </div>
                    </div>
                    <div class="col-md-9 col-xl-10 px-sm-2 px-0 bg-light">
                        <?php
                        // Contenu de la page
                        if (isset($_GET['page'])) {
                            if ($_GET['page'] == 1) {
                                include "../front/accueil.php";
                            } elseif ($_GET['page'] == 2) {
                                include "../front/produits.php";
                            } elseif ($_GET['page'] == 3) {
                                include "../front/utilisateurs.php";
                            } elseif ($_GET['page'] == 4) {
                                include "../front/categories.php";
                            } elseif ($_GET['page'] == 5) {
                                include "../front/ajout_produit.php";
                            } elseif ($_GET['page'] == 6) {
                                include "../front/update_produit.php";
                            } elseif ($_GET['page'] == 7) {
                                include "../front/afficher_produit.php";
                            } elseif ($_GET['page'] == 8) {
                                include "../front/ajout_user.php";
                            } elseif ($_GET['page'] == 9) {
                                include "../front/edit_user.php";
                            } elseif ($_GET['page'] == 10) {
                                include "../front/afficher_user.php";
                            } elseif ($_GET['page'] == 11) {
                                include "../front/bon_reduction.php";
                            } elseif ($_GET['page'] == 12) {
                                include "../front/ajout_reduction.php";
                            } elseif ($_GET['page'] == 13) {
                                include "../front/edit_reduction.php";
                            } elseif ($_GET['page'] == 14) {
                                include "../front/ajout_categ.php";
                            } elseif ($_GET['page'] == 15) {
                                include "../front/message_recu.php";
                            } elseif ($_GET['page'] == 16) {
                             include "../front/message_repondu.php";
                            } elseif ($_GET['page'] == 17) {
                                include "../front/message_archiver.php";
                            } elseif ($_GET['page'] == 18) {
                                include "../front/message_supprimer.php";
                            } elseif ($_GET['page'] == 19) {
                                include "../front/afficher_message.php";
                            } elseif ($_GET['page'] == 20) {
                                include "../front/repondre_au_message.php";
                            }
                        } else {
                            include "../../front/accueil.php";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Fin de la Side Bar -->

    <?php } else {
            header('location:../../public/index.php');
        }
    } else {
        header('location:../../public/index.php');
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="../public/ressource/js/script.js"></script>
</body>

</html>

<?php
include('../../front/footer.php');
?>