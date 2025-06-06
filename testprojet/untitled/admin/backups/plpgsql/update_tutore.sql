CREATE OR REPLACE FUNCTION update_tutore(int,text,text,date,text,text,text) RETURNS integer AS
'
DECLARE
    p_id ALIAS FOR $1;
    p_nom ALIAS FOR $2;
    p_prenom ALIAS FOR $3;
    p_date_naissance ALIAS FOR $4;
    p_situation ALIAS FOR $5;
    p_details ALIAS FOR $6;
    p_classe ALIAS FOR $7;
    retour INTEGER;
BEGIN
    UPDATE Tutore SET
                  nom = p_nom,
                  prenom = p_prenom,
                  date_naissance = p_date_naissance,
                  situation_personnel = p_situation,
                  details = p_details,
                  classe = p_classe
    WHERE id_tutore = p_id;

    GET DIAGNOSTICS retour = ROW_COUNT;
    RETURN retour;
END;
'LANGUAGE plpgsql;
