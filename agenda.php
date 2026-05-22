<?php

session_start();

require_once 'config/database.php';

$sql = "
    SELECT
        a.id,
        a.data_agendamento,
        a.horario,
        a.status,
        u.nome AS cliente,
        b.nome AS barbeiro,
        s.nome AS servico
    FROM primecut.agendamentos a
    JOIN primecut.usuarios u
        ON u.id = a.usuario_id
    JOIN primecut.barbeiros b
        ON b.id = a.barbeiro_id
    JOIN primecut.servicos s
        ON s.id = a.servico_id
";

$agendamentos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$eventos = [];

foreach($agendamentos as $a){

    $eventos[] = [
        'title' =>
            $a['servico']
            . ' - '
            . $a['cliente'],

        'start' =>
            $a['data_agendamento']
            . 'T'
            . $a['horario'],

        'color' =>
            $a['status'] == 'cancelado'
            ? '#dc3545'
            : '#d4af37'
    ];

}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Agenda - Prime Cut</title>

<link
href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css"
rel="stylesheet"
/>

<link rel="stylesheet" href="assets/css/style.css">

<style>

.calendar-wrapper{

    padding:40px;

}

#calendar{

    background:#111;

    padding:20px;

    border-radius:20px;

}

.fc{

    color:white;

}

.fc-toolbar-title{

    color:#d4af37;

}

.fc-button{

    background:#d4af37 !important;
    border:none !important;
    color:#111 !important;

}

</style>

</head>
<body>

<div class="calendar-wrapper">

    <div id="calendar"></div>

</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {

    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'timeGridWeek',

        locale: 'pt-br',

        height: 'auto',

        slotMinTime: "08:00:00",
        slotMaxTime: "20:00:00",

        events: <?= json_encode($eventos) ?>

    });

    calendar.render();

});

</script>

</body>
</html>