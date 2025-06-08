CREATE OR REPLACE FUNCTION ajouter_heures_details(p_id_details INT, p_heures NUMERIC)
RETURNS VOID AS '
BEGIN
    UPDATE details
    SET heures_prestees = COALESCE(heures_prestees, 0) + p_heures
    WHERE id_details = p_id_details;
END;
' LANGUAGE plpgsql;
