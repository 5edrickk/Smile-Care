document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('form-paiement');

    if (!form) return;

    form.addEventListener('submit', function (e) {

        let valide = true;

        reinitialiserErreurs();

        const montant = document.getElementById('montant').value.trim();
        if (!/^\d+(\.\d{1,2})?$/.test(montant)) {
            afficherErreur('montant', 'Le montant doit être un nombre valide (ex: 99.99).');
            valide = false;
        } else if (parseFloat(montant) <= 0) {
            afficherErreur('montant', 'Le montant doit être supérieur à 0.');
            valide = false;
        }


        const rdv = document.getElementById('id_rendez_vous').value;
        if (!rdv) {
            afficherErreur('id_rendez_vous', 'Veuillez sélectionner un rendez-vous.');
            valide = false;
        }


        const type = document.getElementById('id_type').value;
        if (!type) {
            afficherErreur('id_type', 'Veuillez sélectionner un type de paiement.');
            valide = false;
        }


        const etat = document.getElementById('id_etat').value;
        if (!etat) {
            afficherErreur('id_etat', 'Veuillez sélectionner un état.');
            valide = false;
        }

        if (!valide) {
            e.preventDefault();
        }
    });

    function afficherErreur(champId, message) {
        const errDiv = document.getElementById('erreur-' + champId);
        if (errDiv) {
            errDiv.textContent = message;
            errDiv.classList.remove('hidden');
        }
    }

    function reinitialiserErreurs() {
        document.querySelectorAll('[id^="erreur-"]').forEach(function (el) {
            el.textContent = '';
            el.classList.add('hidden');
        });
    }

});
