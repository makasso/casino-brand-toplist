-- Create database
CREATE
DATABASE IF NOT EXISTS casino_brand_toplist;
USE
casino_brand_toplist;

DROP TABLE IF EXISTS brands;

-- Create brands table
CREATE TABLE brands
(
    brand_id    INT AUTO_INCREMENT PRIMARY KEY,
    brand_name  VARCHAR(255) NOT NULL,
    brand_image VARCHAR(255) NOT NULL,
    rating      INT          NOT NULL CHECK (rating BETWEEN 1 AND 5),
    country_code CHAR(2) NOT NULL

);


-- Insert brands
INSERT INTO brands (brand_name, brand_image, rating, country_code)
VALUES ('LuckyStar Casino', 'https://placehold.co/60x60?text=LuckyStar', 5, 'FR'),
       ('Captain Spins', 'https://placehold.co/60x60?text=Captain', 4, 'GB'),
       ('LeoVegas', 'https://placehold.co/60x60?text=LeoVegas', 5, 'FR'),
       ('Platinum Play', 'https://placehold.co/60x60?text=Platinum', 4, 'BR'),
       ('Bellagio', 'https://placehold.co/60x60?text=Bellagio', 5, 'NL'),
       ('Caesars Palace', 'https://placehold.co/60x60?text=Caesars', 4, 'DE'),
       ('MGM Grand', 'https://placehold.co/60x60?text=MGM', 4, 'US'),
       ('Foxy Bingo', 'https://placehold.co/60x60?text=Foxy', 3, 'CA'),
       ('Bwin', 'https://placehold.co/60x60?text=Bwin', 4, 'BE'),
       ('PartyCasino', 'https://placehold.co/60x60?text=Party', 4, 'ES'),
       ('Partouche', 'https://placehold.co/60x60?text=Partouche', 3, 'US');

