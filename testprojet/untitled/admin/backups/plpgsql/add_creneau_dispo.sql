CREATE OR REPLACE FUNCTION add_creneau_dispo(p_id_dispo INTEGER, p_id_creneau_type INTEGER)
RETURNS VOID AS
'
BEGIN
    INSERT INTO Creneau_disponibilite (id_dispo, id_creneau_type)
    VALUES (p_id_dispo, p_id_creneau_type);
END;
'
LANGUAGE 'plpgsql';
