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

    
}
