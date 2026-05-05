document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementsByClassName("form-services");
    for (let i = 0, l = form.length; i < l; i++){
        if (!form[i]) return;

        form[i].addEventListener("submit", function (e) {
            let valide = true;

            reinitialiserErreurs();

            const services_name = document.getElementsByClassName("services-name").value;
            if (!services_name[i]) {
                afficherErreur("services-name", "Veuillez saisir le nom du service.");
                valide = false;
            }

            const services_categorie = document.getElementById("services-categorie").value;
            if (!services_categorie[i]) {
                afficherErreur("service-categorie", "Veuillez sélectionner la catégorie du service.");
                valide = false;
            }

            const service_duree = document.getElementById("services-duree").value;
            if (!service_duree[i]) {
                afficherErreur("service-duree", "Veuillez saisir la duree du service.");
                valide = false;
            }else {
                if (isNaN(service_duree[i])) {
                    afficherErreur(
                        "service-duree",
                        "Veuillez saisir un chiffre.",
                    );
                    valide = false;
                } else if (!/\b([1-9]|[0-2][0-4])\b/.test(service_duree[i])) {
                    afficherErreur(
                        "service-duree",
                        "Veuillez saisir un chiffre situé entre 1 et 24." +
                            " - " +
                            service_duree[i],
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
    }
});
