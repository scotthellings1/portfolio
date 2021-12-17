<?php
try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
    $dotenv->required(["DB_CONNECTION", "DB_HOST", "DB_DATABASE", "DB_USERNAME", "DB_PASSWORD" ]);
} catch (Exception $e) {
    echo "Missing required environment variables.<br><br>";
}
