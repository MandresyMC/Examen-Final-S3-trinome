let totalBesoins = 0;
let totalDons = 0;

document.getElementById("actualiser").addEventListener("click", function () {
    loadData();
});

function loadData() {
    // showLoading();
    
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            // hideLoading();
            
            if (xhr.status === 200) {
                try {
                    let data = JSON.parse(xhr.responseText);
                    showBesoins(data["besoins"]);
                    showDons(data["dons"]);
                } catch (e) {
                    console.error("Erreur de parsing JSON:", e);
                    showError("Erreur lors du chargement des données");
                }
            } else {
                showError("Erreur de connexion au serveur");
            }
        }
    };

    xhr.open("GET", "/recapitulation/actualiser", true);
    xhr.send();
}

function showBesoins(tabBesoins) {
    let divMere = document.getElementById("besoins");
    let totalMontantElt = document.getElementById("totalMontant");
    let countElt = document.getElementById("besoins-count");

    divMere.textContent = "";
    totalBesoins = 0;

    countElt.textContent = tabBesoins.length;

    if (tabBesoins.length === 0) {
        divMere.innerHTML = `
            <div class="empty-state">
                <div class="empty-state-icon">—</div>
                <p>Aucun besoin enregistré</p>
            </div>
        `;
        totalMontantElt.textContent = "0 Ar";
        return;
    }

    for (let i = 0; i < tabBesoins.length; i++) {
        let besoin = tabBesoins[i];

        // Calcul du total
        if (besoin.nomProduit === "Argent") {
            totalBesoins += parseFloat(besoin.quantiteDemandee);
        } else {
            totalBesoins += parseFloat(besoin.quantiteDemandee) * parseFloat(besoin.prixUnitaire);
        }

        // Création de la card
        let card = createCard(besoin, 'besoin');
        divMere.appendChild(card);
    }

    totalMontantElt.textContent = formatMontant(totalBesoins);
}

function showDons(tabDons) {
    let divMere = document.getElementById("dons");
    let totalMontantElt = document.getElementById("totalMontantDons");
    let countElt = document.getElementById("dons-count");

    divMere.textContent = "";
    totalDons = 0;

    countElt.textContent = tabDons.length;

    if (tabDons.length === 0) {
        divMere.innerHTML = `
            <div class="empty-state">
                <div class="empty-state-icon">—</div>
                <p>Aucun don enregistré</p>
            </div>
        `;
        totalMontantElt.textContent = "0 Ar";
        return;
    }

    for (let i = 0; i < tabDons.length; i++) {
        let don = tabDons[i];

        // Calcul du total
        if (don.nomProduit === "Argent") {
            totalDons += parseFloat(don.quantiteDonnee);
        } else {
            totalDons += parseFloat(don.quantiteDonnee) * parseFloat(don.prixUnitaire);
        }

        // Création de la card
        let card = createCard(don, 'don');
        divMere.appendChild(card);
    }

    totalMontantElt.textContent = formatMontant(totalDons);
}

function createCard(item, type) {
    let card = document.createElement("div");
    card.setAttribute("class", "card");

    let cardBody = document.createElement("div");
    cardBody.setAttribute("class", "card-body");

    // Titre
    let titre = document.createElement("h5");
    titre.setAttribute("class", "card-title");
    titre.textContent = item.nomProduit;
    cardBody.appendChild(titre);

    // Ville
    let ville = document.createElement("p");
    ville.setAttribute("class", "card-text");
    ville.innerHTML = `<strong>Ville</strong><span class="card-text-value">${item.nomVille}</span>`;
    cardBody.appendChild(ville);

    // Quantité
    let quantite = document.createElement("p");
    quantite.setAttribute("class", "card-text");
    let quantiteLabel = type === 'besoin' ? 'Quantité demandée' : 'Quantité donnée';
    let quantiteValue = type === 'besoin' ? item.quantiteDemandee : item.quantiteDonnee;
    quantite.innerHTML = `<strong>${quantiteLabel}</strong><span class="card-text-value">${quantiteValue}</span>`;
    cardBody.appendChild(quantite);

    // Afficher le prix si ce n'est pas de l'argent
    if (item.nomProduit !== "Argent") {
        let prix = document.createElement("p");
        prix.setAttribute("class", "card-text");
        prix.innerHTML = `<strong>Prix unitaire</strong><span class="card-text-value">${formatMontant(item.prixUnitaire)}</span>`;
        cardBody.appendChild(prix);
        
        let total = document.createElement("p");
        total.setAttribute("class", "card-text");
        let montantTotal = type === 'besoin' 
            ? item.quantiteDemandee * item.prixUnitaire 
            : item.quantiteDonnee * item.prixUnitaire;
        total.innerHTML = `<strong>Montant total</strong><span class="card-text-value highlight-amount">${formatMontant(montantTotal)}</span>`;
        cardBody.appendChild(total);
    }

    card.appendChild(cardBody);
    return card;
}

function formatMontant(montant) {
    return new Intl.NumberFormat('fr-FR', {
        style: 'decimal',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(montant) + " Ar";
}

// function showLoading() {
//     document.getElementById("loading").classList.add("active");
// }

// function hideLoading() {
//     document.getElementById("loading").classList.remove("active");
// }

function showError(message) {
    console.error(message);
    alert(message);
}