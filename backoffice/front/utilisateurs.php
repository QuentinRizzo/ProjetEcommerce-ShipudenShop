<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";
$userExiste = recupListeUtilisateur($pdo);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-center justify-content-between mt-5">
            <h1>Affichage Utilisateurs</h1>
            <button class="btn-card  text-center"><a class="nav-link text-light" href="../public/index.php?page=8">Ajout d'utilisateur</a></button>
        </div>
    </div>
</div>
<section class="intro mt-5 mb-5">
    <div class="container-fluid">
        <?php
        if (isset($_GET['sucess'])) {
            if ($_GET['sucess'] == 'suprimerAvecSuccess') {
                echo '<p class="text-success text-center">L utilisateur à été supprimé avec succès ! </p>';
            }
            if ($_GET['sucess'] == 'UtilisateurMaj') {
                echo '<p class="Error text-center text-success">Utilisateur mis a jour avec succès! </p>';
            }
            if ($_GET['sucess'] == 'compteCree') {
                echo '<p class="Error text-center text-success">Utilisateur Ajouter avec succès!</p>';
            }
        }
        if (isset($_GET['erreur'])) {
            if ($_GET['erreur'] == 'erreurSupression') {
                echo '<p class="Error text-center text-danger">Une erreur est survenue lors de la suppression !</p>';
            }
            if ($_GET['erreur'] == 'ErreurMajUtilisateur') {
                echo '<p class="Error text-center text-danger">Une erreur est survenu lors de la modification ! </p>';
            }
            if ($_GET['erreur'] == 'emailExiste') {
                echo '<p class="Error text-center text-danger">Cette utilisateur Existe déja ! </p>';
            }
        }
        ?>
        <div class="row">
            <div class="col-12">
                <div class="card bg-white">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">prénom</th>
                                        <th scope="col">role</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($userExiste as $indice => $user) {
                                        $indice++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $indice; ?></th>
                                            <td><?php echo $user['nom'] ?></td>
                                            <td><?php echo $user['prenom'] ?></td>
                                            <td><?php if ($user['id_role'] == 4) {
                                                    echo 'admin';
                                                } elseif ($user['id_role'] == 3) {
                                                    echo 'client';
                                                } ?></td>

                                            <td class="d-flex align-items-center">

                                                <form action="../controler/traitement_delete_user.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette utilisateur ?');">
                                                    <input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">
                                                    <input type="hidden" name="action" value="suprimerUser">
                                                    <button type="submit" class="btn btn-danger btn-sm me-1" data-mdb-toggle="tooltip" title="Retirer l'utilisateur">
                                                        <i class="bi bi-trash-fill fs-4"></i>
                                                    </button>
                                                </form>

                                                <form action="../public/index.php?page=9" method="post">
                                                    <input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">
                                                    <input type="hidden" name="action" value="EditerUser">
                                                    <button type="submit" class="btn btn-secondary btn-sm me-1" title="Editer l' utilisateur">
                                                        <i class="bi bi-pencil-square fs-4"></i>
                                                    </button>
                                                </form>

                                                <form action="../public/index.php?page=10" method="post">
                                                    <input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">
                                                    <input type="hidden" name="action" value="AfficherUser">
                                                    <button type="submit" class="btn btn-primary btn-sm" title="Afficher l'utilisateur">
                                                        <i class="bi bi-eye fs-4"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>