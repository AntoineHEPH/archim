CREATE OR REPLACE FUNCTION insert_horaire_sans_tuteur(p_id_creneau_type INTEGER, p_semaine DATE)
RETURNS INTEGER AS
'
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO horaire (id_creneau_type, semaine)
    VALUES (p_id_creneau_type, p_semaine)
    RETURNING id_horaire INTO new_id;

    RETURN new_id;
END;
'
LANGUAGE 'plpgsql';
