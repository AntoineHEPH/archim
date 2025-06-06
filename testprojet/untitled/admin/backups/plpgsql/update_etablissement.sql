CREATE OR REPLACE FUNCTION update_etablissement(
    int, text, text, text, text, text
) RETURNS integer AS
'
DECLARE
    p_id ALIAS FOR $1;
    p_nom ALIAS FOR $2;
    p_type ALIAS FOR $3;
    p_numero ALIAS FOR $4;
    p_rue ALIAS FOR $5;
    p_ville ALIAS FOR $6;
    retour INTEGER;
BEGIN
    UPDATE Etablissement
    SET nom = p_nom,
        type = p_type,
        numero = p_numero,
        rue = p_rue,
        ville = p_ville
    WHERE id_etablissement = p_id;

    GET DIAGNOSTICS retour = ROW_COUNT;
    RETURN retour;
END;
' LANGUAGE plpgsql;
