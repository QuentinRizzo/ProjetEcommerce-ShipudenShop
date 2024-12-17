<?php
use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once '../vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';

require '../model/connexion_bdd.php';
require '../model/fonctions.php';

if ( $xlsx = SimpleXLSX::parse('../Classeur.xlsx') ) {
    // print_r( $xlsx->rows() );

    $produits = $xlsx->rows();
    $i = -1;
    $cptProdAjoutes = 0;
    $cptProdUpdated = 0;
    foreach ($produits as $produit){
        $i++; // idem que $i = $i + 1;
        if ($i != 0){

            // DEBUT TRAITEMENT CATEGORIE
            $nomCategorie = $produit[3]; // => Vérifiez bien l'indice dans votre tableau excel

            // On vérifie si la catégorie du produit en cours existe dans la BdD
            $categExiste = recupCategorie($pdo, $nomCategorie);

            if ($categExiste){ // cas où la catégorie existe déjà dans la BdD
                // On récupère l'id de cette catégorie
                $idCateg = $categExiste['id_categorie'];
            }else{ // cas où la catégorie n'existe pas dans la BdD
                // On l'insère dans la BdD
                insertCategorie($pdo, $nomCategorie);
                // On récupère l'id de la catégorie qu'on vient d'insérer
                $idCateg = $pdo->lastInsertId();
            }
            // FIN TRAITEMENT CATEGORIE



            // DEBUT TRAITEMENT PRODUIT
            $titre = $produit[1];  // => Vérifiez bien l'indice dans votre tableau excel
            $produitExiste = recupProduit($pdo, $titre);
            $taille = $produit[2];
            $materiel= $produit[3];
            $description = $produit[4];
            $categorie = $produit[5];
            $prixProduit = $produit[6];
            $stock = $produit[7];
            
            if ($produitExiste){ // Si le produit n'existe pas on l'insère
                $idProduit = $produitExiste['id_produit'];
                updateProduit($pdo, $titre, $materiel, $taille, $description, $prixProduit, $stock, $idCateg, $idProduit);
                $cptProdUpdated++;
            }else{
                    insertProduit($pdo,  $titre, $materiel, $taille, $description, $prixProduit, $stock, $idCateg);
                    $cptProdAjoutes++;
            }
            // FIN TRAITEMENT PRODUIT
        }
    }
    echo 'Import terminé<br>';
    echo 'Nb produits créés : '.$cptProdAjoutes;
    echo '<br>Nb produits mis à jour : '.$cptProdUpdated;
} else {
    echo SimpleXLSX::parseError();
}
