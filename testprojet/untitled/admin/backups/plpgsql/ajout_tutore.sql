CREATE OR REPLACE FUNCTION ajout_tutore(text,text,date,text,text,text) RETURNS integer AS
'
DECLARE
    p_nom ALIAS FOR $1;
    p_prenom ALIAS FOR $2;
    p_date_naissance ALIAS FOR $3;
    p_situation ALIAS FOR $4;
    p_details ALIAS FOR $5;
    p_classe ALIAS FOR $6;
    retour INTEGER;
BEGIN
    INSERT INTO Tutore (nom, prenom, date_naissance, situation_personnel, details, classe)
    VALUES (p_nom, p_prenom, p_date_naissance, p_situation, p_details, p_classe)
    ON CONFLICT DO NOTHING;

    SELECT INTO retour id_tutore FROM Tutore
    WHERE nom = p_nom AND prenom = p_prenom AND date_naissance = p_date_naissance;

    IF retour IS NULL THEN
            RETURN -1;
    ELSE
            RETURN retour;
    END IF;
END;
' LANGUAGE plpgsql;
