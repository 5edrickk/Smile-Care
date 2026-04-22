function rechercherPaiements() {
    const query = document.getElementById('search-input').value.trim();

    if (query === '') {
        reinitialiserRecherche();
        return;
    }

    const tbody = document.getElementById('tbody-paiements');

    tbody.innerHTML = `
        <tr>
            <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-400">
                Recherche en cours...
            </td>
        </tr>
    `;

    fetch(`/paiements/search?query=${encodeURIComponent(query)}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(function (response) {
        if (!response.ok) {
            throw new Error('Erreur serveur : ' + response.status);
        }
        return response.json();
    })
    .then(function (paiements) {
        afficherResultats(paiements);
    })
    .catch(function (erreur) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6"
                    class="px-6 py-8 text-center text-sm text-red-500">
                    Une erreur est survenue : ${erreur.message}
                </td>
            </tr>
        `;
    });
}

function afficherResultats(paiements) {
    const tbody = document.getElementById('tbody-paiements');

    if (paiements.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6"
                    class="px-6 py-8 text-center text-sm text-gray-500">
                    Aucun paiement trouvé.
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = paiements.map(function (p) {
        return `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-500">${p.id}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                    ${parseFloat(p.montant).toFixed(2)} $
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">${p.type}</td>
                <td class="px-6 py-4 text-sm">
                    <span class="px-2 py-1 rounded-full text-xs font-medium
                        ${p.etat === 'Payé'
                            ? 'bg-green-100 text-green-800'
                            : 'bg-yellow-100 text-yellow-800'}">
                        ${p.etat}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">#${p.rdv}</td>
                <td class="px-6 py-4 text-sm font-medium">
                    <div class="flex gap-3">
                        <a href="/paiements/${p.id}"
                           class="text-indigo-600 hover:text-indigo-900">
                            Voir
                        </a>
                        <a href="/paiements/${p.id}/edit"
                           class="text-amber-600 hover:text-amber-900">
                            Modifier
                        </a>
                    </div>
                </td>
            </tr>
        `;
    }).join('');
}

function reinitialiserRecherche() {
    document.getElementById('search-input').value = '';
    window.location.reload();
}

document.addEventListener('DOMContentLoaded', function () {
    const btnRechercher    = document.getElementById('btn-rechercher');
    const btnReinitialiser = document.getElementById('btn-reinitialiser');
    const input            = document.getElementById('search-input');

    if (btnRechercher) {
        btnRechercher.addEventListener('click', rechercherPaiements);
    }

    if (btnReinitialiser) {
        btnReinitialiser.addEventListener('click', reinitialiserRecherche);
    }

    if (input) {
        input.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                rechercherPaiements();
            }
        });
    }
});
