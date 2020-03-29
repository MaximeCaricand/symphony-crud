DROP TABLE IF EXISTS gagner;
DROP TABLE IF EXISTS prix;
DROP TABLE IF EXISTS personne;
DROP TABLE IF EXISTS recompense;
DROP TABLE IF EXISTS film;


CREATE TABLE IF NOT EXISTS personne(
       idp INT AUTO_INCREMENT NOT NULL,
       nom_p VARCHAR(20) NOT NULL,
       prenom_p VARCHAR(20) NOT NULL,
       PRIMARY KEY (idp)
);

CREATE TABLE IF NOT EXISTS ceremonie (
       idc INT AUTO_INCREMENT NOT NULL,
       nom_ceremonie VARCHAR(30) NOT NULL,
       PRIMARY KEY (idc)
);

CREATE TABLE IF NOT EXISTS film (
       idf INT AUTO_INCREMENT NOT NULL,
       nom_f VARCHAR(30) NOT NULL,
       date_sortie DATETIME NOT NULL,
       PRIMARY KEY (idf)
);

CREATE TABLE IF NOT EXISTS prix (
       idprix INT AUTO_INCREMENT NOT NULL,
       idc INT NOT NULL REFERENCES ceremonie(idc),
       categorie_prix VARCHAR(30) NOT NULL,
        PRIMARY KEY (idprix)

);

CREATE TABLE IF NOT EXISTS gagner (
       idp INT NOT NULL REFERENCES personne(idp),
       idf INT NOT NULL REFERENCES film(idf),
       idprix INT NOT NULL REFERENCES prix(idprix),
       annee_prix INT NOT NULL ,
       PRIMARY KEY(idp,idf,idprix, annee_prix)
);



insert into ceremonie (nom_ceremonie) values('Oscars');
insert into ceremonie (nom_ceremonie) values('Cesars');

-- Oscars
-- aaaa-mm-jj (mysql), jj-mm-aaaa (postgress et oracle)
insert into film (nom_f,date_sortie) values('Green Book', '2019-01-23');
insert into film (nom_f,date_sortie) values('Roma', '2018-08-30');
insert into film (nom_f,date_sortie) values('Bohemian Rhapsody', '2018-10-31');
insert into film (nom_f,date_sortie) values('La Fovorite' ,'2018-08-30');
insert into film (nom_f,date_sortie) values('Si Belle street Pouvait Parler', '2019-01-30');
insert into film (nom_f,date_sortie) values('BlacKkKlansman', '2018-08-22');
insert into film (nom_f,date_sortie) values('Black Panther', '2018-01-29');
insert into film (nom_f,date_sortie) values('A Star Is Born', '2018-10-03');
insert into film (nom_f,date_sortie) values('Free Solo', '2018-09-28');
insert into film (nom_f,date_sortie) values('Period. End of Sentence', '2019-02-19');
insert into film (nom_f,date_sortie) values('Vice', '2019-02-13');
insert into film (nom_f,date_sortie) values('First Man','2018-10-17');
insert into film (nom_f,date_sortie) values('Spider Man: New Generation','2018-12-12');
insert into film (nom_f,date_sortie) values('Bao','2018-06-15');
insert into film (nom_f,date_sortie) values('Skin','2019-06-25');
-- Cesar
insert into film (nom_f,date_sortie) values('La Vie d Adele, chapitre 1 & 2','2013-10-09');
insert into film (nom_f,date_sortie) values('Suzanne','2013-12-18');
insert into film (nom_f,date_sortie) values('Sur Le Chemin de l Ecole','2013-09-25');


-- Oscars
insert into personne (nom_p, prenom_p) values('NonDef','NonDef');
insert into  personne (nom_p, prenom_p) values('Cuaron','Alfonso');
insert into  personne (nom_p, prenom_p)values('Malek','Rami');
insert into  personne (nom_p, prenom_p)values('Colman','Olivia');
insert into  personne (nom_p, prenom_p)values('Ali','Mahershala');
insert into personne (nom_p, prenom_p) values ('Lady','Gaga');
insert into  personne (nom_p, prenom_p)values('King','Regina');
-- Cesar
insert into personne (nom_p, prenom_p) values('Kechiche','Abdellatif');
insert into personne (nom_p, prenom_p) values('Quillivere','Katell');

ALTER TABLE prix MODIFY categorie_prix varchar(50);
-- Oscar
insert into prix (idc, categorie_prix) values(1,'Meilleur film');
insert into prix (idc, categorie_prix) values(1,'Meilleur realisateur');
insert into prix (idc, categorie_prix) values(1,'Meilleur acteur');
insert into prix (idc, categorie_prix) values(1,'Meilleure actrice');
insert into prix  (idc, categorie_prix)values(1,'Meilleur acteur dans un second role');
insert into prix  (idc, categorie_prix)values(1,'Meilleure actrice dans un second role');
insert into prix  (idc, categorie_prix)values(1,'Meilleur scenario original');
insert into prix (idc, categorie_prix) values(1,'Meilleur scenario adapte');
insert into prix (idc, categorie_prix) values(1,'Meilleure musique de film');
insert into prix (idc, categorie_prix) values(1,'Meilleure chanson originale');
insert into prix (idc, categorie_prix) values(1,'Meilleur film documentaire');
insert into prix (idc, categorie_prix) values(1,'Meilleur court metrage documentaire');
insert into prix (idc, categorie_prix) values(1,'Meilleurs maquillages et coiffures');
insert into prix (idc, categorie_prix) values(1,'Meilleure creation de costumes');
insert into prix (idc, categorie_prix) values(1,'Meilleurs décors');
insert into prix (idc, categorie_prix) values(1,'Meilleure photographie');
insert into prix (idc, categorie_prix) values(1,'Meilleur Montage Son');
insert into prix (idc, categorie_prix) values(1,'Meilleur Mixage Son');
insert into prix (idc, categorie_prix) values(1,'Meilleur film en langue etrangere');
insert into prix (idc, categorie_prix) values(1,'Meilleur Montage');
insert into prix (idc, categorie_prix) values(1,'Meilleurs Effets Visuels');
insert into prix (idc, categorie_prix) values(1,'Meilleur film d animation');
insert into prix (idc, categorie_prix) values(1,'Meilleur court metrage d animation');
insert into prix (idc, categorie_prix) values(1,'Meilleur court metrage de fiction');
-- Cesar
insert into prix (idc, categorie_prix) values(2,'Meilleure actrice dans un second role');
insert into prix (idc, categorie_prix) values(2,'Meilleure espoir feminin');
insert into prix (idc, categorie_prix) values(2,'Meilleur documentaire');


-- Oscar
insert into  gagner (idp,idf,idprix,annee_prix) values(1,1,1,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(2,2,2,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(3,3,3,2019);
insert into  gagner(idp,idf,idprix,annee_prix) values(4,4,4,2019);
insert into  gagner(idp,idf,idprix,annee_prix) values(5,1,5,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(7,5,6,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,1,7,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,6,8,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,7,9,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,8,10,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,9,11,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,10,12,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,11,13,2019);
insert into  gagner(idp,idf,idprix,annee_prix) values(1,7,14,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,7,15,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,2,16,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,3,17,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,3,18,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,2,19,2019);
insert into  gagner(idp,idf,idprix,annee_prix)values(1,3,20,2019);
insert into  gagner(idp,idf,idprix,annee_prix) values(1,12,21,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,13,22,2019);
insert into  gagner (idp,idf,idprix,annee_prix)values(1,14,23,2019);
insert into  gagner(idp,idf,idprix,annee_prix) values(1,15,24,2019);
-- Cesar
insert into gagner (idp, idf, idprix, annee_prix) values (9,17,25,2014);
insert into gagner (idp, idf, idprix, annee_prix) values (8,16,26,2014);
insert into gagner (idp, idf, idprix, annee_prix) values (1,18,27,2014);


DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D6495E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `roles`, `password`) VALUES
(5, 'admin', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$T1pXWHphLndtbHZvdFhVYg$EXnKO1ZswUOMa1oK6l2HLznwfHGgEAE09up7cQYFkaA'),
(6, 'utilisateur', '[]', '$argon2id$v=19$m=65536,t=4,p=1$ejYveWVpS3FyaksycGRuQw$1S8Nsm0aQW1IwL2SV0rV1R8RrwK2bl5V4ZT7iXNA2LQ');
COMMIT;
