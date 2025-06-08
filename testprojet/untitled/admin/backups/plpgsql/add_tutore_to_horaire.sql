CREATE OR REPLACE FUNCTION add_tutore_to_horaire(p_id_horaire INTEGER, p_id_tutore INTEGER)
RETURNS VOID AS
'
BEGIN
    INSERT INTO horaire_tutore (id_horaire, id_tutore)
    VALUES (p_id_horaire, p_id_tutore);
END;
'
LANGUAGE 'plpgsql';
