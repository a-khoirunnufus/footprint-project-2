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
