CREATE OR REPLACE FUNCTION insert_horaire(
    p_semaine DATE,
    p_id_creneau_type INTEGER,
    p_nb_tutores INTEGER DEFAULT 0,
    p_id_tuteur INTEGER DEFAULT NULL
)
RETURNS INTEGER AS
'
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO Horaire (semaine, id_creneau_type, nb_tutores_attendus, id_tuteur)
    VALUES (p_semaine, p_id_creneau_type, p_nb_tutores, p_id_tuteur)
    RETURNING id_horaire INTO new_id;

    RETURN new_id;
END;
'
LANGUAGE 'plpgsql';
