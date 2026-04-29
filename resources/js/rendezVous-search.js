function rechercherRendezVous() {
    const query = document.getElementById("search-input").value.trim();

    if (query === "") {
        reinitialiserRecherche();
        return;
    }

    const container = document.getElementById("tbody-rendez-vous");

    container.innerHTML = `
        <div class="rounded-lg border border-gray-200 bg-white px-4 py-6 text-center text-sm text-gray-400">
            Recherche en cours...
        </div>
    `;

    fetch(`/rendezvous/search?query=${encodeURIComponent(query)}`, {
        method: "GET",
        headers: {
            Accept: "application/json",
            "X-Requested-With": "XMLHttpRequest",
        },
    })
        .then(function (response) {
            if (!response.ok) {
                throw new Error("Erreur serveur : " + response.status);
            }
            return response.json();
        })
        .then(function (rendezVous) {
            afficherResultats(rendezVous);
        })
        .catch(function (erreur) {
            container.innerHTML = `
                <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-6 text-center text-sm text-red-600">
                    Une erreur est survenue : ${erreur.message}
                </div>
            `;
        });
}

function afficherResultats(rendezVous) {
    const container = document.getElementById("tbody-rendez-vous");

    if (rendezVous.length === 0) {
        container.innerHTML = `
            <div class="text-center text-gray-500">
                Aucun rendez-vous trouvé.
            </div>
        `;
        return;
    }

    container.innerHTML = rendezVous
        .map(function (r) {
            const dt = r.heure_date ? new Date(r.heure_date) : null;
            const dateLabel =
                dt && !Number.isNaN(dt.getTime())
                    ? dt.toLocaleDateString()
                    : (r.heure_date ?? "");
            const timeLabel =
                dt && !Number.isNaN(dt.getTime())
                    ? dt.toLocaleTimeString([], {
                          hour: "2-digit",
                          minute: "2-digit",
                      })
                    : "";

            return `
                <div class="overflow-hidden rounded-lg shadow-md">
                    <a href="/rendezvous/${encodeURIComponent(r.id)}">
                        <div class="bg-cyan-500 px-4 py-2 text-white">
                            <p class="font-semibold">${dateLabel}</p>
                            <p class="text-sm">${timeLabel}</p>
                        </div>

                        <div class="flex items-center gap-4 bg-white px-4 py-4">
                            <div class="flex h-14 w-14 shrink-0 items-end justify-center overflow-hidden rounded-full bg-gray-300"></div>
                            <div>
                                <p class="font-semibold text-gray-800">${r.user ?? ""}</p>
                                <p class="text-sm text-gray-500">Dentiste : ${r.dentiste ?? ""}</p>
                                <p class="text-sm text-gray-900">Traitement : ${r.service ?? ""}</p>
                            </div>
                        </div>
                    </a>
                </div>
            `;
        })
        .join("");
}

function reinitialiserRecherche() {
    document.getElementById("search-input").value = "";
    window.location.reload();
}

document.addEventListener("DOMContentLoaded", function () {
    const btnRechercher = document.getElementById("btn-rechercher");
    const btnReinitialiser = document.getElementById("btn-reinitialiser");
    const input = document.getElementById("search-input");

    if (btnRechercher) {
        btnRechercher.addEventListener("click", rechercherRendezVous);
    }

    if (btnReinitialiser) {
        btnReinitialiser.addEventListener("click", reinitialiserRecherche);
    }

    if (input) {
        input.addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                rechercherRendezVous();
            }
        });
    }
});
