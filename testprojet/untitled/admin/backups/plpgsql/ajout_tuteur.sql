CREATE OR REPLACE FUNCTION ajout_tuteur(text,text,text,date,text,text,numeric,int,int, text,text,text) RETURNS int AS
'
DECLARE
    p_nom ALIAS FOR $1;
    p_prenom ALIAS FOR $2;
    p_telephone ALIAS FOR $3;
    p_date_naissance ALIAS FOR $4;
    p_lieu_naissance ALIAS FOR $5;
    p_pays ALIAS FOR $6;
    p_heures ALIAS FOR $7;
    p_annulation ALIAS FOR $8;
    p_absence ALIAS FOR $9;
    p_type_etablissement ALIAS FOR $10;
    p_login ALIAS FOR $11;
    p_mot_de_passe ALIAS FOR $12;

    v_id_details INTEGER;
    retour INTEGER;
BEGIN
    INSERT INTO Details (heures_prestees, nb_annulation, nb_absence, type_etablissement)
    VALUES (p_heures, p_annulation, p_absence, p_type_etablissement)
    RETURNING id_details INTO v_id_details;

    INSERT INTO Tuteur (
        nom, prenom, telephone, date_naissance, lieu_naissance, pays,
        id_details, login, mot_de_passe
    )
    VALUES (
        p_nom, p_prenom, p_telephone, p_date_naissance, p_lieu_naissance, p_pays,
        v_id_details, p_login, p_mot_de_passe
    )
    ON CONFLICT DO NOTHING;

    SELECT INTO retour id_tuteur FROM Tuteur
    WHERE nom = p_nom AND prenom = p_prenom AND date_naissance = p_date_naissance;

    IF retour IS NULL THEN
        RETURN -1;
    ELSE
        RETURN retour;
    END IF;
END;
' LANGUAGE plpgsql;
