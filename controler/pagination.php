<?php 

    // 1. Récupérer le nombre total de produits à afficher
    $nbTotalProduits = countProduits($pdo);
    // 2. Définir le nombre d'articles de produits à afficher par page
    $limit = 6; // 3 Correspond au nombre d'articles a afficher par page

    // 3. Calculer le nombre total de pages en arrondissant à la valeur supérieur
    $nbPages = ceil($nbTotalProduits / $limit); // ceil() = function qui permet d' Arrondire au nombre supérieur
   
    // 4. Récupérer le numéro de la page à afficher
    $numPage = isset($_GET['num_page']) ? $_GET['num_page'] : 1; // veux dire si num_page existe et qu'elle est défini 
                                                                 // alors j'affecte $_GET['num_page'] a $numPage
                                                                 // sinon j'affiche la premiere page donc 1  (? = alors ) (: = sinon)
    // 5. Calculer l'indice du premier produit de la page à afficher
    $debut = ($numPage -1) * $limit;


    // 6. Récupérer les produits de la page à afficher avec une boucle
    $produits = recupProduits($pdo, $debut, $limit);


