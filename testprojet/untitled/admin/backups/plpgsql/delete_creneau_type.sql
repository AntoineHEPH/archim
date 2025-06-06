CREATE OR REPLACE FUNCTION delete_creneau_type(int) RETURNS integer AS
'
DECLARE
    p_id ALIAS FOR $1;
BEGIN
    DELETE FROM Creneau_type WHERE id_creneau_type = p_id;
    RETURN 1;
END;
' LANGUAGE plpgsql;
