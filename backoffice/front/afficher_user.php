<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";
$id_user = $_POST['id_user'];
$recupInfoUtilisateur =   recupInfoUtilisateur($pdo, $id_user);

?>



<div class="row mx-auto mt-1 d-flex mx-auto">
    <div class="col-lg-5 mx-auto">
        <img src="../../public/ressource/img/logo.png" class="d-block w-80 mt-5 mb-3 img-fluid image-card-equipe" alt=">">
    </div>
    <div class="row mx-auto mt-1 box-descProd-bOffice">
        <div class="col-lg-12 text-center h-100">
            <div class="box-detailtext mt-5 mb-5 mx-auto w-100">
                <div class="row">
                    <h1 class="mt-5 text-light fs-1">Fiche De L'utilisateur</h1>
                    <div class="col-lg-6">
                        <h5 class="card-title text-center text-light mt-4 fs-3 ">Nom :</h5>
                        <p class="card-text text-center text-light fs-5 mt-1"><?php echo $recupInfoUtilisateur['nom'] ?></p>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="card-title text-center text-light mt-4 fs-3 ">Prénom :</h5>
                        <p class="card-text text-center text-light fs-5 mt-1"><?php echo $recupInfoUtilisateur['prenom'] ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title text-center text-light mt-4 fs-3 ">E-mail :</h5>
                        <p class="card-text text-center text-light fs-5 mt-1"><?php echo $recupInfoUtilisateur['mail'] ?></p>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="card-title text-center text-light mt-4 fs-3 ">Tel :</h5>
                        <p class="card-text text-center text-light fs-5 mt-1"><?php echo $recupInfoUtilisateur['tel'] ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title text-center text-light mt-4 fs-3 ">Adresse :</h5>
                        <p class="card-text text-center text-light fs-5 mt-1"><?php echo $recupInfoUtilisateur['adresse'] ?></p>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="card-title text-center text-light mt-4 fs-3 ">Ville :</h5>
                        <p class="card-text text-center text-light fs-5 mt-1"><?php echo $recupInfoUtilisateur['nom_ville'] ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title text-center text-light mt-4 fs-3 ">Code Postal :</h5>
                        <p class="card-text text-center text-light fs-5 mt-1"><?php echo $recupInfoUtilisateur['code_postal'] ?></p>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="card-title text-center text-light mt-4 fs-3 ">Departement :</h5>
                        <p class="card-text text-center text-light fs-5 mt-1"><?php echo $recupInfoUtilisateur['nom_departement'] ?></p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title text-center text-light mt-4 fs-3 ">Pays :</h5>
                        <p class="card-text text-center text-light fs-5 mt-1"><?php echo $recupInfoUtilisateur['nom_pays'] ?></p>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="card-title text-center text-light mt-4 fs-3 ">Role :</h5>
                        <p class="card-text text-center text-light fs-5 mt-1"><?php echo $recupInfoUtilisateur['libelle'] ?></p>
                    </div>
                </div>
                <a href="../public/index.php?page=3" class="btn-desc btn mt-5 mb-5 mx-auto">Retour à la gestion</a>
            </div>
        </div>
    </div>

</div>