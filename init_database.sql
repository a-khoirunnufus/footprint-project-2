CREATE TABLE tbl_pegawai (
    id_pegawai INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_pegawai VARCHAR(50),
    username VARCHAR(20),
    password TEXT,
    email VARCHAR(50),
    nohp VARCHAR(20),
    is_administrator TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);

CREATE TABLE items (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(75) NOT NULL,
    buy_price FLOAT NOT NULL,
    sell_price FLOAT NOT NULL,
    quantity SMALLINT NOT NULL DEFAULT 0,
    sold SMALLINT NOT NULL DEFAULT 0,
    available SMALLINT NOT NULL DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);

CREATE TABLE transactions (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    cashier_id INT NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(75),
    status VARCHAR(20) NOT NULL,
    sub_total FLOAT NOT NULL,
    item_discount FLOAT,
    grand_total FLOAT NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    order_id INT NOT NULL,
    price FLOAT NOT NULL,
    discount FLOAT,
    quantity SMALLINT NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);

ALTER TABLE transactions ADD CONSTRAINT fk_order_id
FOREIGN KEY (order_id) REFERENCES orders(id);
ALTER TABLE transactions ADD CONSTRAINT fk_cashier
FOREIGN KEY (cashier_id) REFERENCES tbl_pegawai(id_pegawai);

ALTER TABLE order_items ADD CONSTRAINT fk_item_id
FOREIGN KEY (item_id) REFERENCES items(id);
ALTER TABLE order_items ADD CONSTRAINT fk_order_items_order_id
FOREIGN KEY (order_id) REFERENCES orders(id);
