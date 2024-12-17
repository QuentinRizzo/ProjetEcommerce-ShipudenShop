// Bouton ouvrir ou fermer les modales
let btnModalCo = document.getElementById('btnModalCo');
let btnModalInscription = document.getElementById('btnModalInscription');
let masquerModal = [btnModalCo, btnModalInscription];

let modalConnexion = document.getElementById('ModalConnexion');
let modalInscription = document.getElementById('ModalInscription');

let modalFenetre = [modalConnexion, modalInscription];

if (masquerModal !== null) {
    for (let i = 0; i < masquerModal.length; i++) {
        masquerModal[i].addEventListener('click', function () {
            let id = masquerModal[i].id;
            let elt = document.getElementById(id);

            if (elt.classList.contains("btnModalCo")) {
                console.log(modalFenetre);
                modalFenetre.show();
            }
        });
    }
}


// Afficher Cacher le mot de passe \\
let masquer = document.getElementById('co');
let inscription = document.getElementById('coInscription');
let inscriptionConfirm = document.getElementById('coInscriptionConfirm');

// Formulaire Modification Mdp \\
// let modifActuelMdp = document.getElementById('modifActuelMdp');
// let modifChangeMdp = document.getElementById('changeMdp');
// let modifconfirmChangeMdp = document.getElementById('confirmChangeMdp');
let mdpCacher = [masquer, inscription, inscriptionConfirm];
// console.log(mdpCacher);

// Récupération des départements 
let select = document.getElementById('departement');

let ajoutProd = document.getElementById('plusArticle')
// ================================================================= \\
if (masquer !== null && inscription !== null && inscriptionConfirm !== null) {
    for (let i = 0; i < mdpCacher.length; i++) {

        // console.log('in');

        mdpCacher[i].addEventListener('click', function () {

            let id = mdpCacher[i].id + "Password";
            // console.log(id);

            let elt = document.getElementById(id);

            if (elt.type.toLowerCase() == "password") {
                elt.type = "text";
            }
            else {
                elt.type = "password";
            }
        });
    }
}


// ================================================================= \\

// Afficher le formulaire  Modifier  mot de passe \\

// $ = appel de jQuery
$(document).ready(function () {
    // Cacher le formulaire de modification de mot de passe initialement
    $("#form-mdp").hide();

    // Lorsque l'utilisateur clique sur le lien "Modifier mon mot de passe"
    $("#modifierMdp").click(function (e) {
        e.preventDefault(); // Empêche le lien de suivre le lien href

        // On Vérifi si le formulaire est visible ou non 
        if ($("#form-mdp").is(":visible")) {  //is(":visible") est un sélécteur jQuery pour vérifier si le form est visible ou non
            // Si visible on le cache
            $("#form-mdp").hide();
        } else {
            // Sinon on l'affiche
            $("#form-mdp").show();
        }
    });
});

// ================================================================= \\

// On récupère id du select
select.addEventListener('change', selectDept);

function selectDept() {
    let idDept = $('#departement').val(); //on récupère l'id des departement $ veux dire jquery val = valeur des département donc le nom
    $.ajax({
        url: '../controler/ajax.php',
        method: 'POST',
        dataType: 'json',
        data: { idDepartement: idDept, action: 'selectvilledept' },
        success: function (reponse) {
            // console.log(reponse);
            let selectVilles = document.getElementById('ville');
            // console.log(selectVilles);
            for (let i = 0; i < reponse.length; i++) {
                cp = reponse[i].code_postal;
                tabCps = cp.split('-');
                for (let j = 0; j < tabCps.length; j++) {
                    let option = document.createElement('option');
                    option.value = reponse[i].id_ville + '-' + tabCps[j];
                    option.text = reponse[i].nom_ville + ' (' + tabCps[j] + ')';
                    selectVilles.appendChild(option);
                }
            }
        }
    })
}
// ================================================================= \\

// Ajouter ou Retirer des produits au panier Dynamiquement \\
let btnPlus = document.getElementById('plusArticles');
let btnMoins = document.getElementById('moinsArticles');

if (btnPlus !== null && btnMoins !== null) {

    btnPlus.addEventListener('click', function () {
        let qteActuelle = $('#resultatQte').text();
        modifQteProdPanier(this.id);
        // console.log('actuelle', qteActuelle)
        if (qteActuelle == 1) {
            // console.log('iffgcf')
            if (btnMoins.classList.contains('cacher')) {
                // console.log('else')
                btnMoins.classList.remove('cacher');
                btnMoins.classList.add('afficher');
            }
        }
    });

    btnMoins.addEventListener('click', function () {
        let qteActuelle = $('#resultatQte').text();
        modifQteProdPanier(this.id);
        if (qteActuelle == 2) {
            // console.log('if')
            if (btnMoins.classList.contains('afficher')) {
                // console.log('if')
                btnMoins.classList.remove('afficher');
                btnMoins.classList.add('cacher');

            }
        }
    });
}

// Ajouter retirer produit du panier via btn \\

function modifQteProdPanier(action) {
    let id_produit = $('#id_produit').val(); //on récupère l'id des departement $ veux dire jquery val = valeur des département donc le nom
    let qteActuelle = $('#resultatQte').text();

    $.ajax({
        url: '../controler/ajax.php',
        method: 'POST',
        dataType: 'json',
        data: { qteProduit: qteActuelle, id_produit: id_produit, action: action },
        success: function (reponse) {
            console.log('réponse du controller :', reponse);
            console.log('montant panier :', reponse.montantPanier);
            if (action === 'plusArticles') {
                qteActuelle++;
            }
            if (action === 'moinsArticles') {
                qteActuelle--;
            }
            $('#resultatQte').text(qteActuelle);

            if (reponse.montantPanier >= reponse.montantMin) { // Si le nouveaut total dépasse le montant min alors afficher gratuit pour la livraison
                $('#montantTotal').text(reponse.montantPanier);
                $('#fraisLivraison').text('Gratuit');
            } else {
                $('#fraisLivraison').text(reponse.fraisLivr + '€');
                $('#montantTotal').text(parseFloat(reponse.montantPanier) + parseFloat(reponse.fraisLivr) + '€');
            }
        }
    })
}

// Recherche des produits Dynamiquement \\

// ================================================================= \\

// Affichage des filtres de recherche \\
let btnFiltres = document.getElementById('btnFiltre');

if (btnFiltres !== null) {
    btnFiltres.addEventListener('click', function () {
        document.getElementById('filtres').classList.toggle('d-none');
        document.getElementById('recherchenom').classList.toggle('d-none');
    });

}
// Fin de l'affichage des filtres de recherche \\

// ================================================================= \\

//Début Recherche dynamique par nom Partit Ajax \\
let input_rechercher = document.getElementById('input_rechercher');

if (input_rechercher !== null) {
    input_rechercher.addEventListener('keyup', function () {
        console.log(this.value);
        let motCle = this.value;
        rechercherProduit(motCle);
    });
}

function rechercherProduit(motCle) {
    if (motCle == '') {
        document.location.href = "../public/index.php?page=1";
        return;
    }
    $.ajax({
        url: '../controler/ajax.php',
        method: 'POST',
        dataType: 'json',
        data: { motCle: motCle, action: 'searchBar' },

        success: function (reponse) {
            console.log(reponse);
            document.getElementById('AffichageProdFiltrees').innerHTML = reponse;
        }
    })
}
// Fin Recherche dynamique par nom Partit Ajax \\

// ================================================================= \\

// Début Recherche dynamique par prix min et max \\

let btnRechercher = document.getElementById('searchBar');

if (btnRechercher !== null) {
    btnRechercher.addEventListener('click', function () {
        let prixmin = document.getElementById('prixMin').value;
        let prixmax = document.getElementById('prixMax').value;
        rechercherProduitParPrix(prixmin, prixmax);
    });
}

function rechercherProduitParPrix(prixmin, prixmax) {
    if (prixmax != '') {
        if (prixmax < prixmin) {
            alert('Le prix maximum doit être inférieur au prix minimum !');
            return;
        }
    }
    $.ajax({
        url: '../controler/ajax.php',
        method: 'POST',
        dataType: 'json',
        data: { min: prixmin, max: prixmax, action: 'searchByPrice' },

        success: function (reponse) {
            console.log(reponse);
            document.getElementById('AffichageProdFiltrees').innerHTML = reponse;
        }
    })
}
// Fin Recherche dynamique par prix min et max \\

// ================================================================= \\

// Début du tris Par Ordres \\
let trisParOrdres = document.getElementById('trisParOrdres');
if (trisParOrdres !== null) {
    trisParOrdres.addEventListener('change', function () {
        if (trisParOrdres.value === 'ordreCroissant' || trisParOrdres.value === 'ordreDecroissant' || trisParOrdres.value === 'alphabet' || trisParOrdres.value === 'default') {
            document.location.href = "../controler/traitement_tris.php?tris=" + trisParOrdres.value;
        }
    });
}
// Fin du tris Par Ordres \\

// ================================================================= \\

// Début Ajout Favoris \\

let ajoutFavoris = document.getElementById('ajoutfav');
if (ajoutFavoris !== null) {
    ajoutFavoris.addEventListener('click', function () {
        // console.log(ajoutFavoris);
        alert('Vous devais vous connecter pour ajouter le produit au favoris !');
    });
}
// Fin Ajout Favoris \\

// ================================================================= \\

// Début du Système de vôtes \\

const stars = document.querySelectorAll('.star');
stars.forEach(star => {
    star.addEventListener('click', function () {
        let note = this.dataset.note;
        if (note == '1' && this.classList.contains('hover')) {
            note = 0;
        }
        for (let i = 0; i < 5; i++) {
            stars[i].classList.remove('hover');
        }
        for (let j = 0; j < note; j++) {
            stars[j].classList.add('hover');

        }

        document.getElementById('noteclient').value = note;
    });
});
// Fin du Système de vôtes \\

// Début Enregistrement des info de connexion \\

// Fin Enregistrement des info de connexion \\


