<?php
if (isset($_SESSION['idPanier'])) {
    $produitPanier = recupListeProduitDetail($pdo, $_SESSION['idPanier']);
    $reductionExiste = recupBonReductionValide($pdo);
    $fraisPorts = recupFraisDePorts($pdo);
    // var_dump($fraisPorts);
    // die();
}
?>

<section class="h-100 gradient-custom mt-5 w-75 mx-auto rounded-3">
    <?php
    if (isset($_SESSION['idPanier'])) {
    ?>
        <div class="row d-flex justify-content-center my-4 ResponsivePanier">
            <div class="col-md-8">
                <div class="card mb-4 border-panier">
                    <?php
                    if (isset($_GET['sucess'])) {
                        if ($_GET['sucess'] == 'suprimerProdPan') {
                            echo '<p class="Sucess text-success text-center">Le produit a été supprimé avec succès ! </p>';
                        }
                    }
                    ?>
                    <div class="card-header py-3">
                        <h5 class="mb-5 text-center">Vos Produits</h5>
                    </div>

                    <div class="card-panier">
                        <?php foreach ($produitPanier as $produit) { ?>
                            <div class="row">
                                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                    <div class="bg-image hover-overlay ripple rounded imagePanResponsive" data-mdb-ripple-color="light">
                                        <img src="../public/ressource/figurines/<?php echo $produit['logo'] ?>" class="w-100" alt="Barbe Noire" />
                                    </div>
                                </div>

                                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0 infoArticlePanResponsive">
                                    <p><strong><?php echo htmlspecialchars($produit['titre'], ENT_QUOTES, 'UTF-8') ?></strong></p>
                                    <p><?php echo htmlspecialchars($produit['description'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <p><?php echo htmlspecialchars($produit['materiel'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <p><?php echo htmlspecialchars($produit['taille'], ENT_QUOTES, 'UTF-8') ?> cm</p>
                                    <a href="../controler/traitement_panier.php?action=supprimerProd&idProd=<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Retirer l'article">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip" title="Déplacer vers la liste de souhaits">
                                        <i class="bi-heart"></i>
                                    </button>
                                </div>

                                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 infoArticlePanResponsive">
                                    <p class="text-center">Quantité</p>

                                    <from method="post" class="d-flex mb-4 BtnIPanResponsive" style="max-width: 300px;">
                                        <input type="hidden" value="<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8') ?>" id="id_produit">

                                        <button class="btn btn-link px-2 mb-5 text-light afficher" id="moinsArticles">
                                            <i class="bi bi-patch-minus"></i>
                                        </button>

                                        <div class="form-outline">
                                            <span id="resultatQte" class="w-100"><?php echo htmlspecialchars($produit['qte_com'], ENT_QUOTES, 'UTF-8') ?></span>
                                        </div>

                                        <button class="btn btn-link px-2 mb-5 text-light" id="plusArticles">
                                            <i class="bi bi-patch-plus"></i>
                                        </button>

                                    </from>
                                    <p class="text-start text-md-center infoArticlePanResponsive">
                                        <strong>Prix Unité :</strong><br>
                                        <strong><?php echo htmlspecialchars($produit['prix_unit'], ENT_QUOTES, 'UTF-8') ?> €</strong>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                        <hr class="my-4" />
                    </div>
                </div>

                <div class="col-md-4 w-100 ">
                    <div class="card mb-4 border-panier">
                        <div class="card-header py-3">
                            <h5 class="mb-0 text-center">Résumé</h5>
                        </div>

                        <div class="card-panier">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Nombre produits
                                    <span class="mx-2"><?php echo count($produitPanier); ?></span>
                                </li>
                                <input type="hidden" id="montantmin" value="<?php echo $fraisPorts['montant_min'] ?>">

                                <?php if ($fraisPorts['montant_min'] <= $produitPanier[0]['prix_total']) { ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                       Frais de Livraison
                                        <span id="fraisLivraison" class="mx-2">Gratuit</span>
                                    </li>
                                <?php } else { ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                       Frais de Livraison
                                        <span id="fraisLivraison" class="mx-2"><?php echo htmlspecialchars($fraisPorts['montant'], ENT_QUOTES, 'UTF-8') ?>€</span>
                                    </li>
                                <?php } ?>

                                <?php
                                $calculRemise  = 0; // ici on défini les valeur initial qui s'applique quand il n'y as pas de remises
                                $totalRemise =  $produit['prix_total']; // ici on défini les valeur initial qui s'applique quand il n'y as pas de remises
                                if ($reductionExiste) {
                                    if (count($produitPanier) >= $reductionExiste['nb_articles_min']) {
                                        $calculRemise = $reductionExiste['taux'] * $produit['prix_total'] / 100;
                                        $totalRemise =  $produit['prix_total'] - $calculRemise;
                                ?>
                                        <!-- Ceci s'affichera uniquement si la condition ci-dessus est vrai -->
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            Réduction
                                            <span class="mx-2"><?php echo htmlspecialchars($calculRemise, ENT_QUOTES, 'UTF-8'); ?></span>
                                        </li>
                                <?php }
                                } ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Montant Total</strong>
                                    </div>
                                    <?php if ($fraisPorts['montant_min'] >= $produit['prix_total']) { ?>
                                        <span id="montantTotal" class="mx-2"><?php echo htmlspecialchars($totalRemise + $fraisPorts['montant'], ENT_QUOTES, 'UTF-8'); ?>€</span>
                                    <?php } else { ?>
                                        <span id="montantTotal" class="mx-2"><?php echo htmlspecialchars($totalRemise, ENT_QUOTES, 'UTF-8'); ?>€</span>
                                    <?php } ?>
                                </li>
                            </ul>

                            <form action="../controler/traitement_panier.php" method="post">
                                <?php
                                $idBon = -1;
                                if ($reductionExiste) {
                                    $idBon = $reductionExiste['id_bon'];
                                }
                                ?>
                                <input type="hidden" name="BonReduction" value="<?php echo $idBon; ?>">
                                <input type="hidden" name="idProd" value="<?php echo htmlspecialchars($produit['id_produit'], ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="action" value="payerPan">
                                <input type="submit" class="btn btn-info d-flex align-items-center justify-content-center mx-auto mb-3 mt-3 btn-payer" value="Payer">
                            </form>

                        </div>
                    </div>
                </div>

                <div class="card mb-4 mb-lg-0 border-panier">
                    <p class="text-center"><strong>Moyens de Paiement</strong></p>
                    <div class="card-panier d-flex align-items-center justify-content-between flex-wrap card-panier-mobile">
                        <img class="me-2" width="45px" src="../public/ressource/img/visa.png" alt="Visa" />
                        <img class="me-2" width="45px" src="../public/ressource/img/psc.png" alt="PaysafeCard" />
                        <img class="me-2" width="45px" src="../public/ressource/img/mastercard.png" alt="Mastercard" />
                        <img class="me-2" width="45px" src="../public/ressource/img/paypal.png" alt="Paypal" />
                        <button type="button" class="btn  mx-2 mb-3 mt-3 btn-payer btn-ajout-card">Ajouter
                            une carte</button>
                    </div>
                </div>

                <div class="card mt-4 mb-4 mb-lg-0 border-panier">
                    <p class="text-center"><strong>Mode de Livraison : </strong></p>
                    <div class="card-panier d-flex align-items-center justify-content-between flex-wrap card-panier-mobile">
                        <select name="categ-figurine" class="form-select w-50 mx-auto" aria-label="Default select example">
                            <option selected>Choisir le mode de livraison</option>
                            <option value="1">Chrono poste</option>
                        </select>
                        <button type="button" class="btn  mx-auto mb-3 mt-3 btn-payer btn-ajout-card">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {
        echo '<p class="alert alert-danger text-center">Votre panier est vide</p>';
    } ?>
</section>