CREATE OR REPLACE FUNCTION ajout_creneau_type(text, time, time, int) RETURNS integer AS
'
DECLARE
    p_jour ALIAS FOR $1;
    p_heure_debut ALIAS FOR $2;
    p_heure_fin ALIAS FOR $3;
    p_id_etablissement ALIAS FOR $4;
    retour INTEGER;
BEGIN
    INSERT INTO Creneau_type (jour, heure_debut, heure_fin, id_etablissement)
    VALUES (p_jour, p_heure_debut, p_heure_fin, p_id_etablissement)
    ON CONFLICT DO NOTHING;

    SELECT INTO retour id_creneau_type FROM Creneau_type
    WHERE jour = p_jour AND heure_debut = p_heure_debut AND heure_fin = p_heure_fin AND id_etablissement = p_id_etablissement;

    IF retour IS NULL THEN
        RETURN -1;
    ELSE
        RETURN retour;
    END IF;
END;
' LANGUAGE plpgsql;
