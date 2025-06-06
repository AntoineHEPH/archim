CREATE OR REPLACE FUNCTION update_tuteur(int,text,text,text,date,text,text,numeric,int,int,text) RETURNS integer AS
'
DECLARE
    p_id ALIAS FOR $1;
    p_nom ALIAS FOR $2;
    p_prenom ALIAS FOR $3;
    p_telephone ALIAS FOR $4;
    p_date_naissance ALIAS FOR $5;
    p_lieu_naissance ALIAS FOR $6;
    p_pays ALIAS FOR $7;
    p_heures ALIAS FOR $8;
    p_annulations ALIAS FOR $9;
    p_absences ALIAS FOR $10;
    p_type_etablissement ALIAS FOR $11;
    retour INTEGER;
BEGIN
    UPDATE Tuteur SET
        nom = p_nom,
        prenom = p_prenom,
        telephone = p_telephone,
        date_naissance = p_date_naissance,
        lieu_naissance = p_lieu_naissance,
        pays = p_pays
    WHERE id_tuteur = p_id;

    UPDATE Details SET
        heures_prestees = p_heures,
        nb_annulation = p_annulations,
        nb_absence = p_absences,
        type_etablissement = p_type_etablissement
    WHERE id_details = (SELECT id_details FROM Tuteur WHERE id_tuteur = p_id);

    GET DIAGNOSTICS retour = ROW_COUNT;
    RETURN retour;
END;
' LANGUAGE plpgsql;
