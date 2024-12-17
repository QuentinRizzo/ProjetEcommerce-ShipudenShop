<!-- Dashboard -->
<!-- 
Pour les super admin afficher :

nombre de client enregistrer
nombre de produit disponible sur le site
nombre total des produits vendu
nombre total des facture générer en pdf
nombre total des produits en stock
nombre total des produits en rupture de stock

Pour les administrateurs
afficher Bienvenue dans la page d'accueil mais y rajouter un petit background sympa 
et mettre le titre dans une card pour le coté design
-->
<?php

require "../model/fonctions.php";
require "../../model/connexion_bdd.php";
$nbUser = recupNbUtilisateur($pdo);
$nbProds =  produitsDispoSite($pdo);
$totalProdVendu = totalDesProduitsVendu($pdo);
$nbProdEnStock = nbProduitEnStock($pdo);
$nbProdEnRuptureStock = nbProduitEnRuptureDeStock($pdo);
$nbUserEnregistrer = userEnregistrer($pdo);
$totalFact = totalFactureExistante($pdo);
$totalMessRecu = totalMessageRecu($pdo);
$totalPanCreer = totalPanCreer($pdo);
$totalAvisCl = totalAvisClient($pdo);

if ($_SESSION['idRoleUser'] == 5) {
?>
    <div class="container">
        <div class="container-fluid">
            <section id="minimal-statistics">
                <div class="row mb-5 mt-5">
                    <div class="col-12 mt-3 mb-1 card">
                        <h4 class="text-uppercase fs-1 text-center">Statistique du Site</h4>
                        <p class="text-uppercase fs-2 text-center">Stats globale</p>
                    </div>
                </div>

                <div class="row mt-5 mb-5">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="icon-pencil primary font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3><?php echo $nbUser['nbUsers'] ?></h3>
                                            <span>Client Enregistrer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="icon-speech warning font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3><?php echo $nbProds['nbProds'] ?></h3>
                                            <span>Produits Disponible</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="icon-graph success font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3><?php echo $totalProdVendu['totalProdVendu'] ?></h3>
                                            <span>Nombre de Produits Vendu</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="icon-pointer danger font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3><?php echo $nbProdEnStock['nbProdEnStock'] ?></h3>
                                            <span>Nombre de Produit en Stock</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row mt-5 mb-5">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="danger"><?php echo $nbProdEnRuptureStock['nbProdEnRuptureStock'] ?></h3>
                                            <span>Produit en Rupture de stock</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-rocket danger font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success"><?php echo $nbUserEnregistrer['nbUserEnregistrer'] ?></h3>
                                            <span>Client enregistré</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-user success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="warning"><?php echo $totalFact['totalFact'] ?></h3>
                                            <span>Total des Factures Enregistré</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-pie-chart warning font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="primary"><?php echo $totalMessRecu['totalMessRecu'] ?></h3>
                                            <span>Total des Message Reçu</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-support primary font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 mb-5">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="primary"><?php echo $totalPanCreer['totalPanCreer'] ?></h3>
                                            <span>Total des Paniers Créer</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-book-open primary font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="warning"><?php echo $totalAvisCl['totalAvisCl'] ?></h3>
                                            <span>Total des Avis Clients</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-bubbles warning font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        // Vue Administrateur \\
    } elseif ($_SESSION['idRoleUser'] == 4) {
        ?>
            <div class="container-fluid">
                <div class="card mt-5">
                    <h1 class="text-center mt-5 mb-5">Bienvenue dans La Page D'accueil</h1>
                </div>
            </div>
        <?php
    }
        ?>