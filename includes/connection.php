<?php
// Read database credentials from the project-level .env file.
$env = parse_ini_file(__DIR__ . '/../.env');

// Map environment values to descriptive local variables used by the PDO constructor.
$host = $env['DB_HOST'];
$db   = $env['DB_NAME'];
$user = $env['DB_USER'];
$pass = $env['DB_PASS'];

try {
    // Build a UTF-8 MySQL connection so multilingual content is stored/retrieved correctly.
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    // Throw exceptions for query errors so calling pages can handle failures predictably.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Stop execution early when no database connection is available.
    die("Database connection failed: " . $e->getMessage());
}
