<?php

session_start();

require_once '../config/database.php';

if (!isset($_GET['id']) || !isset($_GET['status'])) {
    header('Location: dashboard.php');
    exit;
}

$id = $_GET['id'];
$status = $_GET['status'];

$statusPermitidos = [
    'pendente',
    'confirmado',
    'concluido',
    'cancelado'
];

if (!in_array($status, $statusPermitidos)) {
    header('Location: dashboard.php');
    exit;
}

$sql = "
    UPDATE primecut.agendamentos
    SET status = :status
    WHERE id = :id
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':status' => $status,
    ':id' => $id
]);

header('Location: dashboard.php');
exit;