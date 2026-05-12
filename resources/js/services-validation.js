document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form-services");
    //for (let i = 0, l = form.length; i < l; i++){
        if (!form) return;

        form.addEventListener("submit", function (e) {
            let valide = true;
            reinitialiserErreurs();

            const services_name = document.getElementById("service_name").value;
            if (!services_name) {
                afficherErreur("service_name", "Veuillez saisir le nom du service");
                valide = false;
            }
            else{
                if(services_name.length > 255){
                    afficherErreur("service_description", "Le nom ne peut pas dépasser 255 caractères");
                    valide = false;
                }
            }

            const services_categorie = document.getElementById("service_categorie").value;
            if (!services_categorie) {
                afficherErreur("service_categorie", "Veuillez sélectionner la catégorie du service");
                valide = false;
            }

            const service_duree = document.getElementById("service_duree").value;
            if (!service_duree) {
                afficherErreur("service_duree", "Veuillez saisir la duree du service");
                valide = false;
            }else {
                if (isNaN(service_duree)) {
                    afficherErreur(
                        "service_duree",
                        "La durée doit être un chiffre",
                    );
                    valide = false;
                } else if (!/\b^([1-9]|[0-2][0-4])\b/.test(service_duree)) {

                    afficherErreur(
                        "service_duree",
                        "La durée doit se situer entre 1 et 24",
                    );
                    valide = false;
                }
            }

            const service_description = document.getElementById("service_description").value;
            if (service_description) {
                if(service_description.length > 255){
                    afficherErreur("service_description", "La description ne peut pas dépasser 255 caractères");
                    valide = false;
                }
            }

            if (!valide) {
                e.preventDefault();
                console.log("ERROR");
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
