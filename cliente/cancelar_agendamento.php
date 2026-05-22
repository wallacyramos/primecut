<?php

session_start();

require_once '../includes/auth.php';
require_once '../config/database.php';

if (!isset($_GET['id'])) {

    header('Location: dashboard.php');
    exit;

}

$id = $_GET['id'];
$usuario_id = $_SESSION['user_id'];

$sql = "
    UPDATE primecut.agendamentos
    SET status = 'cancelado'
    WHERE id = :id
    AND usuario_id = :usuario
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id,
    ':usuario' => $usuario_id
]);

header('Location: dashboard.php');
exit;