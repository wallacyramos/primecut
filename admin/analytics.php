<?php

session_start();

require_once '../includes/admin_auth.php';
require_once '../config/database.php';

$totalClientes = $pdo->query("
    SELECT COUNT(*)
    FROM primecut.usuarios
    WHERE tipo = 'cliente'
")->fetchColumn();

$totalAgendamentos = $pdo->query("
    SELECT COUNT(*)
    FROM primecut.agendamentos
")->fetchColumn();

$faturamento = $pdo->query("
    SELECT COALESCE(SUM(s.preco),0)
    FROM primecut.agendamentos a
    JOIN primecut.servicos s
        ON s.id = a.servico_id
    WHERE a.status = 'concluido'
")->fetchColumn();

$maisRequisitado = $pdo->query("
    SELECT
        b.nome,
        COUNT(*) total
    FROM primecut.agendamentos a
    JOIN primecut.barbeiros b
        ON b.id = a.barbeiro_id
    GROUP BY b.nome
    ORDER BY total DESC
    LIMIT 1
")->fetch(PDO::FETCH_ASSOC);

$grafico = $pdo->query("
    SELECT
        DATE(data_agendamento) data,
        COUNT(*) total
    FROM primecut.agendamentos
    GROUP BY data
    ORDER BY data
")->fetchAll(PDO::FETCH_ASSOC);

$labels = [];
$valores = [];

foreach($grafico as $g){

    $labels[] = date('d/m', strtotime($g['data']));
    $valores[] = $g['total'];

}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Analytics - Prime Cut</title>

<link rel="stylesheet" href="../assets/css/style.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

<div class="dashboard-layout">

    <aside class="sidebar">

        <div class="logo">
            <span class="logo-pc">PRIME</span>
            <span class="logo-cut">CUT</span>
        </div>

        <ul class="sidebar-nav">

            <li>
                <a href="dashboard.php">
                    Agendamentos
                </a>
            </li>

            <li>
                <a href="#" class="active">
                    Analytics
                </a>
            </li>

        </ul>

        <div class="sidebar-logout">
            <a href="../logout.php">
                Sair
            </a>
        </div>

    </aside>

    <main class="main-content">

        <div class="page-header">

            <h1>Analytics da Barbearia</h1>

            <p>
                Indicadores inteligentes da operação.
            </p>

        </div>

        <div class="dash-grid">

            <div class="dash-card">

                <div class="dash-card-label">
                    Clientes
                </div>

                <div class="dash-card-value gold">
                    <?= $totalClientes ?>
                </div>

            </div>

            <div class="dash-card">

                <div class="dash-card-label">
                    Agendamentos
                </div>

                <div class="dash-card-value">
                    <?= $totalAgendamentos ?>
                </div>

            </div>

            <div class="dash-card">

                <div class="dash-card-label">
                    Faturamento
                </div>

                <div class="dash-card-value gold">
                    R$ <?= number_format($faturamento, 2, ',', '.') ?>
                </div>

            </div>

            <div class="dash-card">

                <div class="dash-card-label">
                    Barbeiro Mais Requisitado
                </div>

                <div class="dash-card-value">
                    <?= $maisRequisitado['nome'] ?? '--' ?>
                </div>

            </div>

        </div>

        <div class="table-section">

            <div class="table-section-header">
                <h3>Atendimentos por Dia</h3>
            </div>

            <canvas id="grafico"></canvas>

        </div>

    </main>

</div>

<script>

const ctx = document.getElementById('grafico');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: <?= json_encode($labels) ?>,

        datasets: [{

            label: 'Atendimentos',

            data: <?= json_encode($valores) ?>,

            borderColor: '#d4af37',

            backgroundColor: 'rgba(212,175,55,.2)',

            tension: .3,

            fill: true

        }]

    }

});

</script>

</body>
</html>