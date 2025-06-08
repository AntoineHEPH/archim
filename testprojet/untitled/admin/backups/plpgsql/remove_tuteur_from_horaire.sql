CREATE OR REPLACE FUNCTION remove_tuteur_from_horaire(p_id_horaire INTEGER)
RETURNS VOID AS
'
BEGIN
    DELETE FROM horaire_tuteur
    WHERE id_horaire = p_id_horaire;
END;
'
LANGUAGE 'plpgsql';
