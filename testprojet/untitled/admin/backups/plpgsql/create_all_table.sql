CREATE TABLE Etablissement(
                              id_etablissement INTEGER,
                              nom VARCHAR(50) NOT NULL,
                              type VARCHAR(50) NOT NULL,
                              numero VARCHAR(50),
                              rue VARCHAR(50),
                              ville VARCHAR(50),
                              PRIMARY KEY(id_etablissement)
);

CREATE TABLE Details(
                        id_details INTEGER,
                        heures_prestees NUMERIC(15,2),
                        nb_annulation INTEGER,
                        nb_absence INTEGER,
                        type_etablissement VARCHAR(50),
                        PRIMARY KEY(id_details)
);

CREATE TABLE Tutore(
                       id_tutore INTEGER,
                       nom VARCHAR(50),
                       prenom VARCHAR(50),
                       date_naissance DATE,
                       situation_personnel TEXT,
                       details TEXT,
                       classe VARCHAR(25),
                       PRIMARY KEY(id_tutore)
);

CREATE TABLE Creneau_type (
                              id_creneau_type SERIAL PRIMARY KEY,
                              id_etablissement INTEGER NOT NULL REFERENCES Etablissement(id_etablissement) ON DELETE CASCADE,
                              jour TEXT NOT NULL,
                              heure_debut TIME NOT NULL,
                              heure_fin TIME NOT NULL
);

CREATE TABLE Tuteur(
                       id_tuteur SERIAL,
                       nom VARCHAR(50),
                       prenom VARCHAR(50),
                       telephone VARCHAR(50),
                       date_naissance DATE,
                       lieu_naissance VARCHAR(50),
                       pays VARCHAR(50),
                       id_details INTEGER NOT NULL,
                       PRIMARY KEY(id_tuteur),
                       UNIQUE(id_details),
                       FOREIGN KEY(id_details) REFERENCES Details(id_details)
);

CREATE TABLE Cours(
                      id_cours SERIAL,
                      date_cours DATE,
                      heure_debut TIME,
                      heure_fin TIME,
                      id_tuteur INTEGER NOT NULL,
                      id_tutore INTEGER NOT NULL,
                      id_etablissement INTEGER NOT NULL,
                      PRIMARY KEY(id_cours),
                      FOREIGN KEY(id_tuteur) REFERENCES Tuteur(id_tuteur),
                      FOREIGN KEY(id_tutore) REFERENCES Tutore(id_tutore),
                      FOREIGN KEY(id_etablissement) REFERENCES Etablissement(id_etablissement)
);

CREATE TABLE Disponibilite(
                              id_dispo SERIAL,
                              semaine DATE NOT NULL,
                              pas_dispo BOOLEAN NOT NULL DEFAULT FALSE,
                              id_tuteur INTEGER NOT NULL,
                              PRIMARY KEY(id_dispo),
                              FOREIGN KEY(id_tuteur) REFERENCES Tuteur(id_tuteur),
                              UNIQUE(id_tuteur, semaine)

);

CREATE TABLE Creneau_disponibilite(
                                      id_creneau_type INTEGER NOT NULL,
                                      id_dispo INTEGER NOT NULL,
                                      PRIMARY KEY(id_creneau_type, id_dispo),
                                      FOREIGN KEY(id_creneau_type) REFERENCES Creneau_type(id_creneau_type),
                                      FOREIGN KEY(id_dispo) REFERENCES Disponibilite(id_dispo)
);

/* horaire */
CREATE TABLE Horaire_tutore (
                                id_horaire INTEGER NOT NULL,
                                id_tutore INTEGER NOT NULL,
                                PRIMARY KEY(id_horaire, id_tutore),
                                FOREIGN KEY(id_horaire) REFERENCES Horaire(id_horaire) ON DELETE CASCADE,
                                FOREIGN KEY(id_tutore) REFERENCES Tutore(id_tutore)
);
CREATE TABLE Horaire_tuteur (
                                id_horaire INTEGER PRIMARY KEY,
                                id_tuteur INTEGER NOT NULL,
                                FOREIGN KEY(id_horaire) REFERENCES Horaire(id_horaire) ON DELETE CASCADE,
                                FOREIGN KEY(id_tuteur) REFERENCES Tuteur(id_tuteur)
);
CREATE TABLE Horaire (
                         id_horaire SERIAL PRIMARY KEY,
                         id_creneau_type INTEGER NOT NULL,
                         semaine DATE NOT NULL,
                         FOREIGN KEY(id_creneau_type) REFERENCES Creneau_type(id_creneau_type),
                         UNIQUE(id_creneau_type, semaine)
);

CREATE TABLE tutorat_assignation (
                                     id_assignation SERIAL PRIMARY KEY,
                                     id_horaire INTEGER NOT NULL,
                                     id_tutore INTEGER NOT NULL
);

CREATE TABLE admin (
                       id_admin SERIAL PRIMARY KEY,
                       nom_admin VARCHAR(100) NOT NULL,
                       login_admin VARCHAR(50) UNIQUE NOT NULL,
                       password_admin VARCHAR(255) NOT NULL
);
