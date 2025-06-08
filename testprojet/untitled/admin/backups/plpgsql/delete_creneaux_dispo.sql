CREATE OR REPLACE FUNCTION delete_creneaux_dispo(p_id_dispo INTEGER)
RETURNS VOID AS
'
BEGIN
    DELETE FROM Creneau_disponibilite
    WHERE id_dispo = p_id_dispo;
END;
'
LANGUAGE 'plpgsql';
