<?php
// ========================= Début des Fonction lié au Categorires (Excelle) ============================ \\

function recupCategorie($pdo, $nomCateg){
    $reqCateg = $pdo->prepare('SELECT * FROM categorie WHERE nom_categorie = ?');
    $reqCateg->execute([$nomCateg]);
    $categ = $reqCateg->fetch();
    return $categ;
}

// Permet d'inseret une catégorie \\
function insertCategorie($pdo, $nomCategorie){
    $reqInsertCateg = $pdo->prepare('INSERT INTO categorie(nom_categorie) VALUES(?)');
    $reqInsertCateg->execute([$nomCategorie]);
}

// Permet de récupérer une sous catégorie \\
function recupSousCategorie($pdo, $nomSousCateg){
    $reqSousCateg = $pdo->prepare('SELECT * FROM sous_categorie WHERE nom_sous_categorie = ?');
    $reqSousCateg->execute([$nomSousCateg]);
    $sousCateg = $reqSousCateg->fetch();
    return $sousCateg;
}

// Permet d'inséré une sous catégorie \\
function insertSousCategorie($pdo, $nomSousCategorie, $idCateg){
    $reqInsertSousCateg = $pdo->prepare('INSERT INTO sous_categorie(nom_sous_categorie, id_categorie) VALUES(?, ?)');
    $reqInsertSousCateg->execute([$nomSousCategorie, $idCateg]);
}
// ========================= Début des Fonction lié au Produits les plus Vendu Page Accueil ============================ \\

function listeDesProduitsLesPlusVendu($pdo){
    $reqListeDesProduitsLesPlusVendu = $pdo->prepare("SELECT * FROM produits, detail_panier, facturation 
    WHERE produits.id_produit = detail_panier.id_produit 
    AND detail_panier.id_panier = facturation.id_panier 
    AND produits.id_produit = produits.id_produit 
    GROUP BY produits.id_produit 
    ORDER BY qte_com DESC LIMIT 3;");
    $reqListeDesProduitsLesPlusVendu->execute();
    $listeDesProduitsLesPlusVendu = $reqListeDesProduitsLesPlusVendu->fetchAll();
    return $listeDesProduitsLesPlusVendu;
}

// ========================= Fin des Fonction lié au Produits les plus Vendu Page Accueil ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des Fonction lié au Avis des clients Page Accueil ============================ \\
function insertAvisClient($pdo,$titre, $desc, $notes, $date, $id_user){
    $reqInsertAvisClient = $pdo->prepare('INSERT INTO avis_client(titre_avis, desc_avis, notes, date, id_user) VALUES(?, ?, ?, ?, ?)');
    $reqInsertAvisClient->execute([$titre, $desc, $notes, $date, $id_user]);
}
function avisClient($pdo, $id_user){
    $reqAvisClient = $pdo->prepare('SELECT * FROM avis_client WHERE id_user = ?');
    $reqAvisClient->execute([$id_user]);
    $avisClient = $reqAvisClient->fetch();
    return $avisClient;
}

function listeAvisClient($pdo){
    $reqListeAvisClient = $pdo->prepare('SELECT * FROM avis_client, utilisateur WHERE avis_client.id_user = utilisateur.id_user AND avis_client.date ORDER BY date ASC LIMIT 3;');
    $reqListeAvisClient->execute();
    $reqListeAvisClient = $reqListeAvisClient->fetchAll();
    return $reqListeAvisClient;
}
// ========================= Fin des Fonction lié au Avis des clients Page Accueil ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des fonction lié au produits de la Boutique ============================ \\
// Récupère la liste de tout les produit index.php\\
function recupListeProduits($pdo){
    $reqrecupListeProduit = $pdo->prepare('SELECT * FROM produits');
    $reqrecupListeProduit->execute();
    $produitExiste = $reqrecupListeProduit->fetchAll();
    return $produitExiste;
}
// Permet d'inseret un produit \\ 
function insertProduit($pdo, $titre, $materiel, $taille, $description, $prixProduit, $stock, $idCateg){
    $reqInsertProduit = $pdo->prepare('INSERT INTO produits(titre, materiel, taille, description, prix_unit, stock, id_categorie) VALUES(?, ?, ?, ?, ?, ?, ?)');
    $reqInsertProduit->execute([$titre, $materiel, $taille, $description, $prixProduit, $stock, $idCateg]);
}
// Permet de récupérer un produit \\ 
function recupProduit($pdo, $titre){
    $reqProduit = $pdo->prepare('SELECT * FROM produits WHERE titre = ?');
    $reqProduit->execute([$titre]);
    $produitExiste = $reqProduit->fetch();
    return $produitExiste;
}

// Permet de mettre a jour un produit \\ 
function updateProduit($pdo, $titre, $materiel, $taille, $description, $prixProduit, $stock, $idCateg, $idProduit){
    $reqUpdateProduit = $pdo->prepare('UPDATE produits SET titre = ?, materiel = ?, taille = ?, description = ?, prix_unit = ?, stock = ?, id_categorie = ? WHERE id_produit = ?');
    $reqUpdateProduit->execute([$titre, $materiel, $taille, $description, $prixProduit, $stock, $idCateg, $idProduit]);
}

// Recupération de l'id d'un seul produit \\
function verifFigurine($pdo, $id_produit){
    $reqIdFigurineExiste = $pdo->prepare('SELECT * FROM produits WHERE id_produit = ?');
    $reqIdFigurineExiste->execute([$id_produit]);
    $FigurineExiste = $reqIdFigurineExiste->fetch();
    return $FigurineExiste;
}
// ========================= Fin des fonction lié au produits de la Boutique ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des fonction lié au Panier ============================ \\

// Vérifie si le panier existe \\ 
function panierExiste($pdo, $id_panier, $date_panier, $prix_total, $id_user){
    $reqRecupPanier = $pdo->prepare('SELECT * FROM panier WHERE id_panier = ? AND date_panier = ? AND prix_total = ? AND id_user = ?');
    $reqRecupPanier->execute([$id_panier, $date_panier, $prix_total, $id_user]);
    $PanierExistant = $reqRecupPanier->fetch();
    return $PanierExistant;
}

// Insérer le produit au panier \\
function insertDetailPanier($pdo, $id_produit, $id_panier, $qte_com, $prix_unit){
    $reqCreationDetailPanier = $pdo->prepare('INSERT INTO detail_panier (id_produit, id_panier, qte_com, prix_unit) VALUES(?, ?, ?, ?)');
    $reqCreationDetailPanier->execute([$id_produit, $id_panier, $qte_com, $prix_unit]);
}

// Update montant panier \\ :
function updateMontantPanier($pdo, $id_panier, $prix_total){
    $reqUpdatePanier = $pdo->prepare('UPDATE panier SET prix_total = prix_total + ? WHERE id_panier = ?');
    $reqUpdatePanier->execute([$prix_total, $id_panier]);
}


// permet de mettre a jours  la quantité du produit \\
function updateQteProduit($pdo, $id_panier, $id_produit, $qte){
    $reqUpdateQteProd = $pdo->prepare('UPDATE detail_panier SET qte_com = qte_com + ? WHERE id_panier = ? AND id_produit = ?');
    $reqUpdateQteProd->execute([$qte, $id_panier, $id_produit]);
}

// Creation du panier avec Id User \\
function createPanierUser($pdo, $datePanier, $prixTotal, $id_user){
    $reqCreationPanierUser = $pdo->prepare('INSERT INTO panier (date_panier, prix_total, id_user) VALUES(?, ?, ?)');
    $reqCreationPanierUser->execute([$datePanier, $prixTotal, $id_user]);
}

// Creation du panier sans l'user \\
function createPanier($pdo, $datePanier, $prixTotal){
    $reqCreationPanier = $pdo->prepare('INSERT INTO panier (date_panier, prix_total) VALUES(?, ?)');
    $reqCreationPanier->execute([$datePanier, $prixTotal]);
    $CreationPanier = $reqCreationPanier->fetch();
    return $CreationPanier;
}

// Verifier si le produit existe dans le panier \\
function produitExistePanier($pdo, $id_produit, $id_panier){
    $reqProduitExistPanier = $pdo->prepare('SELECT * FROM detail_panier WHERE id_produit = ? AND id_panier = ?');
    $reqProduitExistPanier->execute([$id_produit, $id_panier]);
    $ProduitExistPanier = $reqProduitExistPanier->fetch();
    return $ProduitExistPanier;
}

// Recup panier \\ 
function recupPanier($pdo, $id_panier){
    $reqPanier = $pdo->prepare('SELECT * FROM panier WHERE id_panier = ?');
    $reqPanier->execute([$id_panier]);
    $panierExiste = $reqPanier->fetch();
    return $panierExiste;
}

// Récuperation du Détail panier pour la Vue Front \\
function recupListeProduitDetail($pdo, $id_panier){
    $reqListeProduitDetail = $pdo->prepare('SELECT * FROM detail_panier, produits , panier WHERE detail_panier.id_produit = produits.id_produit AND detail_panier.id_panier = panier.id_panier AND detail_panier.id_panier = ?');
    $reqListeProduitDetail->execute([$id_panier]);
    $produitsDetails = $reqListeProduitDetail->fetchAll();
    return $produitsDetails;
}


// fonction qui retourne le nombre de produits dans le panier en cours \\
function recupNbProdPaniers($pdo, $id_panier){
    $reqNbProdPanier = $pdo->prepare('SELECT COUNT(*) as nbProdsPan FROM detail_panier WHERE id_panier = ?');
    $reqNbProdPanier->execute([$id_panier]);
    $nbProdPanier = $reqNbProdPanier->fetch();
    return $nbProdPanier['nbProdsPan'];
}

// Suppression produit panier \\ 
function SuprimePanier($pdo, $id_panier){
    $reqSuprimePanier = $pdo->prepare('DELETE FROM panier WHERE id_panier = ?');
    $reqSuprimePanier->execute([$id_panier]);
}
// Suppression du panier \\
function  suprimerProdPan($pdo, $id_produit, $id_panier){
    $reqSuprimerProdPan = $pdo->prepare('DELETE FROM detail_panier WHERE id_produit = ? AND id_panier = ?');
    $reqSuprimerProdPan->execute([$id_produit, $id_panier]);
}

// Récupère toutes les réduction enregistrer en bdd 
function recupBonReductionValide($pdo){
    $reqRecupBonReductionValide = $pdo->prepare('SELECT * FROM bon_reduction WHERE NOW() BETWEEN date_debut AND date_fin');
    $reqRecupBonReductionValide->execute();
    $bonReductionValide = $reqRecupBonReductionValide->fetch();
    return $bonReductionValide;
}

// Permet de récupérer le montant du pannier \\
function recupMontantPanier($pdo, $id_panier){
    $reqRecupMontantPanier = $pdo->prepare('SELECT prix_total FROM panier WHERE id_panier = ?');
    $reqRecupMontantPanier->execute([$id_panier]);
    $RecupmontantPanier = $reqRecupMontantPanier->fetch();
    return $RecupmontantPanier['prix_total'];
}
// ========================= Fin des fonction lié au Panier ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des fonction lié à la Facturation ============================ \\

// recupérer le numero Facture dont l id facture correspond au max \\
function recupNumFactIdMax($pdo){
    $reqRecupNumFactIdMax = $pdo->prepare('SELECT num_facture FROM facturation WHERE id_facturation = (SELECT MAX(id_facturation) FROM facturation)');
    $reqRecupNumFactIdMax->execute();
    $numFactIdMax = $reqRecupNumFactIdMax->fetch();
    return $numFactIdMax;
}


// Ajout de la facture du pannier en Bdd\\
function insertFacture($pdo, $num_facture, $date_facture, $id_adresse, $id_panier, $id_user, $id_bon){
    $req = 'INSERT INTO facturation (num_facture, date_facture, id_adresse, id_adresse_1, id_panier, id_user) VALUES(?, ?, ?, ?, ?, ?)';
    $tabValues = [$num_facture, $date_facture, $id_adresse, 2, $id_panier, $id_user];
    if ($id_bon != -1) {
        $req = 'INSERT INTO facturation (num_facture, date_facture, id_adresse, id_adresse_1, id_panier, id_user, id_bon) VALUES(?, ?, ?, ?, ?, ?, ?)';
        $tabValues = [$num_facture, $date_facture, $id_adresse, 2, $id_panier, $id_user, $id_bon];
    }
    $reqInsertFacture = $pdo->prepare($req);
    $reqInsertFacture->execute($tabValues);
}

// ========================= Début des fonction lié à la Facturation ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des fonction lié a l'inscription Connexion Profil Utilisateur ============================ \\

// On récupére les information d'un seul utilisateur \\
function recupInfosUsers($pdo, $id_user){
    $reqRecupInfosUser = $pdo->prepare("SELECT * FROM utilisateur, adresses, departement, ville  WHERE departement.id_departement = ville.id_departement AND ville.id_ville = adresses.id_ville AND adresses.id_user = utilisateur.id_user AND utilisateur.id_user = ?");
    $reqRecupInfosUser->execute([$id_user]);
    $infoUser = $reqRecupInfosUser->fetch();
    return $infoUser;
}
// Ici on récupère le type de l'adresse \\
function recupAdresseUser($pdo, $id_adresse, $id_user){
    $reqRecupAdresseUser = $pdo->prepare("SELECT * FROM adresses WHERE id_adresse = ? AND id_user = ?");
    $reqRecupAdresseUser->execute([$id_adresse, $id_user]);
    $adresseUser = $reqRecupAdresseUser->fetch();
    return $adresseUser;
}
// Vérifi si un user est enregistrer en bdd \\
function verifUserExiste($pdo, $mail){
    $reqUserExiste = $pdo->prepare('SELECT * FROM utilisateur WHERE mail = ?');
    $reqUserExiste->execute([$mail]);
    $userExiste = $reqUserExiste->fetch();
    return $userExiste;
}

// Inseré un utilisateur a la bdd \\
function inserUser($pdo, $nom, $prenom, $mail, $tel, $hashMdp){
    $reqInsertUser = $pdo->prepare('INSERT INTO utilisateur(nom, prenom, mail, tel, mdp, deleted, id_role) VALUES(?, ?, ?, ?, ?, ?, ?)');
    $reqInsertUser->execute([$nom, $prenom, $mail, $tel, $hashMdp, 0, 3]);
}
// Permet d'inseret l'adresse de l'utilisateur a la base de données \\
function insertAdressUser($pdo, $adresse, $id_ville, $id_user){
    $reqInsertAdressUser = $pdo->prepare('INSERT INTO adresses(adresse, id_ville, id_user) VALUES(?, ?, ?)');
    $reqInsertAdressUser->execute([$adresse, $id_ville, $id_user]);
}

// Recuperation des départements \\
function recupDepartement($pdo){
    $reqRecupDepartement = $pdo->prepare("SELECT * FROM departement");
    $reqRecupDepartement->execute();
    $dep = $reqRecupDepartement->fetchall();
    return $dep;
}
// Récupération des villes des Départements
function recupVillesDept($pdo, $id_departement){
    $reqRecupecupVillesDept = $pdo->prepare('SELECT * FROM ville WHERE id_departement = ?');
    $reqRecupecupVillesDept->execute([$id_departement]);
    $recupVillesDept = $reqRecupecupVillesDept->fetchAll();
    return $recupVillesDept;
}
// Recupération de la ville d'un utilisateur \\
function recupAdresseUsers($pdo, $id_user){
    $reqRecupAdresseUsers = $pdo->prepare("SELECT * FROM adresses WHERE id_user = ?");
    $reqRecupAdresseUsers->execute([$id_user]);
    $adresseUser = $reqRecupAdresseUsers->fetch();
    return $adresseUser;
}

// Verification du Mot de passe 
function recupMdp($pdo, $id_user){
    $reqVerifMdp = $pdo->prepare("SELECT mdp FROM utilisateur WHERE id_user = ? ");
    $reqVerifMdp->execute([$id_user]);
    $verifMdp = $reqVerifMdp->fetch();
    return $verifMdp['mdp'];
}

// ========================= Mot de passe Oublier ============================ \\

// Insertion du token en base de donnée \\
function inserToken($pdo, $id_user, $token, $date_expiration){
    $reqInsertToken = $pdo->prepare('INSERT INTO token(id_user, token, date_expiration) VALUES(?, ?, ?)');
    $reqInsertToken->execute([$id_user, $token, $date_expiration]);
}
// Vérification si le token est valide
function verifTokenValide($pdo, $id_user, $token){
    $reqVerifTokenValide = $pdo->prepare("SELECT * FROM token WHERE id_user = ? AND token = ?");
    $reqVerifTokenValide->execute([$id_user, $token]);
    $VerifTokenValide = $reqVerifTokenValide->fetch();
    return $VerifTokenValide;
}
// supprimer le token de la bdd \\
function suprimeToken($pdo, $id_user){
    $reqSuprimeToken = $pdo->prepare('DELETE FROM token WHERE id_user = ?');
    $reqSuprimeToken->execute([$id_user]);
}

// Modification du Mot de passe \\
function updatePassword($pdo, $mdp, $id_user){
    $reqUpdatePassword = $pdo->prepare('UPDATE utilisateur SET mdp = ? WHERE id_user = ?');
    $reqUpdatePassword->execute([$mdp, $id_user]);
}
// ========================= Fin Mot de passe Oublier ============================ \\

// ========================= Début des fonction lié a l'inscription Connexion Profil Utilisateur ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des fonction lié a la Facturation de l' Utilisateur ============================ \\

function recupFraisDePorts($pdo){
    $reqRecupFraisDePorts = $pdo->prepare("SELECT * FROM frais_port");
    $reqRecupFraisDePorts->execute();
    $recupFraisDePorts = $reqRecupFraisDePorts->fetch();
    return $recupFraisDePorts;
}

// Recupération des facture du client \\
function recupFactureClient($pdo, $id_user){
    $reqRecupFactureClient = $pdo->prepare("SELECT * FROM facturation, panier, utilisateur WHERE facturation.id_panier = panier.id_panier AND panier.id_user = utilisateur.id_user AND utilisateur.id_user = ?");
    $reqRecupFactureClient->execute([$id_user]);
    $factureClient = $reqRecupFactureClient->fetchAll();
    return $factureClient;
}

// Récupération des informations facture \\
function recupInfosFacture($pdo, $id_panier, $id_user){
    $reqRecupInfosFacture = $pdo->prepare('SELECT * FROM detail_panier, produits, panier, facturation
        WHERE produits.id_produit = detail_panier.id_produit
        AND panier.id_panier = detail_panier.id_panier 
        AND facturation.id_panier = panier.id_panier
        AND facturation.id_panier = ? 
        AND panier.id_user = ?');
    $reqRecupInfosFacture->execute([$id_panier, $id_user]);
    $infosFacture = $reqRecupInfosFacture->fetchAll();
    return $infosFacture;
}

// Récupération des information des factures de l'utilisateur 
function RecupFactureInfosUser($pdo, $id_facturation, $id_user){
    $reqRecupFactureInfosUser = $pdo->prepare('SELECT * FROM facturation, utilisateur, adresses, ville 
        WHERE facturation.id_user = utilisateur.id_user 
        AND utilisateur.id_user = adresses.id_user 
        AND adresses.id_ville = ville.id_ville 
        AND facturation.id_facturation = ? 
        AND utilisateur.id_user = ?');
    $reqRecupFactureInfosUser->execute([$id_facturation, $id_user]);
    $recupFactureInfosUser = $reqRecupFactureInfosUser->fetch();
    return $recupFactureInfosUser;
}

// ========================= Fin des fonction lié a la Facturation de l' Utilisateur ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des fonctions Lié à la Recherche Produits Dynamique(Ajax)  ============================ \\

// Récupérer un produit grace a ça saisie dynamique \\
function rechercheFigurinesParNom($pdo, $motCle){

    $req = "SELECT * FROM produits WHERE titre LIKE :motCle";
    $reqRecupFigurinesParNom = $pdo->prepare($req); // les produits qui commencent par la saisie (motCle)
    $motCle = "$motCle%";
    $reqRecupFigurinesParNom->bindParam(':motCle', $motCle);
    $reqRecupFigurinesParNom->execute();
    $recupFigurinesParNom = $reqRecupFigurinesParNom->fetchAll();
    return $recupFigurinesParNom;
}
// Recherche les produits par Prix \\
function rechercherProduitParPrix($pdo, $prixmin, $prixmax){
    $req = "SELECT * FROM produits WHERE prix_unit >= ?";
    $tabValues = [$prixmin];
    if(!empty($prixmax)){
        $req .= " AND prix_unit <= ?";
        $tabValues = [$prixmin, $prixmax];
    }
    $reqRecupFigurinesParPrix = $pdo->prepare($req);
    $reqRecupFigurinesParPrix->execute($tabValues);
    $recupFigurinesParPrix = $reqRecupFigurinesParPrix->fetchAll();
    return $recupFigurinesParPrix;
}

function rechercheParSelect($pdo) {
    $req = "SELECT * FROM produits WHERE deleted = 0";

    if (isset($_SESSION['tris'])) {
        $tris = $_SESSION['tris'];

        switch ($tris) {
            case 'ordreCroissant':
                $req .= " ORDER BY prix_unit ASC";
                break;
            case 'ordreDecroissant':
                $req .= " ORDER BY prix_unit DESC";
                break;
            case 'alphabet':
                $req .= " ORDER BY titre ASC";
                break;
            case'default':
               unset($_SESSION['tris']);
                break;
        }
    }
    $reqRechercheParSelect = $pdo->prepare($req);
    $reqRechercheParSelect->execute();
    $resultatRecherche = $reqRechercheParSelect->fetchAll();
    return $resultatRecherche;
}



// ========================= Fin des fonctions Lié à la Recherche Produits Dynamique(Ajax)  ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des  Function Lié au Favoris ============================ \\

// Récupération des produits en favoris
function recupFavoris($pdo, $id_produit){
    $reqRecupFavoris = $pdo->prepare('SELECT * FROM favoris, utilisateur WHERE favoris.id_user = utilisateur.id_user AND id_produit = ? AND favoris.deleted = 0');
    $reqRecupFavoris->execute([$id_produit]);
    $ProduitFavoris = $reqRecupFavoris->fetchAll();
    return $ProduitFavoris;
}

// Récupération de la liste des favoris de l'utilisateur\\
function recupFavorisUser($pdo, $id_user){
    $reqRecupFavorisUser = $pdo->prepare('SELECT * FROM favoris, produits WHERE favoris.id_produit = produits.id_produit AND favoris.id_user = ? AND favoris.deleted = 0 ');
    $reqRecupFavorisUser->execute([$id_user]);
    $ProduitFavorisUser = $reqRecupFavorisUser->fetchAll();
    return $ProduitFavorisUser;
}

function inserFavoris($pdo, $id_user, $id_produit, $deleted){
    $reqInsertFavoris = $pdo->prepare('INSERT INTO favoris(id_user, id_produit, deleted) VALUES(?, ?, ?)');
    $reqInsertFavoris->execute([$id_user, $id_produit, $deleted]);
}
function deleteFavoris($pdo, $id_favoris, $id_user){
    $reqDeleteFavoris = $pdo->prepare('UPDATE favoris SET deleted = 1 WHERE id_favoris = ? AND id_user = ?');
    $reqDeleteFavoris->execute([$id_favoris, $id_user]);
}
// ========================= Fin des  Function Lié au Favoris ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des  Function Lié au Formulaire de contact ============================ \\

function recupCategMessage($pdo){
    $reqRecupCategMessage = $pdo->prepare('SELECT * FROM categ_message');
    $reqRecupCategMessage->execute();
    $recupCategMessage = $reqRecupCategMessage->fetchAll();
    return $recupCategMessage;
}

function emailExist($pdo, $email){
    $reqRecupMail = $pdo->prepare('SELECT * FROM utilisateur WHERE mail = ?');
    $reqRecupMail->execute([$email]);
    $recupMail = $reqRecupMail->fetchAll();
    return $recupMail;
}
// ========================= Fin des  Function Lié au Formulaire de contact ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des fonctions lié a la Pagination ============================ \\

function countProduits($pdo){
    $reqRecupCountProduits = $pdo->prepare('SELECT COUNT(*) as nbProduits FROM produits');
    $reqRecupCountProduits->execute();
    $resNbProduits = $reqRecupCountProduits->fetch();
    return $resNbProduits['nbProduits'];
}

function recupProduits($pdo, $debut, $limit){
    $req = "SELECT * FROM produits WHERE deleted = 0";
    if (isset($_SESSION['tris'])) {
        $tris = $_SESSION['tris'];

        switch ($tris) {
            case 'ordreCroissant':
                $req .= " ORDER BY prix_unit ASC";
                break;
            case 'ordreDecroissant':
                $req .= " ORDER BY prix_unit DESC";
                break;
            case 'alphabet':
                $req .= " ORDER BY titre ASC";
                break;
        }
    }
    $req .= " LIMIT " . $debut . "," . $limit;
    $reqRecupProduits = $pdo->prepare($req);
    $reqRecupProduits->execute();
    $recupProduits = $reqRecupProduits->fetchAll();
    return $recupProduits;
}

function recupDetailProduit($pdo, $id_produit){
    $reqRecupDetailProduit = $pdo->prepare('SELECT * FROM produits, image WHERE image.id_produit = produits.id_produit AND produits.id_produit = ?');
    $reqRecupDetailProduit->execute([$id_produit]);
    $recupDetailProduit = $reqRecupDetailProduit->fetch();
    return $recupDetailProduit;
}

// ========================= Fin des fonctions lié a la Pagination ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des fonctions lié au Formulaire de Contact ============================ \\

function insertMessageEnvoyer($pdo,$nom_envoyeur, $prenom_envoyeur, $mail_envoyeur, $objet_message, $contenue_message, $id_user, $status){
    $reqInsertMessageEnvoyer = $pdo->prepare('INSERT INTO messages(nom_envoyeur, prenom_envoyeur, mail_envoyeur, objet_message, contenue_message, id_user, status) VALUES(?, ?, ?, ?, ?, ?, ?)');
    $reqInsertMessageEnvoyer->execute([$nom_envoyeur, $prenom_envoyeur, $mail_envoyeur, $objet_message, $contenue_message, $id_user, $status]);
}
// ========================= Fin des fonctions lié au Formulaire de Contact ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\


function recupTraceProdPromundus($pdo){
    $reqRecupTraceProdPromundus = $pdo->prepare('SELECT * FROM livraison_promundus ');
    $reqRecupTraceProdPromundus->execute();
    $recupTraceProdPromundus = $reqRecupTraceProdPromundus->fetchAll();
    return $recupTraceProdPromundus;
}