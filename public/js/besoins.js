document.getElementById("actualiser").addEventListener("click", function () {

    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let data = JSON.parse(xhr.responseText);
            showBesoins(data);
        }
    };

    xhr.open("GET", "/recapitulation/actualiser", true);
    xhr.send();
});

function showBesoins(tabBesoins) {

    let divMere = document.getElementById("besoins");
    let totalMontantElt = document.getElementById("totalMontant");

    divMere.textContent = "";
    let totalMontant = 0;

    if (tabBesoins.length === 0) {
        let p = document.createElement("p");
        p.textContent = "Aucun besoin disponible.";
        divMere.appendChild(p);
        totalMontantElt.textContent = "";
        return;
    }

    for (let i = 0; i < tabBesoins.length; i++) {

        let besoin = tabBesoins[i];

        // Calcul du total
        if (besoin.nomProduit === "Argent") {
            totalMontant += parseFloat(besoin.quantiteDemandee);
        } else {
            totalMontant += parseFloat(besoin.quantiteDemandee) * parseFloat(besoin.prixUnitaire);
        }

        // === CARD ===
        let card = document.createElement("div");
        card.setAttribute("class", "card mb-3");

        let cardBody = document.createElement("div");
        cardBody.setAttribute("class", "card-body");

        let titre = document.createElement("h5");
        titre.setAttribute("class", "card-title");
        titre.textContent = besoin.nomProduit;

        let ville = document.createElement("p");
        ville.setAttribute("class", "card-text");
        ville.textContent = "Ville : " + besoin.nomVille;

        let quantite = document.createElement("p");
        quantite.setAttribute("class", "card-text");
        quantite.textContent = "Quantité : " + besoin.quantiteDemandee;

        // Assemblage
        cardBody.appendChild(titre);
        cardBody.appendChild(ville);
        cardBody.appendChild(quantite);

        card.appendChild(cardBody);
        divMere.appendChild(card);
    }

    totalMontantElt.textContent = "Total des besoins : " + totalMontant;
    totalMontantElt.setAttribute("class", "alert alert-success");
}