CREATE OR REPLACE FUNCTION get_all_tutores()
RETURNS SETOF Tutore AS
'
BEGIN
    RETURN QUERY
    SELECT * FROM Tutore ORDER BY nom, prenom;
END;
'
LANGUAGE 'plpgsql';
