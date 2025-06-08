CREATE OR REPLACE FUNCTION set_tuteur_for_horaire(p_id_horaire INTEGER, p_id_tuteur INTEGER)
RETURNS VOID AS
'
BEGIN
    INSERT INTO horaire_tuteur (id_horaire, id_tuteur)
    VALUES (p_id_horaire, p_id_tuteur);
END;
'
LANGUAGE 'plpgsql';
