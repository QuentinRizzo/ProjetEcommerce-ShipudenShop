<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";
$id_message = $_POST['id_messages'];
$messageExiste = recupInfosMessage($pdo, $id_message);

?>


<div class="row mx-auto mt-1 d-flex mx-auto">
    <div class="row mx-auto mt-1 box-descProd-bOffice">
        <div class="col-lg-12 text-center h-100">
            <div class="box-detailtext mt-5 mb-5 mx-auto w-100">
                <div class="row">
                    <h1 class="mt-5 text-light fs-1">Détail Du Message</h1>
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="card-title text-center text-light mt-5 mb-1">Nom :</h5>
                            <p class="card-text text-center text-light"><?php echo $messageExiste['nom_envoyeur'] ?></p>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="card-title text-center text-light mt-5 mb-1">Prénom :</h5>
                            <p class="card-text text-center text-light"><?php echo $messageExiste['prenom_envoyeur'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="card-title text-center text-light mt-5 mb-1">Objet :</h5>
                            <p class="card-text text-center text-light"><?php echo $messageExiste['objet_message'] ?></p>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="card-title text-center text-light mt-5 mb-1">mail :</h5>
                            <p class="card-text text-center text-light"><?php echo $messageExiste['mail_envoyeur'] ?></p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="card-title text-center text-light mt-5 mb-1">Contenue du Message :</h5>
                            <p class="card-text text-center text-light"><?php echo $messageExiste['contenue_message'] ?></p>
                        </div>
                    </div>
                    <form class="mx-auto mt-5" action="../public/index.php?page=20" method="post">
                        <input type="hidden" name="id_messages" value="<?php echo $messageExiste['id_messages'] ?>">
                        <input type="submit" value="Répondre" class="btn-card btn mt-5  mx-auto">
                    </form>
                    <a href="../public/index.php?page=1" class="btn-card btn mt-5 mb-5 mx-auto w-25">Retour a la gestion</a>
                </div>
            </div>
        </div>

    </div>