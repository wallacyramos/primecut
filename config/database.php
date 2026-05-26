<?php

$databaseUrl = getenv('DATABASE_URL');

if (!$databaseUrl && isset($_ENV['DATABASE_URL'])) {
    $databaseUrl = $_ENV['DATABASE_URL'];
}

if (!$databaseUrl && isset($_SERVER['DATABASE_URL'])) {
    $databaseUrl = $_SERVER['DATABASE_URL'];
}

if (!$databaseUrl) {
    die("DATABASE_URL não encontrada.");
}

$db = parse_url($databaseUrl);

$host = $db['host'] ?? null;
$port = $db['port'] ?? 5432;
$user = $db['user'] ?? null;
$pass = $db['pass'] ?? null;
$dbname = isset($db['path']) ? ltrim($db['path'], '/') : null;

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