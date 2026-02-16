insert into `besoin` (`idCat`, `quantiteDemande`, `nomProduit`, `idVille`) values (1, 10, 'Pommes', 1);
insert into `besoin` (`idCat`, `quantiteDemande`, `nomProduit`, `idVille`) values (2, 5, 'Argent', 2);
insert into `besoin` (`idCat`, `quantiteDemande`, `nomProduit`, `idVille`) values (1, 20, 'Riz', 3);
insert into `besoin` (`idCat`, `quantiteDemande`, `nomProduit`, `idVille`) values (3, 15, 'Tôle', 4);    

insert into `stockDons` (`idCategorie`, `nomProduit`, `quantiteInitiale`, `quantiteFinale`) values (1, 'Pommes', 50, 50);
insert into `stockDons` (`idCategorie`, `nomProduit`, `quantiteInitiale`, `quantiteFinale`) values (2, 'Oranges', 30, 30);
insert into `stockDons` (`idCategorie`, `nomProduit`, `quantiteInitiale`, `quantiteFinale`) values (1, 'Riz', 100, 100);
insert into `stockDons` (`idCategorie`, `nomProduit`, `quantiteInitiale`, `quantiteFinale`) values (3, 'Tôle', 40, 40);

insert into `dons` (`idVille`, `idStock`, `quantiteDonnee`) values (1, 1, 10);
insert into `dons` (`idVille`, `idStock`, `quantiteDonnee`) values (2, 2, 5);
insert into `dons` (`idVille`, `idStock`, `quantiteDonnee`) values (3, 3, 20);
insert into `dons` (`idVille`, `idStock`, `quantiteDonnee`) values (4, 4, 15);

insert into `ville` (`nom`) values ('Antananarivo');
insert into `ville` (`nom`) values ('Toamasina');
insert into `ville` (`nom`) values ('Fianarantsoa');
insert into `ville` (`nom`) values ('Mahajanga');

insert into `categorie` (`nom`) values ('nature');
insert into `categorie` (`nom`) values ('materiaux');
insert into `categorie` (`nom`) values ('argent');