CREATE OR REPLACE FUNCTION ajout_dispo (
    pas_disponible boolean,
    ge_monday_16h50_18h30 boolean,
    ge_monday_17h30_18h45 boolean,
    ge_tuesday_16h50_18h30 boolean,
    ge_wednesday_14h_16h boolean,
    ge_thursday_16h50_18h30 boolean,
    ge_friday_16h50_18h30 boolean,
    ge_friday_17h30_18h45 boolean,
    co_monday_16h_17h boolean,
    co_monday_17h_18h boolean,
    co_tuesday_16h_17h boolean,
    co_tuesday_17h_18h boolean,
    co_thursday_16h_17h boolean,
    co_thursday_17h_18h boolean,
    co_friday_16h_17h boolean,
    ly_monday_16h_17h boolean,
    ly_monday_17h_18h boolean,
    ly_tuesday_16h_17h boolean,
    ly_tuesday_17h_18h boolean,
    ly_thursday_16h_17h boolean,
    ly_thursday_17h_18h boolean,
    ly_friday_16h_17h boolean,
    ly_friday_17h_18h boolean
) RETURNS integer AS
'
	DECLARE retour integer;
	DECLARE id integer;
	DECLARE p_pas_disponible ALIAS FOR $1;
	DECLARE p_ge_monday_16h50_18h30 ALIAS FOR $2;
	DECLARE p_ge_monday_17h30_18h45 ALIAS FOR $3;
	DECLARE p_ge_tuesday_16h50_18h30 ALIAS FOR $4;
	DECLARE p_ge_wednesday_14h_16h ALIAS FOR $5;
	DECLARE p_ge_thursday_16h50_18h30 ALIAS FOR $6;
	DECLARE p_ge_friday_16h50_18h30 ALIAS FOR $7;
	DECLARE p_ge_friday_17h30_18h45 ALIAS FOR $8;
	DECLARE p_co_monday_16h_17h ALIAS FOR $9;
	DECLARE p_co_monday_17h_18h ALIAS FOR $10;
	DECLARE p_co_tuesday_16h_17h ALIAS FOR $11;
	DECLARE p_co_tuesday_17h_18h ALIAS FOR $12;
	DECLARE p_co_thursday_16h_17h ALIAS FOR $13;
	DECLARE p_co_thursday_17h_18h ALIAS FOR $14;
	DECLARE p_co_friday_16h_17h ALIAS FOR $15;
	DECLARE p_ly_monday_16h_17h ALIAS FOR $16;
	DECLARE p_ly_monday_17h_18h ALIAS FOR $17;
	DECLARE p_ly_tuesday_16h_17h ALIAS FOR $18;
	DECLARE p_ly_tuesday_17h_18h ALIAS FOR $19;
	DECLARE p_ly_thursday_16h_17h ALIAS FOR $20;
	DECLARE p_ly_thursday_17h_18h ALIAS FOR $21;
	DECLARE p_ly_friday_16h_17h ALIAS FOR $22;
	DECLARE p_ly_friday_17h_18h ALIAS FOR $23;
	DECLARE v_num_semaine TEXT;
BEGIN
	v_num_semaine = get_current_week();
    SELECT INTO id d.id_dispo FROM disponibilite d WHERE d.pas_disponible = $1
              AND d.ge_monday_16h50_18h30 = $2
              AND d.ge_monday_17h30_18h45 = $3
              AND d.ge_tuesday_16h50_18h30 = $4
              AND d.ge_wednesday_14h_16h = $5
              AND d.ge_thursday_16h50_18h30 = $6
              AND d.ge_friday_16h50_18h30 = $7
              AND d.ge_friday_17h30_18h45 = $8
              AND d.co_monday_16h_17h = $9
              AND d.co_monday_17h_18h = $10
              AND d.co_tuesday_16h_17h = $11
              AND d.co_tuesday_17h_18h = $12
              AND d.co_thursday_16h_17h = $13
              AND d.co_thursday_17h_18h = $14
              AND d.co_friday_16h_17h = $15
              AND d.ly_monday_16h_17h = $16
              AND d.ly_monday_17h_18h = $17
              AND d.ly_tuesday_16h_17h = $18
              AND d.ly_tuesday_17h_18h = $19
              AND d.ly_thursday_16h_17h = $20
              AND d.ly_thursday_17h_18h = $21
              AND d.ly_friday_16h_17h = $22
              AND d.ly_friday_17h_18h = $23
              AND d.week = v_num_semaine;
	IF NOT FOUND
	THEN
    	INSERT INTO disponibilite (
        	pas_disponible, 
            ge_monday_16h50_18h30, 
            ge_monday_17h30_18h45, 
            ge_tuesday_16h50_18h30, 
            ge_wednesday_14h_16h, 
            ge_thursday_16h50_18h30, 
            ge_friday_16h50_18h30, 
            ge_friday_17h30_18h45, 
            co_monday_16h_17h, 
            co_monday_17h_18h, 
            co_tuesday_16h_17h, 
            co_tuesday_17h_18h, 
            co_thursday_16h_17h, 
            co_thursday_17h_18h, 
            co_friday_16h_17h, 
            ly_monday_16h_17h, 
            ly_monday_17h_18h, 
            ly_tuesday_16h_17h, 
            ly_tuesday_17h_18h, 
            ly_thursday_16h_17h, 
            ly_thursday_17h_18h, 
            ly_friday_16h_17h, 
            ly_friday_17h_18h,
			week
        ) VALUES (
            $1, 
            $2, 
            $3, 
            $4, 
            $5, 
            $6, 
            $7, 
            $8, 
            $9, 
            $10, 
            $11, 
            $12, 
            $13, 
            $14, 
            $15, 
            $16, 
            $17, 
            $18, 
            $19, 
            $20, 
            $21, 
            $22, 
            $23,
			v_num_semaine
        );
		IF NOT FOUND
		THEN
			retour = -1;
		ELSE
        	retour = 1;
		END IF;
	ELSE
		retour = id;
    END IF;

    RETURN retour;
END;
'
LANGUAGE plpgsql;
