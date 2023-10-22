CREATE TABLE tbl_pegawai (
    id_pegawai INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_pegawai VARCHAR(50),
    username VARCHAR(20),
    password TEXT,
    email VARCHAR(50),
    nohp VARCHAR(20)
);

ALTER TABLE tbl_pegawai
ADD COLUMN is_administrator TINYINT(1) DEFAULT 0;

CREATE TABLE items (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(75) NOT NULL,
    price FLOAT NOT NULL,
    quantity SMALLINT NOT NULL DEFAULT 0,
    sold SMALLINT NOT NULL DEFAULT 0,
    available SMALLINT NOT NULL DEFAULT 0
);

CREATE TABLE transactions (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    quantity SMALLINT,
    total_price FLOAT NOT NULL,
    time DATETIME
);

ALTER TABLE transactions ADD CONSTRAINT fk_item_id
FOREIGN KEY (item_id) REFERENCES items(id);
