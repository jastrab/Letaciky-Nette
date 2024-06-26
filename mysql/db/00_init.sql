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
-- OPEN HOURS TABLES --

CREATE TABLE open_hours_days (
	id INTEGER NOT NULL AUTO_INCREMENT primary key,
	monday VARCHAR(128),
	tuesday VARCHAR(128),
	wednesday VARCHAR(128),
	thursday VARCHAR(128),
	friday VARCHAR(128),
	saturday VARCHAR(128),
	sunday VARCHAR(128),
	dateCheck datetime,
	dateCreate datetime,
	dateUpdate datetime
);


CREATE TABLE open_hours_gps (
	id INTEGER NOT NULL AUTO_INCREMENT primary key,
	lat real,
    lon real
);

-- Shopping center
CREATE TABLE open_hours_sc_index (
	id INTEGER NOT NULL AUTO_INCREMENT primary key,
	name VARCHAR(256) NOT NULL,
	title VARCHAR(256) NOT NULL,
	id_open_hours_days INTEGER,
    id_open_hours_gps INTEGER,
	source VARCHAR(128),
	url VARCHAR(256),
	type CHAR(1),
	city VARCHAR(128),
	address VARCHAR(128),
	slug VARCHAR(256),
	UNIQUE KEY name (name),
	FOREIGN KEY (id_open_hours_gps) REFERENCES open_hours_gps (id),
	FOREIGN KEY (id_open_hours_days) REFERENCES open_hours_days (id)
);

CREATE TABLE open_hours_shop_index (
    id INTEGER NOT NULL AUTO_INCREMENT primary key,
    name VARCHAR(256) NOT NULL,
    title VARCHAR(256) NOT NULL,
    source VARCHAR(256),
    url VARCHAR(256),
    type CHAR(1),
	UNIQUE KEY name (name)

);

CREATE TABLE open_hours_sc (
    id INTEGER NOT NULL AUTO_INCREMENT primary key,
    id_open_hours_sc_index INTEGER NOT NULL,
    title VARCHAR(256),
	id_open_hours_days INTEGER,
    url VARCHAR(256),
    url_web VARCHAR(256),
    slug VARCHAR(256) NOT NULL,
	FOREIGN KEY (id_open_hours_days) REFERENCES open_hours_days (id),
	FOREIGN KEY (id_open_hours_sc_index) REFERENCES open_hours_sc_index (id)
);

CREATE TABLE open_hours_shop (
    id INTEGER NOT NULL AUTO_INCREMENT primary key,
    id_open_hours_shop_index INTEGER NOT NULL,
	id_open_hours_days INTEGER,
    city VARCHAR(128),
    address VARCHAR(128),    
    id_open_hours_gps INTEGER,
    desc1 VARCHAR(128),
    desc2 VARCHAR(128),
    url VARCHAR(256),
    slug VARCHAR(256) NOT NULL,
	FOREIGN KEY (id_open_hours_shop_index) REFERENCES open_hours_shop_index (id),
	FOREIGN KEY (id_open_hours_days) REFERENCES open_hours_days (id),
	FOREIGN KEY (id_open_hours_gps) REFERENCES open_hours_gps (id)
);



CREATE UNIQUE INDEX idx_shop_name ON shop (name);
CREATE UNIQUE INDEX idx_shop_typ_name ON shop_typ (name);

CREATE INDEX idx_leaflet_title ON leaflet (title);
CREATE INDEX idx_leaflet_startDate ON leaflet (startDate);
CREATE INDEX idx_leaflet_endDate ON leaflet (endDate);

CREATE INDEX idx_leaflet_text_id_leaflet ON leaflet_texts (id_leaflet);



CREATE INDEX idx_open_hours_shop_index_name ON open_hours_shop_index (name);
CREATE INDEX idx_open_hours_sc_index_name ON open_hours_sc_index (name);

CREATE INDEX idx_open_hours_shop_slug ON open_hours_shop (slug);
CREATE INDEX idx_open_hours_sc_slug ON open_hours_sc (slug);


CREATE INDEX idx_open_hours_shop_id_oh_days ON open_hours_shop (id_oh_days);
CREATE INDEX idx_open_hours_shop_id_oh_gps ON open_hours_shop (id_oh_gps);
CREATE INDEX idx_open_hours_shop_id_oh_shop_index ON open_hours_shop (id_oh_shop_index);



-- DROP INDEX idx_shop_name ON shop;
-- DROP INDEX idx_shop_typ_name ON shop_typ;
-- DROP INDEX idx_leaflet_title ON leaflet;
-- DROP INDEX idx_leaflet_text_id_leaflet ON leaflet_texts;

-- DROP INDEX idx_open_hours_sc_index_name ON open_hours_sc_index;
-- DROP INDEX idx_open_hours_shop_index_name ON open_hours_shop_index;

-- DROP INDEX idx_leaflet_startDate ON leaflet;
-- DROP INDEX idx_leaflet_endDate ON leaflet;
