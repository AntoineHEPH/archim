CREATE OR REPLACE FUNCTION get_tuteur_by_id(p_id_tuteur INTEGER)
RETURNS TABLE (
    id_tuteur INTEGER,
    nom VARCHAR,
    prenom VARCHAR,
    telephone VARCHAR,
    date_naissance DATE,
    lieu_naissance VARCHAR,
    pays VARCHAR,
    login VARCHAR,
    mot_de_passe TEXT,
    id_details INTEGER,
    heures_prestees NUMERIC,
    nb_annulation INTEGER,
    nb_absence INTEGER,
    type_etablissement VARCHAR
) AS
'
BEGIN
    RETURN QUERY
    SELECT t.id_tuteur, t.nom, t.prenom, t.telephone, t.date_naissance, t.lieu_naissance, t.pays,
           t.login, t.mot_de_passe,
           d.id_details, d.heures_prestees, d.nb_annulation, d.nb_absence, d.type_etablissement
    FROM Tuteur t
    JOIN Details d ON t.id_details = d.id_details
    WHERE t.id_tuteur = p_id_tuteur;
END;
'
LANGUAGE 'plpgsql';
