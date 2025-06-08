CREATE OR REPLACE FUNCTION incrementer_absence_details(p_id_details INT)
RETURNS VOID AS '
BEGIN
    UPDATE details
    SET nb_absence = COALESCE(nb_absence, 0) + 1
    WHERE id_details = p_id_details;
END;
' LANGUAGE plpgsql;
