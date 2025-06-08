CREATE OR REPLACE FUNCTION update_tuteur(p_id_horaire INTEGER, p_id_tuteur INTEGER)
RETURNS VOID AS
'
BEGIN
    UPDATE Horaire
    SET id_tuteur = p_id_tuteur
    WHERE id_horaire = p_id_horaire;
END;
'
LANGUAGE 'plpgsql';
