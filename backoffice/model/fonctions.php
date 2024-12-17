<?php

// ========================= Début des fonctions lié au Statistique Global du site  ============================ \\

function recupNbUtilisateur($pdo){
    $reqRecupNbUtilisateur = $pdo->prepare('SELECT count(id_user) as nbUsers FROM utilisateur');
    $reqRecupNbUtilisateur->execute();
    $recupNbUtilisateur = $reqRecupNbUtilisateur->fetch();
    return $recupNbUtilisateur;
}

function produitsDispoSite($pdo){
    $reqRecupNbProduitsDispoSite = $pdo->prepare('SELECT count(id_produit) as nbProds FROM produits');
    $reqRecupNbProduitsDispoSite->execute();
    $recupNbProduitsDispoSite = $reqRecupNbProduitsDispoSite->fetch();
    return $recupNbProduitsDispoSite;
}
function totalDesProduitsVendu($pdo){
    $reqRecupTotalDesProduitsVendu = $pdo->prepare('SELECT count(id_produit) as totalProdVendu FROM detail_panier');
    $reqRecupTotalDesProduitsVendu->execute();
    $recupTotalDesProduitsVendu = $reqRecupTotalDesProduitsVendu->fetch();
    return $recupTotalDesProduitsVendu;
}
function nbProduitEnStock($pdo){
    $reqRecupNombreProdEnStock = $pdo->prepare('SELECT count(id_produit) as nbProdEnStock FROM produits WHERE stock >= 1');
    $reqRecupNombreProdEnStock->execute();
    $recupNombreProdEnStock = $reqRecupNombreProdEnStock->fetch();
    return $recupNombreProdEnStock;
}
function nbProduitEnRuptureDeStock($pdo){
    $reqRecupNombreProdEnRuptureDeStock = $pdo->prepare('SELECT count(id_produit) as nbProdEnRuptureStock FROM produits WHERE stock < 1');
    $reqRecupNombreProdEnRuptureDeStock->execute();
    $recupNombreProdEnRuptureDeStock = $reqRecupNombreProdEnRuptureDeStock->fetch();
    return $recupNombreProdEnRuptureDeStock;
}
function userEnregistrer($pdo){
    $reqRecupNbUserEnregistrer = $pdo->prepare('SELECT count(id_user) as nbUserEnregistrer FROM utilisateur');
    $reqRecupNbUserEnregistrer->execute();
    $recupNbClientEnregistrer = $reqRecupNbUserEnregistrer->fetch();
    return $recupNbClientEnregistrer;
}
function totalFactureExistante($pdo){
    $reqRecupTotalFactureExistante = $pdo->prepare('SELECT count(id_facturation) as totalFact FROM facturation');
    $reqRecupTotalFactureExistante ->execute();
    $recupTotalFactureExistante  = $reqRecupTotalFactureExistante->fetch();
    return $recupTotalFactureExistante;
}
function totalMessageRecu($pdo){
    $reqRecupTotalMessageRecu = $pdo->prepare('SELECT count(id_messages) as totalMessRecu FROM messages WHERE status = "EnAttente" ');
    $reqRecupTotalMessageRecu ->execute();
    $recupTotalMessageRecu  = $reqRecupTotalMessageRecu->fetch();
    return $recupTotalMessageRecu;
}
function totalPanCreer($pdo){
    $reqRecupTotalPanCreer = $pdo->prepare('SELECT count(id_panier) as totalPanCreer FROM panier');
    $reqRecupTotalPanCreer ->execute();
    $recupTotalPanCreer  = $reqRecupTotalPanCreer->fetch();
    return $recupTotalPanCreer;
}
function totalAvisClient($pdo){
    $reqRecupTotalAvisClient = $pdo->prepare('SELECT count(id_avis) as totalAvisCl FROM avis_client');
    $reqRecupTotalAvisClient ->execute();
    $recupTotalAvisClient  = $reqRecupTotalAvisClient->fetch();
    return $recupTotalAvisClient;
}

// ========================= Fin des fonctions lié au Statistique Global du site  ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des  Function Lié a la Gestions des Produits ============================ \\

// Vérification si les Figurine existe déja ou non\\
function figurineExistante($pdo, $titre){
    $reqFigurineExistante = $pdo->prepare('SELECT * FROM produits WHERE titre = ?');
    $reqFigurineExistante->execute([$titre]);
    $figurineExistante = $reqFigurineExistante->fetch();
    return $figurineExistante;
}

function produitExistePanier($pdo, $id_produit, $id_panier){
    $reqProduitExistPanier = $pdo->prepare('SELECT * FROM detail_panier WHERE id_produit = ? AND id_panier = ?');
    $reqProduitExistPanier->execute([$id_produit, $id_panier]);
    $ProduitExistPanier = $reqProduitExistPanier->fetch();
    return $ProduitExistPanier;
}
// Inséret les produits dans la bdd \\
function insertFigurine($pdo, $titre, $materiel, $taille, $description, $prix_unit, $chemin, $stock , $id_categorie, $deleted){
    $reqCreationFigurine = $pdo->prepare('INSERT INTO produits (titre, materiel, taille, description, prix_unit, logo, stock, id_categorie ,deleted) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $reqCreationFigurine->execute([$titre, $materiel, $taille, $description, $prix_unit, $chemin, $stock , $id_categorie, $deleted]);
}
function recupStockProduit($pdo, $stock, $id_produit){
    $reqRecupStockProduit = $pdo->prepare('SELECT * FROM produits WHERE stock = ? AND id_produit = ?');
    $reqRecupStockProduit->execute([$stock, $id_produit]);
    $recupStockProduits = $reqRecupStockProduit->fetch();
    return $recupStockProduits;
}
function recupNbFigurineExiste($pdo, $id_produit){
    $reqNbFigurineExiste = $pdo->prepare('SELECT COUNT(*) as nbProdsPan FROM produits WHERE id_produit = ?');
    $reqNbFigurineExiste->execute([$id_produit]);
    $nbFigurineExiste = $reqNbFigurineExiste->fetch();
    return $nbFigurineExiste['nbProdsPan'];
}

function updateStockFigurine($pdo, $titre, $materiel, $taille, $description, $prix_unit, $logo, $stock, $id_categorie, $id_produit){
    $reqUpdateStockFigurine = $pdo->prepare('UPDATE produits SET titre = ? , materiel = ? , taille = ? , description = ? , prix_unit = ? , logo = ? , stock = ? , id_categorie = ? WHERE id_produit = ?');
    $reqUpdateStockFigurine->execute([$titre, $materiel, $taille, $description, $prix_unit, $logo, $stock, $id_categorie, $id_produit]);
}
function updateImg($pdo, $nom_img, $publication, $id_produit){
    $reqUpdateImg = $pdo->prepare('UPDATE image SET nom_img = ?, publication = ? WHERE id_produit = ?');
    $reqUpdateImg->execute([$nom_img, $publication, $id_produit]);
}

function insertImg($pdo, $nom_img, $publication, $id_produit){
    $reqInsertImg = $pdo->prepare('INSERT INTO image (nom_img, publication, id_produit) VALUES(?, ?, ?)');
    $reqInsertImg->execute([$nom_img, $publication, $id_produit]);
}
// Vérification des produits enregistrer sur le site \\
function recupListeProduits($pdo){
    $reqProduit = $pdo->prepare('SELECT * FROM produits WHERE deleted = 0');
    $reqProduit->execute();
    $produits = $reqProduit->fetchAll();
    return $produits;
}
function recupProduits($pdo, $id_produit){
    $reqProduit = $pdo->prepare('SELECT * FROM produits WHERE id_produit = ?');
    $reqProduit->execute([$id_produit]);
    $produits = $reqProduit->fetch();
    return $produits;
}
function suprimerProduit($pdo, $id_produit){
    $reqSuppProduit = $pdo->prepare('UPDATE produits SET deleted = 1 WHERE id_produit = ?');
    $reqSuppProduit->execute([$id_produit]);
}

// Récupération de la catégorie des figurines \\

function recupCateg($pdo){
    $reqRecupCateg = $pdo->prepare('SELECT * FROM categorie');
    $reqRecupCateg->execute();
    $recupCateg = $reqRecupCateg->fetchAll();
    return $recupCateg;
}

// Récuperer les images \\
function recupImg($pdo){
    $reqRecupImg = $pdo->prepare('SELECT * FROM image');
    $reqRecupImg->execute();
    $recupImg = $reqRecupImg->fetchAll();
    return $recupImg;
}
// Récupérer l'image d'un seul produit 
function recupImgDuProduit($pdo, $id_produit){
    $reqRecupImgDuProduit = $pdo->prepare('SELECT * FROM image WHERE id_produit = ?');
    $reqRecupImgDuProduit->execute([$id_produit]);
    $recupImgDuProduit = $reqRecupImgDuProduit->fetch();
    return $recupImgDuProduit;
}

// ========================= Fin des  Function Lié a la Gestions des Produits ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des  Function Lié a la Gestions des Utilisateurs ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// Récupérer tout les utilisateur
function recupListeUtilisateur($pdo){
    $reqRecupListeUtilisateur = $pdo->prepare('SELECT * FROM utilisateur WHERE deleted = 0');
    $reqRecupListeUtilisateur->execute();
    $recupListeUtilisateur = $reqRecupListeUtilisateur->fetchAll();
    return $recupListeUtilisateur;
}

function recupUtilisateur($pdo, $id_user){
    $reqRecupUtilisateur = $pdo->prepare('SELECT * FROM utilisateur, role WHERE role.id_role = utilisateur.id_role AND id_user = ?');
    $reqRecupUtilisateur->execute([$id_user]);
    $recupUtilisateur = $reqRecupUtilisateur->fetch();
    return $recupUtilisateur;
}
// Update de l'utilisateur \\
function updateUser($pdo, $nom, $prenom, $mail, $tel, $id_role, $id_user){
    $reqUpdateUser = $pdo->prepare('UPDATE utilisateur SET nom = ?, prenom = ?, mail = ?, tel = ?, id_role = ? WHERE id_user = ?');
    $reqUpdateUser->execute([$nom, $prenom, $mail, $tel, $id_role, $id_user]);
}


// Update Adresse de l'utilisateur \\
function updateAdresseUser($pdo, $adresse, $id_ville, $id_user){
    $reqUpdateAdresseUser = $pdo->prepare('UPDATE adresses SET adresse = ?, id_ville = ? WHERE id_user = ?');
    $reqUpdateAdresseUser->execute([$adresse, $id_ville, $id_user]);
}
// Supprimer l'utilisateur de la bdd
function supprimerUser($pdo, $id_user){
    $reqSupprimerUser = $pdo->prepare('UPDATE utilisateur SET deleted = 1 WHERE id_user = ?');
    $reqSupprimerUser->execute([$id_user]);
}


// Récupération de l'adresse de l'utilisateur 
function recupAdresseUtilisateur($pdo, $id_user){
    $reqRecupAdresseUtilisateur = $pdo->prepare('SELECT * FROM adresses WHERE id_user = ?');
    $reqRecupAdresseUtilisateur->execute([$id_user]);
    $recupAdresseUtilisateur = $reqRecupAdresseUtilisateur->fetch();
    return $recupAdresseUtilisateur;
}
// Récupération de Toutes les information de l'utilsateur
function recupInfoUtilisateur($pdo, $id_user){
    $reqRecupInfoUtilisateur = $pdo->prepare('SELECT * FROM ville, departement, adresses, utilisateur, pays, role WHERE pays.id_pays = departement.id_pays AND departement.id_departement = ville.id_departement AND ville.id_ville = adresses.id_ville AND adresses.id_user = utilisateur.id_user AND role.id_role = utilisateur.id_role AND utilisateur.id_user = ?');
    $reqRecupInfoUtilisateur->execute([$id_user]);
    $recupInfoUtilisateur = $reqRecupInfoUtilisateur->fetch();
    return $recupInfoUtilisateur;
}
// Ajouter un utilisateur :

function verifUserExiste($pdo, $mail){
    $reqUserExiste = $pdo->prepare('SELECT * FROM utilisateur WHERE mail = ?');
    $reqUserExiste->execute([$mail]);
    $userExiste = $reqUserExiste->fetch();
    return $userExiste;
}

// Récupération de Tout les roles
function recupRoles($pdo){
    $reqRecupRoles = $pdo->prepare('SELECT * FROM role');
    $reqRecupRoles->execute();
    $recupRoles = $reqRecupRoles->fetchAll();
    return $recupRoles;
}

// Recuperation des départements \\
function recupDepartement($pdo){
    $reqRecupDepartement = $pdo->prepare("SELECT * FROM departement");
    $reqRecupDepartement->execute();
    $dep = $reqRecupDepartement->fetchall();
    return $dep;
}

// Inseré un utilisateur a la bdd \\
function inserUser($pdo, $nom, $prenom, $mail, $tel){
    $reqInsertUser = $pdo->prepare('INSERT INTO utilisateur(nom, prenom, mail, tel, deleted, id_role) VALUES(?, ?, ?, ?, ?, ?)');
    $reqInsertUser->execute([$nom, $prenom, $mail, $tel, 0, 3]);
}
// Inseré l'adresse de l'utilisateur
function insertAdressUser($pdo, $adresse, $id_ville, $id_user){
    $reqInsertAdressUser = $pdo->prepare('INSERT INTO adresses(adresse, id_ville, id_user) VALUES(?, ?, ?)');
    $reqInsertAdressUser->execute([$adresse, $id_ville, $id_user]);
}


// ========================= Fin des  Function Lié a la Gestions des Utilisateurs ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des  Function Lié au Bons de Réductions ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// Récupère le bon de réduction par sont id \\
function recupBonReductionId($pdo, $id_bon){
    $reqRecupBonReductionId = $pdo->prepare('SELECT * FROM bon_reduction WHERE id_bon = ?');
    $reqRecupBonReductionId->execute([$id_bon]);
    $recupBonReductionId = $reqRecupBonReductionId->fetch();
    return $recupBonReductionId;
}

// Vérification si il y as une réduction existante ou non \\
function reductionExistante($pdo, $date_debut, $date_fin){
    $reqReductionExistante = $pdo->prepare("SELECT * FROM bon_reduction WHERE date_debut <= ? AND date_fin >= ?");
    $reqReductionExistante->execute([$date_debut, $date_fin]);
    $reductionExistante = $reqReductionExistante->fetch();
    
    return $reductionExistante;
}
// Récupère toutes les réduction enregistrer en bdd 
function listeBonreductionExistanteBdd($pdo){
    $reqListeBonReductionExistanteBdd  = $pdo->prepare('SELECT * FROM bon_reduction WHERE deleted = 0');
    $reqListeBonReductionExistanteBdd ->execute();
    $listeBonReductionExistanteBdd = $reqListeBonReductionExistanteBdd->fetchAll();
    return $listeBonReductionExistanteBdd;
}
// Insertion de la réduction à la base de donnée 

function insertReduction($pdo, $nb_articles_min, $taux, $date_debut, $date_fin){
    $reqInsertReduction = $pdo->prepare('INSERT INTO bon_reduction (nb_articles_min, taux, date_debut, date_fin) VALUES(?, ?, ?, ?)');
    $reqInsertReduction->execute([$nb_articles_min, $taux, $date_debut, $date_fin]);
}

// Suppression du bon de reduction  \\ 
function supprimerBonReduction($pdo, $id_bon){
    $reqSupprimerBonReduction = $pdo->prepare('UPDATE bon_reduction SET deleted = 1 WHERE id_bon = ?');
    $reqSupprimerBonReduction->execute([$id_bon]);
}
// Update du bon de Reduction \\
function updateBonReduction($pdo, $nb_articles_min, $taux, $date_debut, $date_fin, $id_bon){
    $reqUpdateBonReduction = $pdo->prepare('UPDATE bon_reduction SET nb_articles_min = ? , taux = ? , date_debut = ? , date_fin = ?  WHERE id_bon = ?');
    $reqUpdateBonReduction->execute([$nb_articles_min, $taux, $date_debut, $date_fin, $id_bon]);
}
// ========================= Fin des  Function Lié au Bons de Réductions ============================ \\

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des Functions lié au Catégories ============================ \\

// Récupération des Catégories \\
function recupCategories($pdo){
    $reqRecupCategories = $pdo->prepare('SELECT * FROM categorie');
    $reqRecupCategories->execute();
    $recupCategories = $reqRecupCategories->fetchAll();
    return $recupCategories;
}
// Verifi si la categorie existe \\
function categExistante($pdo, $nom_categorie){
    $reqCategExistante = $pdo->prepare('SELECT * FROM categorie WHERE nom_categorie = ?');
    $reqCategExistante->execute([$nom_categorie]);
    $categExistante = $reqCategExistante->fetch();
    return $categExistante;
}

// Insert la categorie dans la bdd \\
function insertCateg($pdo, $nom_categorie){
    $reqInsertCateg = $pdo->prepare('INSERT INTO categorie (nom_categorie) VALUES(?)');
    $reqInsertCateg->execute([$nom_categorie]);
}
// ========================= Fin des Functions lié au Catégories ============================ \\


// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des Functions lié au Messages ============================ \\
function recupListeToutMessages($pdo){
    $reqListeToutMessages = $pdo->prepare('SELECT * FROM messages');
    $reqListeToutMessages->execute();
    $recupListeToutMessages = $reqListeToutMessages->fetchAll();
    return $recupListeToutMessages;
}
function recupListeMessages($pdo){
    $reqListeMessages = $pdo->prepare('SELECT * FROM messages WHERE status = "EnAttente"');
    $reqListeMessages->execute();
    $recupListeMessages = $reqListeMessages->fetchAll();
    return $recupListeMessages;
}
function recupInfosMessage($pdo, $id_message){
    $reqRecupInfosMessage = $pdo->prepare('SELECT * FROM messages WHERE id_messages = ?');
    $reqRecupInfosMessage->execute([$id_message]);
    $recupInfosMessage = $reqRecupInfosMessage->fetch();

    return $recupInfosMessage;
}
function recupListeMessagesArchiver($pdo){
    $reqListeMessagesArchiver = $pdo->prepare('SELECT * FROM messages WHERE status = "Archiver"');
    $reqListeMessagesArchiver->execute();
    $recupListeMessagesArchiver = $reqListeMessagesArchiver->fetchAll();
    return $recupListeMessagesArchiver;
}
function recupListeMessagesSupprimer($pdo){
    $reqListeMessagesSupprimer = $pdo->prepare('SELECT * FROM messages WHERE status = "Supprimer"');
    $reqListeMessagesSupprimer->execute();
    $recupListeMessagesSupprimer = $reqListeMessagesSupprimer->fetchAll();
    return $recupListeMessagesSupprimer;
}
function archiverMessage($pdo, $id_message){
    $reqArchiverMessage = $pdo->prepare("UPDATE messages SET status = 'Archiver' WHERE id_messages = ?");
    $reqArchiverMessage->execute([$id_message]);
}
function restaureMessage($pdo, $id_message){
    $reqRestaureMessage = $pdo->prepare("UPDATE messages SET status = 'EnAttente' WHERE id_messages = ?");
    $reqRestaureMessage->execute([$id_message]);
}
function recupListeMessagesRepondu($pdo){
    $reqListeMessagesRepondu = $pdo->prepare('SELECT * FROM messages WHERE status = "Repondu"');
    $reqListeMessagesRepondu->execute();
    $recupListeMessagesRepondu = $reqListeMessagesRepondu->fetchAll();
    return $recupListeMessagesRepondu;
}
function supprimerMessage($pdo, $id_message){
    $reqSupprimerMessage = $pdo->prepare("UPDATE messages SET status = 'Supprimer' WHERE id_messages = ?");
    $reqSupprimerMessage->execute([$id_message]);
}
function supprimerMessageDef($pdo, $id_message){
    $reqSupprimerMessageDef = $pdo->prepare("UPDATE messages SET status = 'SupprimerDef' WHERE id_messages = ?");
    $reqSupprimerMessageDef->execute([$id_message]);
}

// ===================================================================================================== \\
// ===================================================================================================== \\

// ========================= Début des fonctions lié au Formulaire de Contact ============================ \\
function insertMessageEnvoyer($pdo,$nom_envoyeur, $prenom_envoyeur, $mail_envoyeur, $objet_message, $contenue_message, $id_user, $status){
    // echo "INSERT INTO messages($nom_envoyeur, $prenom_envoyeur, $mail_envoyeur, $objet_message, $contenue_message, $id_user, $status) VALUES(?, ?, ?, ?, ?, ?, ?)";
    // die();
    $reqInsertMessageEnvoyer = $pdo->prepare('INSERT INTO messages(nom_envoyeur, prenom_envoyeur, mail_envoyeur, objet_message, contenue_message, id_user, status) VALUES(?, ?, ?, ?, ?, ?, ?)');
    $reqInsertMessageEnvoyer->execute([$nom_envoyeur, $prenom_envoyeur, $mail_envoyeur, $objet_message, $contenue_message, $id_user, $status]);
}
// ========================= Fin des fonctions lié au Formulaire de Contact ============================ \\

// 7.UPTADE INFOS USER MON PROFIL 
function updateInfosUser($pdo, $nomUser, $prenomUser, $emailUser, $dateNaissance, $idUser){
    if(isset($_SESSION['updateAnnv'])){
        $req = "UPDATE utilisateur SET nom_user=?, prenom_user=?, email_user=?, date_naissance=? WHERE id_user = ?";
    }else{
        $req = "UPDATE utilisateur SET nom_user=?, prenom_user=?, email_user=?, date_naissance= null WHERE id_user = ?";
    }
    $reqUpdateInfosUser = $pdo->prepare($req);
    $reqUpdateInfosUser->execute([$nomUser, $prenomUser, $emailUser, $dateNaissance, $idUser]);
}

