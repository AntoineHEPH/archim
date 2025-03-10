CREATE OR REPLACE FUNCTION ajout_dispotuteur (int, int) RETURNS integer
AS
'
	DECLARE retour integer;
	DECLARE p_id_tuteur ALIAS FOR $1;
	DECLARE p_id_dispo ALIAS FOR $2;
BEGIN
    INSERT INTO tuteurdispo(id_tuteur, id_dispo) VALUES ($1, $2);
	IF NOT FOUND THEN
		retour = -1;
	ELSE
    	retour = 1;
	END IF;

	RETURN retour;
END;
'
LANGUAGE plpgsql;
