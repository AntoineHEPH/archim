CREATE OR REPLACE FUNCTION clear_tutores_for_horaire(p_id_horaire INTEGER)
RETURNS VOID AS
'
BEGIN
    DELETE FROM horaire_tutore
    WHERE id_horaire = p_id_horaire;
END;
'
LANGUAGE 'plpgsql';
