<?php
require "../../model/connexion_bdd.php";
require "../model/fonctions.php";
$messageExiste = recupListeMessages($pdo);
?>
<section class="intro mt-5 mb-5">

    <div class="container-fluid">
        <?php
        if (isset($_GET['sucess'])) {

            if ($_GET['sucess'] == 'ok') {
                echo '<p class="text-success text-center">Le Message à été ajouter avec succès ! </p>';
            }
            if ($_GET['sucess'] == 'produitMAj') {
                echo '<p class="text-success text-center">Le Message à été Mis a jour avec succès ! </p>';
            }
        }
        if (isset($_GET['erreur'])) {

            if ($_GET['erreur'] == 'FigurineExiste') {
                echo '<p class="Error text-center text-danger">Le Message existe déja ! </p>';
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
                                        <th scope="col">Objet</th>
                                        <th scope="col">nom</th>
                                        <th scope="col">mail</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($messageExiste as $indice => $msg) {
                                        $indice++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $indice; ?></th>
                                            <td><?php echo $msg['objet_message'] ?></td>
                                            <td><?php echo $msg['nom_envoyeur'] . ' ' . $msg['prenom_envoyeur'] ?></td>
                                            <td><?php echo $msg['mail_envoyeur'] ?></td>
                                            <td class="d-flex align-items-center">
                                                <form action="../controler/traitement_message_archiver.php" method="post" onsubmit="return confirm('Voulez-vous vraiment Archiver le message ?');">
                                                    <input type="hidden" name="id_messages" value="<?php echo $msg['id_messages']; ?>">
                                                    <input type="hidden" name="action" value="archiverMessage">
                                                    <button type="submit" class="btn btn-danger btn-sm me-1" data-mdb-toggle="tooltip" title="Archiver le Message">
                                                        <i class="bi bi-archive fs-4"></i>
                                                    </button>
                                                </form>

                                                <form action="../public/index.php?page=19" method="post">
                                                    <input type="hidden" name="id_messages" value="<?php echo $msg['id_messages']; ?>">
                                                    <input type="hidden" name="action" value="afficher le Message">
                                                    <button type="submit" class="btn btn-primary btn-sm" title="Afficher le Message">
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