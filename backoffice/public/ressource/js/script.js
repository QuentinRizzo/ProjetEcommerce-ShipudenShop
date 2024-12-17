// Récupération des départements 
let select = document.getElementById('departement');

if (select !== null) {
    select.addEventListener('change', selectDept);
}

function selectDept() {
    let idDept = $('#departement').val(); //on récupère l'id des departement $ veux dire jquery val = valeur des département donc le nom
    $.ajax({
        url: '../../controler/ajax.php',
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