CREATE OR REPLACE FUNCTION get_creneaux_selectionnes(p_id_dispo INTEGER)
RETURNS TABLE (id_creneau_type INTEGER) AS
'
BEGIN
    RETURN QUERY
    SELECT cd.id_creneau_type
    FROM Creneau_disponibilite cd
    WHERE cd.id_dispo = p_id_dispo;
END;
'
LANGUAGE 'plpgsql';
