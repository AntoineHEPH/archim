CREATE OR REPLACE FUNCTION get_admin (text, text) returns text as
'
    DECLARE p_login_admin ALIAS FOR $1;
    DECLARE p_password_admin ALIAS FOR $2;
    DECLARE r_nom_admin text;
    DECLARE retour text;

BEGIN
    SELECT INTO r_nom_admin nom_admin FROM admin WHERE login_admin = p_login_admin
    AND password_admin = p_password_admin;

    IF r_nom_admin IS NOT NULL
    THEN
        retour = r_nom_admin;
    ELSE
        retour = NULL;
    END IF;

    return retour;
END;
'
LANGUAGE 'plpgsql';