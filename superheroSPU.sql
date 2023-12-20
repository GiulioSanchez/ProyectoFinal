USE superhero;

SELECT * FROM alignment;  -- Bandos
SELECT * FROM attribute;  -- Atributos/caracteristicas
SELECT * FROM colour;	  -- Lista de colores
SELECT * FROM comic;	  -- No se utilizara
SELECT * FROM gender;	  --  Generos
SELECT * FROM publisher;  -- Casa de publicacion
SELECT * FROM race;		  -- Razas
SELECT * FROM superhero;  -- Super heroes
SELECT * FROM superpower; -- poderes de energia


-- PS
DELIMITER $$
CREATE PROCEDURE spu_contar_superheroes_por_publishers(IN _id INT)
BEGIN
	SELECT 
	pub.publisher_name,
    count(sup.id) as superheroes
    FROM
	publisher pub
    INNER JOIN superhero sup ON sup.publisher_id = pub.id
    WHERE pub.id = _id
    GROUP BY pub.publisher_name;
END $$
DELIMITER $$

CREATE PROCEDURE spu_listar_superheroes(IN _id INT)
BEGIN
	SELECT 
		su.id,
        su.superhero_name,
        su.full_name,
        ge.gender,
        ra.race
		FROM 
        superhero su
        INNER JOIN gender ge ON ge.id = su.gender_id
        INNER JOIN race ra ON ra.id = su.race_id
        WHERE publisher_id = _id
        ORDER BY id ASC;
END $$

DELIMITER $$
CREATE PROCEDURE spu_listar_publisher()
BEGIN
	SELECT *
		FROM 
        publisher;
END $$


CALL spu_listar_superheroes(20)
CALL spu_listar_bandos()
CALL spu_listar_bandos_por_publishers(3)

DELIMITER $$
CREATE PROCEDURE spu_listar_bandos()
BEGIN
	SELECT 
		ali.alignment AS nombre_bando,
        COUNT(su.id) AS superheroe
		FROM 
        alignment ali
		LEFT JOIN superhero su ON su.alignment_id = ali.id or alignment_id IS NULL
        GROUP BY ali.id, ali.alignment;
END $$


DELIMITER $$
CREATE PROCEDURE spu_listar_bandos_por_publishers(IN _id INT)
BEGIN
	SELECT 
        ali.alignment as nombre_bando,
        COUNT(su.id) as superheroe
    FROM 
        superhero su
        LEFT JOIN alignment ali ON su.alignment_id = ali.id
        INNER JOIN publisher pub ON pub.id = su.publisher_id
    WHERE pub.id = _id OR su.publisher_id IS NULL
    GROUP BY ali.id, ali.alignment;
END $$



