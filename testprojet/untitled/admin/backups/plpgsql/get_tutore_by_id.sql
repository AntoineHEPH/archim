CREATE OR REPLACE FUNCTION get_tutore_by_id(integer)
RETURNS SETOF Tutore AS
'
    DECLARE
        p_id_tutore ALIAS FOR $1;
BEGIN
    RETURN QUERY
    SELECT * FROM Tutore WHERE id_tutore = p_id_tutore;
END;
'
LANGUAGE 'plpgsql';
