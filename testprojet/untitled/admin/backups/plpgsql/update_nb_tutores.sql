CREATE OR REPLACE FUNCTION update_nb_tutores(p_id_horaire INTEGER, p_nb INTEGER)
RETURNS VOID AS
'
BEGIN
    UPDATE Horaire
    SET nb_tutores_attendus = p_nb
    WHERE id_horaire = p_id_horaire;
END;
'
LANGUAGE 'plpgsql';
