insert into `besoin` (`idCat`, `quantiteDemande`, `nomProduit`, `idVille`) values (1, 10, 'Pommes', 1);
insert into `besoin` (`idCat`, `quantiteDemande`, `nomProduit`, `idVille`) values (2, 5, 'Argent', 2);
insert into `besoin` (`idCat`, `quantiteDemande`, `nomProduit`, `idVille`) values (1, 20, 'Riz', 3);
insert into `besoin` (`idCat`, `quantiteDemande`, `nomProduit`, `idVille`) values (3, 15, 'Tôle', 4);    

insert into `stockDons` (`idCategorie`, `nomProduit`, `quantiteInitiale`, `quantiteFinale`) values (1, 'Pommes', 50, 50);
insert into `stockDons` (`idCategorie`, `nomProduit`, `quantiteInitiale`, `quantiteFinale`) values (2, 'Oranges', 30, 30);
insert into `stockDons` (`idCategorie`, `nomProduit`, `quantiteInitiale`, `quantiteFinale`) values (1, 'Riz', 100, 100);
insert into `stockDons` (`idCategorie`, `nomProduit`, `quantiteInitiale`, `quantiteFinale`) values (3, 'Tôle', 40, 40);

insert into `ville` (`nom`,) values ('Antananarivo');
insert into `ville` (`nom`,) values ('Toamasina');
insert into `ville` (`nom`,) values ('Fianarantsoa');
insert into `ville` (`nom`,) values ('Mahajanga');

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


INSERT INTO achat (idVille, idStock, quantite, prix)
VALUES (1, 3, 10, 2500);

INSERT INTO commission (pourcentage) VALUES (10.0);








