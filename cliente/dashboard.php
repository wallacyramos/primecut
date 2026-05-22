<?php

session_start();

require_once '../includes/auth.php';
require_once '../config/database.php';

$usuario_id = $_SESSION['user_id'];

$sql = "
    SELECT
        a.*,
        b.nome AS barbeiro,
        s.nome AS servico
    FROM primecut.agendamentos a
    JOIN primecut.barbeiros b ON b.id = a.barbeiro_id
    JOIN primecut.servicos s ON s.id = a.servico_id
    WHERE a.usuario_id = :usuario
    ORDER BY a.data_agendamento DESC, a.horario DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':usuario' => $usuario_id
]);

$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$vip = $pdo->prepare("
    SELECT
        a.id AS assinatura_id,
        a.data_inicio,
        p.nome,
        p.descricao,
        p.preco,
        p.cortes_mes
    FROM primecut.assinaturas a
    JOIN primecut.planos p ON p.id = a.plano_id
    WHERE a.usuario_id = :usuario
    AND a.status = 'ativa'
    LIMIT 1
");

$vip->execute([
    ':usuario' => $usuario_id
]);

$planoVip = $vip->fetch(PDO::FETCH_ASSOC);

$cortesUsados = 0;
$saldoRestante = 0;

if ($planoVip) {
    $stmt = $pdo->prepare("
        SELECT COUNT(*)
        FROM primecut.agendamentos
        WHERE usuario_id = :usuario
        AND status = 'concluido'
        AND data_agendamento >= :data_inicio
    ");

    $stmt->execute([
        ':usuario' => $usuario_id,
        ':data_inicio' => $planoVip['data_inicio']
    ]);

    $cortesUsados = $stmt->fetchColumn();

    if ($planoVip['cortes_mes'] >= 999) {
        $saldoRestante = 'Ilimitado';
    } else {
        $saldoRestante = max(0, $planoVip['cortes_mes'] - $cortesUsados);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Prime Cut</title>

<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="dashboard-layout">

    <aside class="sidebar">

        <div class="logo">
            <span class="logo-pc">PRIME</span>
            <span class="logo-cut">CUT</span>
        </div>

        <ul class="sidebar-nav">
            <li><a href="#" class="active">Dashboard</a></li>
            <li><a href="../agendamento.php">Novo Agendamento</a></li>
            <li><a href="../planos.php">Planos VIP</a></li>
            <li><a href="meu_corte.php">Meu Corte de Sempre</a></li>
            <li><a href="repetir_corte.php">Repetir Meu Corte</a></li>
            <li><a href="#">Fidelidade</a></li>
        </ul>

        <div class="sidebar-logout">
            <a href="../logout.php">Sair</a>
        </div>

    </aside>

    <main class="main-content">

        <div class="page-header">
            <h1>
                Bem-vindo,
                <?= htmlspecialchars($_SESSION['user_nome']) ?>
            </h1>

            <p>
                Gerencie seus horários, plano VIP e benefícios.
            </p>
        </div>

        <?php if(isset($_GET['vip']) && $_GET['vip'] == 'ativo'): ?>
            <div class="alert alert-success">
                Plano VIP ativado com sucesso!
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['corte']) && $_GET['corte'] == 'salvo'): ?>
            <div class="alert alert-success">
                Meu corte de sempre foi salvo com sucesso!
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['corte']) && $_GET['corte'] == 'erro'): ?>
            <div class="alert alert-error">
                Você precisa ter pelo menos um agendamento ativo para salvar seu corte de sempre.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['repetir']) && $_GET['repetir'] == 'sucesso'): ?>
            <div class="alert alert-success">
                Novo agendamento criado com sucesso usando seu corte favorito!
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['repetir']) && $_GET['repetir'] == 'erro'): ?>
            <div class="alert alert-error">
                Você ainda não possui um corte favorito salvo.
            </div>
        <?php endif; ?>

        <div class="dash-grid">

            <div class="dash-card">
                <div class="dash-card-label">Total de Agendamentos</div>
                <div class="dash-card-value gold">
                    <?= count($agendamentos) ?>
                </div>
            </div>

            <div class="dash-card">
                <div class="dash-card-label">Pontos de Fidelidade</div>
                <div class="dash-card-value">
                    <?= count($agendamentos) * 10 ?>
                </div>
            </div>

            <div class="dash-card">
                <div class="dash-card-label">Plano Atual</div>
                <div class="dash-card-value gold">
                    <?= $planoVip ? htmlspecialchars($planoVip['nome']) : 'Free' ?>
                </div>
            </div>

            <div class="dash-card">
                <div class="dash-card-label">Saldo do Plano</div>
                <div class="dash-card-value">
                    <?= $planoVip ? $saldoRestante : 0 ?>
                </div>
            </div>

        </div>

        <?php if($planoVip): ?>

            <div class="dash-card" style="margin-bottom:30px;">

                <div class="dash-card-label">
                    Plano VIP Ativo
                </div>

                <div class="dash-card-value gold">
                    <?= htmlspecialchars($planoVip['nome']) ?>
                </div>

                <p style="margin-top:12px;">
                    <?= htmlspecialchars($planoVip['descricao']) ?>
                </p>

                <p style="margin-top:12px;">
                    Cortes usados:
                    <strong>
                        <?= $cortesUsados ?>
                        de
                        <?= $planoVip['cortes_mes'] >= 999 ? 'Ilimitado' : $planoVip['cortes_mes'] ?>
                    </strong>
                </p>

                <p>
                    Saldo restante:
                    <strong><?= $saldoRestante ?></strong>
                </p>

            </div>

        <?php else: ?>

            <div class="dash-card" style="margin-bottom:30px;">

                <div class="dash-card-label">
                    Você ainda não possui um plano VIP
                </div>

                <p style="margin:12px 0 20px;">
                    Assine um plano para ter prioridade no agendamento e benefícios exclusivos.
                </p>

                <a href="../planos.php" class="btn btn-gold">
                    Ver Planos VIP
                </a>

            </div>

        <?php endif; ?>

        <div style="display:flex; gap:12px; margin-bottom:30px; flex-wrap:wrap;">

            <a href="../agendamento.php" class="btn btn-gold">
                Agendar horário
            </a>

            <a href="meu_corte.php" class="btn btn-outline">
                Salvar Meu Corte de Sempre
            </a>

            <a href="repetir_corte.php" class="btn btn-gold">
                Repetir Meu Corte
            </a>

        </div>

        <div class="table-section">

            <div class="table-section-header">
                <h3>Meus Agendamentos</h3>
            </div>

            <table>

                <thead>
                    <tr>
                        <th>Serviço</th>
                        <th>Barbeiro</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach($agendamentos as $agendamento): ?>

                        <tr>

                            <td><?= htmlspecialchars($agendamento['servico']) ?></td>

                            <td><?= htmlspecialchars($agendamento['barbeiro']) ?></td>

                            <td>
                                <?= date('d/m/Y', strtotime($agendamento['data_agendamento'])) ?>
                            </td>

                            <td>
                                <?= substr($agendamento['horario'], 0, 5) ?>
                            </td>

                            <td>

                                <?php if($agendamento['status'] == 'cancelado'): ?>

                                    <span class="badge badge-red">Cancelado</span>

                                <?php elseif($agendamento['status'] == 'concluido'): ?>

                                    <span class="badge badge-green">Concluído</span>

                                <?php elseif($agendamento['status'] == 'confirmado'): ?>

                                    <span class="badge badge-green">Confirmado</span>

                                <?php else: ?>

                                    <span class="badge badge-gold">
                                        <?= ucfirst($agendamento['status']) ?>
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <?php

                                    $mensagemWhats = "Olá, quero confirmar meu agendamento na Prime Cut:%0A"
                                        . "Serviço: " . $agendamento['servico'] . "%0A"
                                        . "Barbeiro: " . $agendamento['barbeiro'] . "%0A"
                                        . "Data: " . date('d/m/Y', strtotime($agendamento['data_agendamento'])) . "%0A"
                                        . "Horário: " . substr($agendamento['horario'], 0, 5);

                                    $linkWhats =
                                        "https://wa.me/5511999999999?text="
                                        . $mensagemWhats;

                                ?>

                                <?php if(
                                    $agendamento['status'] !== 'cancelado'
                                    &&
                                    $agendamento['status'] !== 'concluido'
                                ): ?>

                                    <div style="display:flex; gap:8px; flex-wrap:wrap;">

                                        <a
                                            href="<?= $linkWhats ?>"
                                            target="_blank"
                                            class="btn btn-sm btn-gold"
                                        >
                                            WhatsApp
                                        </a>

                                        <a
                                            href="cancelar_agendamento.php?id=<?= $agendamento['id'] ?>"
                                            class="btn btn-sm btn-outline"
                                            onclick="return confirm('Deseja cancelar este agendamento?')"
                                        >
                                            Cancelar
                                        </a>

                                    </div>

                                <?php else: ?>

                                    <span class="badge badge-gray">
                                        Finalizado
                                    </span>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>
</html>