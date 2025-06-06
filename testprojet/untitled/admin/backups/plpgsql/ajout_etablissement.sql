CREATE OR REPLACE FUNCTION ajout_etablissement(text,text,text,text,text) RETURNS integer AS
'
DECLARE
    p_nom ALIAS FOR $1;
    p_type ALIAS FOR $2;
    p_numero ALIAS FOR $3;
    p_rue ALIAS FOR $4;
    p_ville ALIAS FOR $5;
    retour INTEGER;
BEGIN
    INSERT INTO Etablissement(nom, type, numero, rue, ville)
    VALUES (p_nom, p_type, p_numero, p_rue, p_ville)
    RETURNING id_etablissement INTO retour;

    RETURN retour;
END;
' LANGUAGE plpgsql;
