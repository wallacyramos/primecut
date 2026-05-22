<?php

session_start();

require_once '../includes/auth.php';
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: ../planos.php');
    exit;
}

$usuario_id = $_SESSION['user_id'];
$plano_id = $_GET['id'];

$check = $pdo->prepare("
    SELECT id
    FROM primecut.assinaturas
    WHERE usuario_id = :usuario
    AND status = 'ativa'
");

$check->execute([
    ':usuario' => $usuario_id
]);

if (!$check->fetch()) {

    $sql = "
        INSERT INTO primecut.assinaturas
        (
            usuario_id,
            plano_id,
            status
        )
        VALUES
        (
            :usuario,
            :plano,
            'ativa'
        )
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':usuario' => $usuario_id,
        ':plano' => $plano_id
    ]);
}

header('Location: dashboard.php?vip=ativo');
exit;