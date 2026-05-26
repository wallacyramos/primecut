<?php

$host = getenv('DB_HOST') ?: ($_SERVER['DB_HOST'] ?? null);
$port = getenv('DB_PORT') ?: ($_SERVER['DB_PORT'] ?? 5432);
$dbname = getenv('DB_NAME') ?: ($_SERVER['DB_NAME'] ?? null);
$user = getenv('DB_USER') ?: ($_SERVER['DB_USER'] ?? null);
$pass = getenv('DB_PASS') ?: ($_SERVER['DB_PASS'] ?? null);

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}