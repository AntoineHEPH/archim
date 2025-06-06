CREATE OR REPLACE FUNCTION delete_tuteur(int) RETURNS integer AS
'
DECLARE
    p_id ALIAS FOR $1;
    v_id_details INTEGER;
BEGIN
    SELECT id_details INTO v_id_details FROM Tuteur WHERE id_tuteur = p_id;

    DELETE FROM Tuteur WHERE id_tuteur = p_id;
    DELETE FROM Details WHERE id_details = v_id_details;

    RETURN 1;
END;
' LANGUAGE plpgsql;
