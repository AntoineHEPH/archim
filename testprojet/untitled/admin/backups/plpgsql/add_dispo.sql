CREATE OR REPLACE FUNCTION add_disponibilite_plpgsql(
    p_id_tuteur INTEGER,
    p_semaine DATE
)
RETURNS INTEGER AS
'
DECLARE
new_id INTEGER;
BEGIN
INSERT INTO Disponibilite (id_tuteur, semaine)
VALUES (p_id_tuteur, p_semaine)
    RETURNING id_dispo INTO new_id;

RETURN new_id;
END;
'
LANGUAGE plpgsql;
