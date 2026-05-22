<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once '../includes/admin_auth.php';
require_once '../config/database.php';

$sql = "
    SELECT
        a.id,
        u.nome AS cliente,
        b.nome AS barbeiro,
        s.nome AS servico,
        a.data_agendamento,
        a.horario,
        a.status
    FROM primecut.agendamentos a
    JOIN primecut.usuarios u
        ON u.id = a.usuario_id
    JOIN primecut.barbeiros b
        ON b.id = a.barbeiro_id
    JOIN primecut.servicos s
        ON s.id = a.servico_id
    ORDER BY a.data_agendamento DESC, a.horario DESC
";

$agendamentos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Prime Cut</title>

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

            <li>
                <a href="#" class="active">
                    Agendamentos
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

            <h1>Painel Administrativo</h1>

            <p>
                Gerencie todos os agendamentos da barbearia.
            </p>

        </div>

        <div class="table-section">

            <div class="table-section-header">
                <h3>Todos os Agendamentos</h3>
            </div>

            <table>

                <thead>

                    <tr>
                        <th>Cliente</th>
                        <th>Serviço</th>
                        <th>Barbeiro</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach($agendamentos as $a): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($a['cliente']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($a['servico']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($a['barbeiro']) ?>
                            </td>

                            <td>
                                <?= date('d/m/Y', strtotime($a['data_agendamento'])) ?>
                            </td>

                            <td>
                                <?= substr($a['horario'], 0, 5) ?>
                            </td>

                            <td>

                                <?php if($a['status'] == 'cancelado'): ?>

                                    <span class="badge badge-red">
                                        Cancelado
                                    </span>

                                <?php elseif($a['status'] == 'concluido'): ?>

                                    <span class="badge badge-green">
                                        Concluído
                                    </span>

                                <?php elseif($a['status'] == 'confirmado'): ?>

                                    <span class="badge badge-green">
                                        Confirmado
                                    </span>

                                <?php else: ?>

                                    <span class="badge badge-gold">
                                        <?= ucfirst($a['status']) ?>
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <?php if(
                                    $a['status'] !== 'cancelado'
                                    &&
                                    $a['status'] !== 'concluido'
                                ): ?>

                                    <a
                                        href="atualizar_status.php?id=<?= $a['id'] ?>&status=confirmado"
                                        class="btn btn-sm btn-outline"
                                    >
                                        Confirmar
                                    </a>

                                    <a
                                        href="atualizar_status.php?id=<?= $a['id'] ?>&status=concluido"
                                        class="btn btn-sm btn-gold"
                                    >
                                        Concluir
                                    </a>

                                    <a
                                        href="atualizar_status.php?id=<?= $a['id'] ?>&status=cancelado"
                                        class="btn btn-sm btn-outline"
                                    >
                                        Cancelar
                                    </a>

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