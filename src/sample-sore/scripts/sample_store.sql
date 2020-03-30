
-- as user
-- mysql -h localhost -u sample_user --password=PASSWORD sample_store

USE sample_store;
CREATE TABLE products (product_id BIGINT PRIMARY KEY AUTO_INCREMENT, product_name VARCHAR(50), price DOUBLE) ENGINE = InnoDB;
INSERT INTO products(product_name, price) VALUES ('WINTER COAT','25.50');
INSERT INTO products(product_name, price) VALUES ('EMBROIDERED SHIRT','13.90');
INSERT INTO products(product_name, price) VALUES ('FASHION SHOES','45.30');
INSERT INTO products(product_name, price) VALUES ('PROXIMA TROUSER','39.95');

CREATE TABLE customers (customer_id BIGINT PRIMARY KEY AUTO_INCREMENT, customer_name VARCHAR(50) ) ENGINE = InnoDB;
INSERT INTO customers(customer_name) VALUES ('JOHN DOE');
INSERT INTO customers(customer_name) VALUES ('ROE MARY');
INSERT INTO customers(customer_name) VALUES ('DOE JANE');

CREATE TABLE orders (order_id BIGINT AUTO_INCREMENT PRIMARY KEY, order_date DATETIME, customer_id BIGINT, order_total DOUBLE) ENGINE = InnoDB;
CREATE TABLE orders_products (ref_id BIGINT PRIMARY KEY AUTO_INCREMENT, order_id BIGINT, product_id BIGINT, price DOUBLE, quantity BIGINT) ENGINE = InnoDB;
commit;