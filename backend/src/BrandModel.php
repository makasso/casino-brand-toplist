<?php
namespace App;

use PDO;

class BrandModel
{
    private PDO $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    public function getAllBrands(): array
    {
        $stmt = $this->database->query("SELECT * FROM brands ORDER BY rating DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->database->prepare("SELECT * FROM brands WHERE brand_id = ?");
        $stmt->execute([$id]);
        $brand = $stmt->fetch(PDO::FETCH_ASSOC);
        return $brand ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->database->prepare("INSERT INTO brands (brand_name, brand_image, rating, country_code) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['brand_name'],
            $data['brand_image'],
            $data['rating'],
            $data['country_code'] ?? null
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->database->prepare("UPDATE brands SET brand_name = ?, brand_image = ?, rating = ?, country_code = ? WHERE brand_id = ?");
        return $stmt->execute([
            $data['brand_name'],
            $data['brand_image'],
            $data['rating'],
            $data['country_code'] ?? null,
            $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->database->prepare("DELETE FROM brands WHERE brand_id = ?");
        return $stmt->execute([$id]);
    }

    public function getByBrandsByCountry(?string $countryCode): array
    {
        if ($countryCode) {
            $stmt = $this->database->prepare("SELECT * FROM brands WHERE country_code = ? ORDER BY rating DESC");
            $stmt->execute([$countryCode]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($results)) {
                return $results;
            }
        }
        return $this->getAllBrands();
    }
    
}
