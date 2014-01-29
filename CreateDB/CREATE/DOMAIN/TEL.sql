CREATE DOMAIN tel_number AS varchar
CHECK(
   VALUE ~ '^[+]?([\d]{2}|)\s?([\d]{3}[\s-]?[\d]{3}[\s-]?[\d]{3})\s?$'
);
	
