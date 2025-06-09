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

}
