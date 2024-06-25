--CREATE DATABASE letaciky CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE letaciky;

-- Typy obchodov
CREATE TABLE country (
	id INT NOT NULL AUTO_INCREMENT, 
	name VARCHAR(8) NOT NULL,
	title VARCHAR(64) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY name (name)
);

-- Typy obchodov
CREATE TABLE shop_typ (
	id INT NOT NULL AUTO_INCREMENT, 
	name VARCHAR(32) NOT NULL,
	title VARCHAR(64) NOT NULL, 
	idx SMALLINT,
	PRIMARY KEY (id),
	UNIQUE KEY name (name)
);

-- Obchody
CREATE TABLE shop (
	id INT NOT NULL AUTO_INCREMENT, 
	id_typ INT NOT NULL,
	id_country INT NOT NULL,

	idx SMALLINT,
	`create` DATE,

	name VARCHAR(32) NOT NULL, 
	title VARCHAR(64) NOT NULL, 
	title_no VARCHAR(256),

	icon VARCHAR(32), 
	name_orig VARCHAR(32), 
	web VARCHAR(256), 

	PRIMARY KEY (id), 
	UNIQUE KEY name (name),
	FOREIGN KEY (id_typ) REFERENCES shop_typ (id), 
	FOREIGN KEY (id_country) REFERENCES country (id)

);


-- letaky
CREATE TABLE leaflet (
	id INT NOT NULL AUTO_INCREMENT, 
	id_shop INT NOT NULL,
	id_country INT NOT NULL,

	name VARCHAR(256), 
	title VARCHAR(256) NOT NULL,
	sub_title VARCHAR(256),

	days INT,
	pages INT,
	pages2 INT,
	
	size INT,

	startDate DATE,
	endDate DATE,
	createDate DATE,

	PRIMARY KEY (id), 
	-- UNIQUE KEY name (name),

	FOREIGN KEY (id_shop) REFERENCES shop (id), 
	FOREIGN KEY (id_country) REFERENCES country (id)

);

CREATE TABLE leaflet_texts (
    id INT NOT NULL AUTO_INCREMENT,
    id_leaflet INT NOT NULL,
    page INT,
    `text` TEXT,
    ocr_size SMALLINT,
    `createDate` DATETIME,

	PRIMARY KEY (id), 
	FOREIGN KEY (id_leaflet) REFERENCES leaflet (id)

);


CREATE UNIQUE INDEX idx_shop_name ON shop (name);
CREATE UNIQUE INDEX idx_shop_typ_name ON shop_typ (name);
CREATE INDEX idx_leaflet_title ON leaflet (title);
CREATE INDEX idx_leaflet_text_id_leaflet ON leaflet_texts (id_leaflet);
