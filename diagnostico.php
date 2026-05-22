<?php

session_start();

require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['user_id'];
$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tipo_cabelo = $_POST['tipo_cabelo'];
    $estilo = $_POST['estilo_desejado'];
    $usa_barba = $_POST['usa_barba'];
    $frequencia = $_POST['frequencia'];

    $servico = 'Corte Masculino';
    $barbeiro = 'Lucas Andrade';
    $retorno = 'Retorno recomendado em 30 dias';

    if ($usa_barba === 'sim') {
        $servico = 'Corte + Barba';
        $barbeiro = 'Rafael Souza';
        $retorno = 'Retorno recomendado em 20 dias';
    }

    if ($estilo === 'social') {
        $servico = 'Corte Masculino';
        $barbeiro = 'Bruno Martins';
        $retorno = 'Retorno recomendado em 25 dias';
    }

    if ($estilo === 'premium') {
        $servico = 'Corte + Barba';
        $barbeiro = 'Rafael Souza';
        $retorno = 'Retorno recomendado em 15 dias';
    }

    $sql = "
        INSERT INTO primecut.diagnosticos
        (
            usuario_id,
            tipo_cabelo,
            estilo_desejado,
            usa_barba,
            frequencia,
            servico_sugerido,
            barbeiro_sugerido,
            retorno_sugerido
        )
        VALUES
        (
            :usuario,
            :tipo_cabelo,
            :estilo,
            :usa_barba,
            :frequencia,
            :servico,
            :barbeiro,
            :retorno
        )
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':usuario' => $usuario_id,
        ':tipo_cabelo' => $tipo_cabelo,
        ':estilo' => $estilo,
        ':usa_barba' => $usa_barba,
        ':frequencia' => $frequencia,
        ':servico' => $servico,
        ':barbeiro' => $barbeiro,
        ':retorno' => $retorno
    ]);

    $resultado = [
        'servico' => $servico,
        'barbeiro' => $barbeiro,
        'retorno' => $retorno
    ];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Diagnóstico de Estilo - Prime Cut</title>

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="diagnostic-page">

    <div class="booking-panel">

        <h3>Diagnóstico de Estilo</h3>

        <p class="auth-sub">
            Responda algumas perguntas e receba uma sugestão personalizada.
        </p>

        <?php if($resultado): ?>

            <div class="alert alert-success">
                Diagnóstico concluído com sucesso!
            </div>

            <div class="dash-card" style="margin-bottom:25px;">

                <div class="dash-card-label">Serviço sugerido</div>
                <div class="dash-card-value gold">
                    <?= $resultado['servico'] ?>
                </div>

                <br>

                <div class="dash-card-label">Barbeiro indicado</div>
                <div class="dash-card-value">
                    <?= $resultado['barbeiro'] ?>
                </div>

                <br>

                <div class="dash-card-label">Retorno sugerido</div>
                <p><?= $resultado['retorno'] ?></p>

            </div>

            <a href="agendamento.php" class="btn btn-gold">
                Agendar agora
            </a>

            <a href="cliente/dashboard.php" class="btn btn-outline">
                Ir para minha área
            </a>

        <?php else: ?>

            <form method="POST">

                <div class="form-group">
                    <label>Tipo de cabelo</label>
                    <select name="tipo_cabelo" class="form-control" required>
                        <option value="">Selecione</option>
                        <option value="liso">Liso</option>
                        <option value="ondulado">Ondulado</option>
                        <option value="cacheado">Cacheado</option>
                        <option value="crespo">Crespo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Estilo desejado</label>
                    <select name="estilo_desejado" class="form-control" required>
                        <option value="">Selecione</option>
                        <option value="moderno">Moderno</option>
                        <option value="social">Social</option>
                        <option value="degrade">Degradê</option>
                        <option value="premium">Premium completo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Você usa barba?</label>
                    <select name="usa_barba" class="form-control" required>
                        <option value="">Selecione</option>
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Com que frequência corta o cabelo?</label>
                    <select name="frequencia" class="form-control" required>
                        <option value="">Selecione</option>
                        <option value="15">A cada 15 dias</option>
                        <option value="30">A cada 30 dias</option>
                        <option value="45">A cada 45 dias ou mais</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-gold w-full">
                    Ver meu diagnóstico
                </button>

            </form>

        <?php endif; ?>

    </div>

</div>

</body>
</html>