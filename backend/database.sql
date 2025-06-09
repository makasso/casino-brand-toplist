-- Create database
CREATE
DATABASE IF NOT EXISTS casino_brand_toplist;
USE
casino_brand_toplist;

DROP TABLE IF EXISTS brand_countries;
DROP TABLE IF EXISTS brands;

-- Create brands table
CREATE TABLE brands
(
    brand_id    INT AUTO_INCREMENT PRIMARY KEY,
    brand_name  VARCHAR(255) NOT NULL,
    brand_image VARCHAR(500) NOT NULL,
    rating      INT          NOT NULL CHECK (rating BETWEEN 1 AND 5)
);

-- Create brand_countries table
CREATE TABLE brand_countries
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    brand_id     INT     NOT NULL,
    country_code CHAR(2) NOT NULL,
    FOREIGN KEY (brand_id) REFERENCES brands (brand_id) ON DELETE CASCADE
);

-- Insert brands
INSERT INTO brands (brand_name, brand_image, rating)
VALUES ('LuckyStar Casino', 'https://placehold.co/60x60?text=LuckyStar', 5),
       ('Captain Spins', 'https://placehold.co/60x60?text=Captain', 4),
       ('LeoVegas', 'https://placehold.co/60x60?text=LeoVegas', 5),
       ('Platinum Play', 'https://placehold.co/60x60?text=Platinum', 4),
       ('Bellagio', 'https://placehold.co/60x60?text=Bellagio', 5),
       ('Caesars Palace', 'https://placehold.co/60x60?text=Caesars', 4),
       ('MGM Grand', 'https://placehold.co/60x60?text=MGM', 4),
       ('Foxy Bingo', 'https://placehold.co/60x60?text=Foxy', 3),
       ('Bwin', 'https://placehold.co/60x60?text=Bwin', 4),
       ('PartyCasino', 'https://placehold.co/60x60?text=Party', 4),
       ('Partouche', 'https://placehold.co/60x60?text=Partouche', 3);

-- Assign brands to specific countries (using ISO-2 codes)
INSERT INTO brand_countries (brand_id, country_code)
VALUES (1, 'FR'),
       (2, 'FR'),
       (3, 'SE'),
       (4, 'CA'),
       (5, 'US'),
       (6, 'US'),
       (7, 'US'),
       (8, 'UK'),
       (9, 'DE'),
       (10, 'NL'),
       (11, 'FR');