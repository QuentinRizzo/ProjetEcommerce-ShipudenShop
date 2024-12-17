<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";
$userExiste = recupListeUtilisateur($pdo);
$roles = recupRoles($pdo);
$id_user = $_POST['id_user'];
$recupInfoUtilisateur =  recupInfoUtilisateur($pdo, $id_user);
$departements = recupDepartement($pdo);
?>
<div class="container-fluid">
    <div class="form h-100 feuille-contact mt-5 p-4">
        <?php
        if (isset($_GET['success'])) {

            if ($_GET['success'] == 'reductionAppliquer') {
                echo '<p class="Error text-center text-success">La réduction à été appliquer avec succès !</p>';
            }
        }
        if (isset($_GET['erreur'])) {

            if ($_GET['erreur'] == 'reductionExistante') {
                echo '<p class="Error text-center text-danger">Une réduction est déja en cours ! </p>';
            }
        }

        ?>
        <h1 class="text-center mb-5 mt-5">Editer l'utilisateur</h1>

        <form class="mb-5" method="post" action="../controler/traitement_update_user.php" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="nomEditUser" class="col-form-label">Nom :</label>
                    <input type="text" class="form-control" name="nomEditUser" id="nomEditUser" value="<?php echo $recupInfoUtilisateur ['nom'] ?>">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="prenomEditUser" class="col-form-label">Prénom :</label>
                    <input type="text" class="form-control" name="prenomEditUser" id="prenomEditUser" value="<?php echo $recupInfoUtilisateur ['prenom'] ?>">
                </div>
            </div>
            <div class="row">
            <div class="col-md-12 form-group mb-3">
                    <label for="adresseEditUser" class="col-form-label">Adresse :</label>
                    <input type="text" class="form-control" name="adresseEditUser" id="adresseEditUser" value="<?php echo $recupInfoUtilisateur ['adresse'] ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="mailEditUser" class="col-form-label">Mail :</label>
                    <input type="text" class="form-control" name="mailEditUser" id="mailEditUser" value="<?php echo $recupInfoUtilisateur ['mail'] ?>">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="telEditUser" class="col-form-label">Tel :</label>
                    <input type="text" class="form-control" name="telEditUser" id="telEditUser" value="<?php echo $recupInfoUtilisateur ['tel'] ?>">
                </div>
                <div class="col-md-6 form-group mb-3">
                <label for="ville" class="col-form-label">Département :</label>
                <select name="departement" id="departement" class="form-select" aria-label="Default select example">
                    <option value=""><?php echo htmlspecialchars($recupInfoUtilisateur['id_departement'], ENT_QUOTES, 'UTF-8').' '.htmlspecialchars($recupInfoUtilisateur['nom_departement'], ENT_QUOTES, 'UTF-8') ?></option>
                    <?php foreach ($departements as $dept) { ?>
                        <option value="<?php echo htmlspecialchars($dept['id_departement'], ENT_QUOTES, 'UTF-8') ?>"><?php echo htmlspecialchars($dept['nom_departement'], ENT_QUOTES, 'UTF-8') ?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                        <label for="ville" class="col-form-label">Ville :</label>
                        <select class="form-select" name="ville" id="ville">
                            <option value=""><?php echo htmlspecialchars($recupInfoUtilisateur['nom_ville'], ENT_QUOTES, 'UTF-8') ?></option>
                        </select>
                    </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Choix du role :</label>
                    <select name="roleEditUser" class="form-select" aria-label="Default select example">
                        <option selected><?php echo 'Rôle actuelle :'.' '. htmlspecialchars($recupInfoUtilisateur['id_role'], ENT_QUOTES, 'UTF-8') ?></option>
                        <?php foreach ($roles as $role) { ?>
                            <option value="<?php echo $role['id_role'] ?>"><?php echo $role['libelle'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12 form-group mb-3 d-flex align-items-center justify-content-center">
                        <input type="hidden" name="idUser" value="<?php echo $recupInfoUtilisateur ['id_user'] ?>">
                        <input type="hidden" name="idVille" value="<?php echo $recupInfoUtilisateur ['id_ville'] ?>">
                        <input type="submit" value="Enregistrer" class="btn-card text-center w-25" name="ajoutEdit">
                        <span class="submitting"></span>
                </div>
            </div>
        </form>
    </div>
</div>