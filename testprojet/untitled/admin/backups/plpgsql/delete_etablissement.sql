CREATE OR REPLACE FUNCTION delete_etablissement(int) RETURNS integer AS
'
DECLARE
    p_id ALIAS FOR $1;
BEGIN
    DELETE FROM Etablissement WHERE id_etablissement = p_id;
    RETURN 1;
END;
' LANGUAGE plpgsql;
