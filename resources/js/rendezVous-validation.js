document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form-rendez-vous");

    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valide = true;

        reinitialiserErreurs();

        const id_dentiste = document.getElementById("id_dentiste").value;
        if (!id_dentiste) {
            afficherErreur("id_dentiste", "Veuillez sélectionner un dentiste.");
            valide = false;
        }

        const id_etat = document.getElementById("id_etat").value;
        if (!id_etat) {
            afficherErreur(
                "id_etat",
                "Veuillez sélectionner l'état du rendez-vous.",
            );
            valide = false;
        }

        const id_service = document.getElementById("id_service").value;
        if (!id_service) {
            afficherErreur("id_service", "Veuillez sélectionner un service.");
            valide = false;
        }

        const heure_date = document.getElementById("heure_date").value;
        if (!heure_date) {
            afficherErreur(
                "heure_date",
                "Veuillez sélectionner une date et une heure.",
            );
            valide = false;
        } else {
            const dateRdv = new Date(heure_date);
            if (isNaN(dateRdv.getTime())) {
                afficherErreur(
                    "heure_date",
                    "Veuillez sélectionner une date et une heure valide.",
                );
                valide = false;
            } else if (dateRdv < new Date()) {
                afficherErreur(
                    "heure_date",
                    "Veuillez sélectionner une date et une heure dans le futur.",
                );
                valide = false;
            } else if (!/^\d{4}-\d{2}-\d{2}*\d{2}:\d{2}$/.test(heure_date)) {
                afficherErreur(
                    "heure_date",
                    "Veuillez sélectionner une date et une heure au format JJ-MM-AAAA HH:MM." +
                        " - " +
                        heure_date,
                );
                valide = false;
            }
        }

        if (!valide) {
            e.preventDefault();
        }
    });

    function afficherErreur(champId, message) {
        const errDiv = document.getElementById("erreur-" + champId);
        if (errDiv) {
            errDiv.textContent = message;
            errDiv.classList.remove("hidden");
        }
    }

    function reinitialiserErreurs() {
        document.querySelectorAll('[id^="erreur-"]').forEach(function (el) {
            el.textContent = "";
            el.classList.add("hidden");
        });
    }
});
