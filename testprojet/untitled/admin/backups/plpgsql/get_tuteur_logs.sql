CREATE OR REPLACE FUNCTION get_tuteur_logs(p_login TEXT, p_password TEXT)
RETURNS TABLE (
    id_tuteur INTEGER,
    nom VARCHAR,
    prenom VARCHAR
) AS
'
BEGIN
    RETURN QUERY
    SELECT t.id_tuteur, t.nom, t.prenom
    FROM Tuteur t
    WHERE t.login = p_login AND t.mot_de_passe = p_password;
END;
'
LANGUAGE 'plpgsql';
