CREATE DOMAIN email_adress AS TEXT 
CHECK(
   VALUE ~ '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$'
   OR VALUE ~ '^@admin$'
);
--zapamiętać... a-z w SQLu to wbrew pozorom to nie to samo co A-Z
--mimo iż zazwyczaj traktuje tak samo. Ale nie tu.
