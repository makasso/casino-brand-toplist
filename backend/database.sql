CREATE DATABASE IF NOT EXISTS casino_brand_toplist;
USE casino_brand_toplist;

CREATE TABLE IF NOT EXISTS brands (
    brand_id INT AUTO_INCREMENT PRIMARY KEY,
    brand_name VARCHAR(255) NOT NULL,
    brand_image VARCHAR(255) NOT NULL,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    country_code CHAR(2) DEFAULT NULL
);
