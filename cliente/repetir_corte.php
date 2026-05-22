<?php

session_start();

require_once '../includes/auth.php';
require_once '../config/database.php';

$usuario_id = $_SESSION['user_id'];

$sql = "
    SELECT
        barbeiro_favorito_id,
        servico_favorito_id
    FROM primecut.usuarios
    WHERE id = :usuario
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':usuario' => $usuario_id
]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (
    !$usuario
    ||
    !$usuario['barbeiro_favorito_id']
    ||
    !$usuario['servico_favorito_id']
){

    header('Location: dashboard.php?repetir=erro');
    exit;

}

$barbeiro_id = $usuario['barbeiro_favorito_id'];
$servico_id = $usuario['servico_favorito_id'];

$mensagem = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = $_POST['data_agendamento'];
    $horario = $_POST['horario'];

    $check = $pdo->prepare("
        SELECT id
        FROM primecut.agendamentos
        WHERE barbeiro_id = :barbeiro
        AND data_agendamento = :data
        AND horario = :horario
    ");

    $check->execute([
        ':barbeiro' => $barbeiro_id,
        ':data' => $data,
        ':horario' => $horario
    ]);

    if($check->fetch()){

        $mensagem = "Horário já ocupado.";

    }else{

        $sql = "
            INSERT INTO primecut.agendamentos
            (
                usuario_id,
                barbeiro_id,
                servico_id,
                data_agendamento,
                horario,
                status
            )
            VALUES
            (
                :usuario,
                :barbeiro,
                :servico,
                :data,
                :horario,
                'pendente'
            )
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':usuario' => $usuario_id,
            ':barbeiro' => $barbeiro_id,
            ':servico' => $servico_id,
            ':data' => $data,
            ':horario' => $horario
        ]);

        header('Location: dashboard.php?repetir=sucesso');
        exit;

    }

}

$dados = "
    SELECT
        b.nome AS barbeiro,
        s.nome AS servico
    FROM primecut.usuarios u
    JOIN primecut.barbeiros b
        ON b.id = u.barbeiro_favorito_id
    JOIN primecut.servicos s
        ON s.id = u.servico_favorito_id
    WHERE u.id = :usuario
";

$stmt = $pdo->prepare($dados);

$stmt->execute([
    ':usuario' => $usuario_id
]);

$favorito = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Repetir Meu Corte - Prime Cut</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body class="auth-page">

<div class="auth-card">

    <a href="dashboard.php" class="logo">
        <span class="logo-pc">PRIME</span>
        <span class="logo-cut">CUT</span>
    </a>

    <h2>Meu Corte de Sempre</h2>

    <p class="auth-sub">
        Repita seu corte favorito rapidamente.
    </p>

    <?php if($mensagem): ?>

        <div class="alert alert-error">
            <?= $mensagem ?>
        </div>

    <?php endif; ?>

    <div class="dash-card" style="margin-bottom:20px;">

        <div class="dash-card-label">
            Barbeiro Favorito
        </div>

        <div class="dash-card-value">
            <?= $favorito['barbeiro'] ?>
        </div>

        <br>

        <div class="dash-card-label">
            Serviço Favorito
        </div>

        <div class="dash-card-value gold">
            <?= $favorito['servico'] ?>
        </div>

    </div>

    <form method="POST">

        <div class="form-group">

            <label>Data</label>

            <input
                type="date"
                name="data_agendamento"
                class="form-control"
                required
            >

        </div>

        <div class="form-group">

            <label>Horário</label>

            <select
                name="horario"
                class="form-control"
                required
            >

                <option value="">Selecione</option>

                <option>09:00</option>
                <option>10:00</option>
                <option>11:00</option>
                <option>12:00</option>
                <option>13:00</option>
                <option>14:00</option>
                <option>15:00</option>
                <option>16:00</option>
                <option>17:00</option>
                <option>18:00</option>

            </select>

        </div>

        <button type="submit" class="btn btn-gold w-full">
            Repetir Meu Corte
        </button>

    </form>

</div>

</body>
</html>