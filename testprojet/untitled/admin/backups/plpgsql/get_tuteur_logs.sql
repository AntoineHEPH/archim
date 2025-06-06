CREATE OR REPLACE FUNCTION get_tuteur_logs(p_login TEXT, p_password TEXT)
RETURNS TABLE (
    id_tuteur INTEGER,
    nom VARCHAR,
    prenom VARCHAR
) AS
'
BEGIN
    RETURN QUERY
    SELECT id_tuteur, nom, prenom
    FROM Tuteur
    WHERE login = p_login AND mot_de_passe = p_password;
END;
'
LANGUAGE 'plpgsql';
