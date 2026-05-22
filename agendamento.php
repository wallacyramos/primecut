<?php

session_start();

require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$barbeiros = $pdo->query("SELECT * FROM primecut.barbeiros ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

$servicos = $pdo->query("SELECT * FROM primecut.servicos ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario_id = $_SESSION['user_id'];
    $barbeiro_id = $_POST['barbeiro_id'];
    $servico_id = $_POST['servico_id'];
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

    if ($check->fetch()) {

        $mensagem = "Horário já ocupado.";

    } else {

        $sql = "
            INSERT INTO primecut.agendamentos
            (
                usuario_id,
                barbeiro_id,
                servico_id,
                data_agendamento,
                horario
            )
            VALUES
            (
                :usuario,
                :barbeiro,
                :servico,
                :data,
                :horario
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

        $mensagem = "Agendamento realizado com sucesso!";

    }

}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agendamento - Prime Cut</title>

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="booking-page">

    <div class="booking-panel">

        <h3>Agendar Horário</h3>

        <?php if($mensagem): ?>

            <div class="alert alert-info">
                <?= $mensagem ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <div class="form-group">
                <label>Escolha o barbeiro</label>

                <select name="barbeiro_id" class="form-control" required>

                    <option value="">
                        Selecione
                    </option>

                    <?php foreach($barbeiros as $barbeiro): ?>

                        <option value="<?= $barbeiro['id'] ?>">
                            <?= $barbeiro['nome'] ?>
                            -
                            <?= $barbeiro['especialidade'] ?>
                        </option>

                    <?php endforeach; ?>

                </select>
            </div>

            <div class="form-group">
                <label>Escolha o serviço</label>

                <select name="servico_id" class="form-control" required>

                    <option value="">
                        Selecione
                    </option>

                    <?php foreach($servicos as $servico): ?>

                        <option value="<?= $servico['id'] ?>">
                            <?= $servico['nome'] ?>
                            -
                            R$ <?= number_format($servico['preco'], 2, ',', '.') ?>
                        </option>

                    <?php endforeach; ?>

                </select>
            </div>

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

                <select name="horario" class="form-control" required>

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
                Confirmar Agendamento
            </button>

        </form>

    </div>

</div>

</body>
</html>