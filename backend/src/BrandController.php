<?php
namespace App;

use App\BrandModel;
use PDO;

class BrandController
{
    private BrandModel $brandModel;

    public function __construct(PDO $database)
    {
        $this->brandModel = new BrandModel($database);
        header('Content-Type: application/json');
    }

    public function index(): void
    {
        echo json_encode($this->brandModel->getAllBrands());
    }

    public function show(int $id): void
    {
        $brand = $this->brandModel->getById($id);
        if (!$brand) {
            http_response_code(404);
            echo json_encode(['message' => 'Brand not found']);
            return;
        }
        echo json_encode($brand);
    }

    public function store(): void
    {
        $data = json_decode(file_get_contents('php://input'), true) ?: [];

        if (!$this->validateInput($data)) {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid data submitted']);
            return;
        } else {
            $data = $this->validateInput($data);
        }

        $this->brandModel->create($data);
        http_response_code(201);
        echo json_encode(['message' => 'Brand created']);
    }

    public function update(int $id): void
    {
        $brand = $this->brandModel->getById($id);
        if (!$brand) {
            http_response_code(404);
            echo json_encode(['message' => 'Brand not found']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true) ?: [];

        if (!$this->validateInput($data)) {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid data submitted']);
            return;
        } else {
            $data = $this->validateInput($data);
        }

        $this->brandModel->update($id, $data);
        echo json_encode(['message' => 'Brand updated successfully']);
    }

    public function destroy(int $id): void
    {
        $brand = $this->brandModel->getById($id);
        if (!$brand) {
            http_response_code(404);
            echo json_encode(['message' => 'Brand not found']);
            return;
        }

        $this->brandModel->delete($id);
        echo json_encode(['message' => 'Brand deleted successfully']);
    }

    private function validateInput(array $data): array|false
    {
        if (
            empty($data['brand_name']) ||
            empty($data['brand_image']) ||
            !isset($data['rating']) ||
            !is_int($data['rating']) ||
            $data['rating'] < 1 || $data['rating'] > 5
        ) {
            return false;
        }

        if (
            isset($data['country_code']) &&
            (!is_string($data['country_code']) || strlen($data['country_code']) !== 2)
        ) {
            return false;
        }

        // Sanitize the user input
        $cleanData = [
            'brand_name' => htmlspecialchars(trim($data['brand_name']), ENT_QUOTES, 'UTF-8'),
            'brand_image' => htmlspecialchars(trim($data['brand_image']), ENT_QUOTES, 'UTF-8'),
            'rating' => $data['rating'],
        ];

        if (isset($data['country_code'])) {
            $cleanData['country_code'] = htmlspecialchars(strtoupper(trim($data['country_code'])), ENT_QUOTES, 'UTF-8');
        }

        return $cleanData;
    }
}
