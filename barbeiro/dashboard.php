<?php

session_start();

require_once '../includes/barbeiro_auth.php';
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
    WHERE a.data_agendamento = CURRENT_DATE
    ORDER BY a.horario ASC
";

$agendamentos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

?>