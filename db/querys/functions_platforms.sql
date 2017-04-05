CREATE or replace FUNCTION getWorkSection ( getname text )
	RETURNS int4
	AS $$
DECLARE
theName int4;
BEGIN
	SELECT id INTO theName FROM repair_stuff.work_sections WHERE "name" = getName;
	return theName;
END;
$$  LANGUAGE plpgsql;

--( select id from platforms.repair_type where code = 't1' )

-- select getRepType ('t1');

CREATE or replace FUNCTION getRepType ( getcode text )
	RETURNS int4
	AS $$
DECLARE
theCode int4;
BEGIN
	SELECT id INTO theCode FROM platforms.repair_type where code = getcode;
	return theCode;
END;
$$  LANGUAGE plpgsql;

-- drop function getRepType(text);