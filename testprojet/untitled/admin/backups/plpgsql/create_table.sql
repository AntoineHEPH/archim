CREATE TABLE Tuteur(
   id_tuteur SERIAL,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   telephone VARCHAR(50),
   date_naissance DATE,
   lieu_naissance VARCHAR(50),
   pays VARCHAR(50),
   nb_heures_prestees NUMERIC(15,2),
   nb_annulation INTEGER,
   nb_absence INTEGER,
   type_etablissement VARCHAR(50),
   PRIMARY KEY(id_tuteur)
);

CREATE TABLE Disponibilite(
   id_dispo SERIAL,
   week DATE,
   pas_disponible BOOLEAN,
   ge_monday_16h50_18h30 BOOLEAN,
   ge_monday_17h30_18h45 BOOLEAN,
   ge_tuesday_16h50_18h30 BOOLEAN,
   ge_wednesday_14h_16h BOOLEAN,
   ge_thursday_16h50_18h30 BOOLEAN,
   ge_friday_16h50_18h30 BOOLEAN,
   ge_friday_17h30_18h45 BOOLEAN,
   co_monday_16h_17h BOOLEAN,
   co_monday_17h_18h BOOLEAN,
   co_tuesday_16h_17h BOOLEAN,
   co_tuesday_17h_18h BOOLEAN,
   co_thursday_16h_17h BOOLEAN,
   co_thursday_17h_18h BOOLEAN,
   co_friday_16h_17h BOOLEAN,
   ly_monday_16h_17h BOOLEAN,
   ly_monday_17h_18h BOOLEAN,
   ly_tuesday_16h_17h BOOLEAN,
   ly_tuesday_17h_18h BOOLEAN,
   ly_thursday_16h_17h BOOLEAN,
   ly_thursday_17h_18h BOOLEAN,
   ly_friday_16h_17h BOOLEAN,
   ly_friday_17h_18h BOOLEAN,
   PRIMARY KEY(id_dispo)
);

CREATE TABLE Tutore(
   id_tutore SERIAL,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   age INTEGER,
   situation_perso TEXT,
   details_important TEXT,
   classe VARCHAR(50),
   PRIMARY KEY(id_tutore)
);

CREATE TABLE Etablissement(
   id_etablissement SERIAL,
   nom VARCHAR(50),
   type VARCHAR(50),
   adresse VARCHAR(50),
   id_tutore INTEGER NOT NULL,
   id_tuteur INTEGER,
   PRIMARY KEY(id_etablissement),
   FOREIGN KEY(id_tutore) REFERENCES Tutore(id_tutore),
   FOREIGN KEY(id_tuteur) REFERENCES Tuteur(id_tuteur)
);

CREATE TABLE tuteur_dispo(
   id_tuteur INTEGER,
   id_dispo INTEGER,
   PRIMARY KEY(id_tuteur, id_dispo),
   FOREIGN KEY(id_tuteur) REFERENCES Tuteur(id_tuteur),
   FOREIGN KEY(id_dispo) REFERENCES Disponibilite(id_dispo)
);
