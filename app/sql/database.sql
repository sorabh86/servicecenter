CREATE TABLE IF NOT EXISTS customers (
    id int(8) NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    address VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS devices ( 
    id int(8) NOT NULL AUTO_INCREMENT, 
    customer_id  int(8) NOT NULL, 
    engineer_id  int(8) NOT NULL, 
    device_category_id  int(8) NOT NULL, 
    brand_name VARCHAR(255) NOT NULL, 
    serial_no VARCHAR(255) NOT NULL, 
    purchase_price DECIMAL(8,2) NOT NULL, 
    date_of_purchase DATE NOT NULL ,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS device_category ( 
    id int(8) NOT NULL AUTO_INCREMENT, 
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS fault_services ( 
    id int(8) NOT NULL AUTO_INCREMENT, 
    device_id int(8) NOT NULL, 
    alternative_address VARCHAR(255) NOT NULL, 
    alternative_phone VARCHAR(50) NOT NULL, 
    status VARCHAR(255) NOT NULL, 
    requested_date DATE NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS maintenance_service ( 
    id int(8) NOT NULL AUTO_INCREMENT, 
    name VARCHAR(255) NOT NULL, 
    description VARCHAR(255) NOT NULL, 
    price DECIMAL(8,2) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS site_visit ( 
    fault_service_id int(8) NOT NULL, 
    engineer_id int(8) NOT NULL, 
    date_of_visit DATE NOT NULL, 
    replace_part VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS customers_maintenance_service ( 
    maintenance_service_id int(8) NOT NULL,
    customer_id int(8) NOT NULL 
);

CREATE TABLE IF NOT EXISTS engineers ( 
    id int(8) NOT NULL AUTO_INCREMENT, 
    name VARCHAR(255) NOT NULL, 
    address VARCHAR(255) NOT NULL, 
    date_of_joining DATE NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS engineers_expertise ( 
    device_category_id int(8) NOT NULL, 
    engineer_id int(8) NOT NULL 
);

ALTER TABLE `customers_maintenance_service` 
    ADD `date_of_purchase` DATE NOT NULL AFTER `customer_id`, 
    ADD `year_of_service` INT NOT NULL AFTER `date_of_purchase`;