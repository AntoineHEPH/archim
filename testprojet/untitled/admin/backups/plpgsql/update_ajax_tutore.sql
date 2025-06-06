CREATE OR REPLACE FUNCTION update_ajax_tutore(text, text, int) RETURNS integer AS
'
DECLARE
    p_champ ALIAS FOR $1;
    p_valeur ALIAS FOR $2;
    p_id ALIAS FOR $3;
BEGIN
    EXECUTE format(''UPDATE Tutore SET %I = %L WHERE id_tutore = %L'', p_champ, p_valeur, p_id);
    RETURN 1;
END;
' LANGUAGE plpgsql;