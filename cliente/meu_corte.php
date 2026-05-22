<?php

session_start();

require_once '../includes/auth.php';
require_once '../config/database.php';

$usuario_id = $_SESSION['user_id'];

$sql = "
    SELECT 
        a.barbeiro_id,
        a.servico_id,
        b.nome AS barbeiro,
        s.nome AS servico
    FROM primecut.agendamentos a
    JOIN primecut.barbeiros b ON b.id = a.barbeiro_id
    JOIN primecut.servicos s ON s.id = a.servico_id
    WHERE a.usuario_id = :usuario
    ORDER BY a.id DESC
    LIMIT 1
";

$stmt = $pdo->prepare($sql);
$stmt->execute([':usuario' => $usuario_id]);
$ultimo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ultimo) {
    header('Location: dashboard.php');
    exit;
}

$update = "
    UPDATE primecut.usuarios
    SET barbeiro_favorito_id = :barbeiro,
        servico_favorito_id = :servico
    WHERE id = :usuario
";

$stmt = $pdo->prepare($update);
$stmt->execute([
    ':barbeiro' => $ultimo['barbeiro_id'],
    ':servico' => $ultimo['servico_id'],
    ':usuario' => $usuario_id
]);

header('Location: dashboard.php?corte=salvo');
exit;