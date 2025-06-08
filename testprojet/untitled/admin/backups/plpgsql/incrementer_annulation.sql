CREATE OR REPLACE FUNCTION incrementer_annulation_details(p_id_details INT)
RETURNS VOID AS '
BEGIN
    UPDATE details
    SET nb_annulation = COALESCE(nb_annulation, 0) + 1
    WHERE id_details = p_id_details;
END;
' LANGUAGE plpgsql;
