drop database if exists fiches;

create database if not EXISTS fiches;
use fiches;

CREATE TABLE IF NOT EXISTS categorie (
  `idCategorie` int NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idCategorie`)
);

INSERT INTO categorie (`idCategorie`, `nomCategorie`) VALUES
(1, 'Consommable'),
(2, 'Equipements'),
(3, 'Communication'),
(4, 'Entretien'),
(5, 'Autres');

CREATE TABLE IF NOT EXISTS direction (
  idDirection int NOT NULL AUTO_INCREMENT,
  nomDirection varchar(50) DEFAULT NULL,
  sigleDirection varchar(5) DEFAULT NULL,
  PRIMARY KEY (idDirection)
);

INSERT INTO `direction` (`idDirection`, `nomDirection`, `sigleDirection`) VALUES
(1, "Direction informatique", 'DI'),
(2, "Direction des ressources humaines", 'DRH'),
(3, "Direction des opérations", 'DO'),
(4, "Direction Finances Comptabilité", 'DFC'),
(5, "Direction générale", 'DG');

Create table Fiche(
    idFiche int(4) auto_increment primary key,
    dateFiche date,
    idDirection int(4),
    idUser int(4),
    commentaire varchar(250),
    dga varchar(25),
    destination varchar(50),
    dateModif date,
    demandeModif varchar (30),
    auteurRejet varchar (30),
    etat varchar(15),
    v1 boolean,
    v2 boolean,
    v3 boolean,
    dm1 boolean,
    dm2 boolean,
    dm3 boolean,
    r1 boolean,
    r2 boolean,
    r3 boolean,
    sign1 varchar(30) DEFAULT NULL,
    sign2 varchar(30) DEFAULT NULL,
    sign3 varchar(30) DEFAULT NULL,
    remarque varchar(30) DEFAULT NULL,
    dateValidation date default null,
    motifAbandon varchar(150) default null,
    dateAbandon date default null,
    signAbandon varchar(30),
    auteurModif varchar(30),
    firstPrint boolean 
);


CREATE TABLE IF NOT EXISTS `ficheproduit` (
  `idFicheProduit` int NOT NULL AUTO_INCREMENT,
  `idFiche` int DEFAULT NULL,
  `idProduit` int DEFAULT NULL,
  PRIMARY KEY (`idFicheProduit`),
  KEY `idFiche` (`idFiche`),
  KEY `idProduit` (`idProduit`)
);


CREATE TABLE IF NOT EXISTS `produit` (
  `idProduit` int NOT NULL AUTO_INCREMENT,
  `nomProduit` varchar(250) DEFAULT NULL,
  `quantite` int DEFAULT NULL,
  `idCategorie` int DEFAULT NULL,
  `idFiche` int DEFAULT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `idFiche` (`idFiche`),
  KEY `idCategorie` (`idCategorie`),
  satisfaction boolean
);


CREATE TABLE IF NOT EXISTS `role` (
  `idRole` int NOT NULL AUTO_INCREMENT,
  `nomRole` varchar(15) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idRole`)
);


INSERT INTO `role` (`idRole`, `nomRole`, `description`) VALUES
(1, 'Admin', 'Administrateur système'),
(2, 'Controleur', 'Controlleur des fiches'),
(3, 'Utilisateur', 'Utilisateur ou editeur de'),
(4, 'Chef de service', 'Chef de service signataire'),
(5, 'DGAT', 'Directeur général adjoint'),
(6, 'DGAO', 'Directeur général adjoint'),
(7, 'DG', 'Directeur général');


CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `matricule` varchar(10) DEFAULT NULL,
  `nomUser` varchar(20) DEFAULT NULL,
  `prenomUser` varchar(20) DEFAULT NULL,
  `loginUser` varchar(20) DEFAULT NULL,
  `passwordUser` varchar(20) DEFAULT NULL,
  `idDirection` int DEFAULT NULL,
  `idRole` int DEFAULT NULL,
  email varchar(30),
  firstConnexion boolean,
  PRIMARY KEY (`idUser`),
  KEY `idDirection` (`idDirection`),
  KEY `idRole` (`idRole`)
);


INSERT INTO `user` ( `matricule`, `nomUser`, `prenomUser`, `loginUser`, `passwordUser`, `idDirection`, `idRole`, email, firstConnexion) VALUES
('001', 'doumbia', 'mohamed', 'admin', 'admin', 1, 1, "mohamedivand@gmail.com", true);


INSERT INTO `user` (`loginUser`, `passwordUser`, `idDirection`, `idRole`, email, firstConnexion) VALUES
('chefdi', 'admin', 1, 4, "mohamedivand@gmail.com", true);
INSERT INTO `user` (`loginUser`, `passwordUser`, `idDirection`, `idRole`, email, firstConnexion) VALUES
('chefdo', 'admin', 3, 4, "mohamedivand@gmail.com", true);
INSERT INTO `user` (`loginUser`, `passwordUser`, `idDirection`, `idRole`, email, firstConnexion) VALUES
('dgao', 'admin', 5, 6, "mohamedivand@gmail.com", true);
INSERT INTO `user` (`loginUser`, `passwordUser`, `idDirection`, `idRole`, email, firstConnexion) VALUES
('dgat', 'admin', 5, 5, "mohamedivand@gmail.com", true);
INSERT INTO `user` (`loginUser`, `passwordUser`, `idDirection`, `idRole`, email, firstConnexion) VALUES
('dg', 'admin', 5, 7, "mohamedivand@gmail.com", true);
INSERT INTO `user` (`loginUser`, `passwordUser`, `idDirection`, `idRole`, email, firstConnexion) VALUES
('chefdrh', 'admin', 2, 4, "mohamedivand@gmail.com", true);
INSERT INTO `user` (`loginUser`, `passwordUser`, `idDirection`, `idRole`, email, firstConnexion) VALUES
('userdrh', 'admin', 2, 2, "mohamedivand@gmail.com", true);
INSERT INTO `user` (`loginUser`, `passwordUser`, `idDirection`, `idRole`, email, firstConnexion) VALUES
('userdo', 'admin', 2, 3, "mohamedivand@gmail.com", true);
COMMIT;
