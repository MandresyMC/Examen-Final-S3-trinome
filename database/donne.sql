insert into `categorie` (`nom`) values ('nature');
insert into `categorie` (`nom`) values ('materiaux');
insert into `categorie` (`nom`) values ('argent');

insert into `ville` (`nom`, `fond`) values ('Antananarivo', 100000);
insert into `ville` (`nom`, `fond`) values ('Toamasina', 60000);
insert into `ville` (`nom`, `fond`) values ('Fianarantsoa', 45000);
insert into `ville` (`nom`, `fond`) values ('Mahajanga', 50000);

insert into `produit` (`nom`, `idCategorie`, `prixUnitaire`) values ('Pommes', 1, 2.5);
insert into `produit` (`nom`, `idCategorie`, `prixUnitaire`) values ('Oranges', 1, 2.0);
insert into `produit` (`nom`, `idCategorie`, `prixUnitaire`) values ('Riz', 1, 1.2);
insert into `produit` (`nom`, `idCategorie`, `prixUnitaire`) values ('Tôle', 2, 25.0);
insert into `produit` (`nom`, `idCategorie`, `prixUnitaire`) values ('Argent', 3, null);

insert into `besoin` (`idCategorie`, `idVille`, `idProduit`, `quantiteDemandee`) values (1, 1, 1, 10);
insert into `besoin` (`idCategorie`, `idVille`, `idProduit`, `quantiteDemandee`) values (1, 2, 2, 5);
insert into `besoin` (`idCategorie`, `idVille`, `idProduit`, `quantiteDemandee`) values (1, 3, 3, 20);
insert into `besoin` (`idCategorie`, `idVille`, `idProduit`, `quantiteDemandee`) values (3, 4, 4, 15);

insert into `stockDons` (`idCategorie`, `idProduit`, `quantiteInitiale`, `quantiteFinale`) values (1, 1, 50, 50);
insert into `stockDons` (`idCategorie`, `idProduit`, `quantiteInitiale`, `quantiteFinale`) values (1, 2, 30, 30);
insert into `stockDons` (`idCategorie`, `idProduit`, `quantiteInitiale`, `quantiteFinale`) values (1, 3, 100, 100);
insert into `stockDons` (`idCategorie`, `idProduit`, `quantiteInitiale`, `quantiteFinale`) values (2, 4, 40, 40);
insert into `stockDons` (`idCategorie`, `idProduit`, `quantiteInitiale`, `quantiteFinale`) values (3, 5, 200000, 200000);
insert into `dons` (`idVille`, `idStock`, `quantiteDonnee`) values (1, 1, 5);
insert into `dons` (`idVille`, `idStock`, `quantiteDonnee`) values (2, 2, 3);

insert into `achat` (`idVille`, `idStock`, `idDon`) values (1, 1, 1);