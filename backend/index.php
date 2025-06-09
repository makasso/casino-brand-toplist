<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Database;

// Initialize the database connection
$database = new Database();
$connection = $database->connect();

