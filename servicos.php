<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servicos = [
    [
        "nome" => "Corte Degradê",
        "preco" => "R$ 35",
        "tempo" => "40 min"
    ],
    [
        "nome" => "Barba",
        "preco" => "R$ 25",
        "tempo" => "30 min"
    ],
    [
        "nome" => "Corte + Barba",
        "preco" => "R$ 55",
        "tempo" => "1h"
    ],
    [
        "nome" => "Sobrancelha",
        "preco" => "R$ 10",
        "tempo" => "10 min"
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Serviços - Prime Cut</title>

<style>

body{
    margin:0;
    font-family:Arial, Helvetica, sans-serif;
    background:#0f0f0f;
    color:white;
}

.container{
    width:90%;
    max-width:1200px;
    margin:auto;
    padding:40px 0;
}

h1{
    text-align:center;
    margin-bottom:40px;
    font-size:42px;
}

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
}

.card{
    background:#1a1a1a;
    padding:25px;
    border-radius:20px;
    transition:0.3s;
    border:1px solid #2d2d2d;
}

.card:hover{
    transform:translateY(-5px);
    border-color:#7c3aed;
    box-shadow:0 0 20px rgba(124,58,237,0.4);
}

.card h2{
    margin-top:0;
    color:#a855f7;
}

.preco{
    font-size:24px;
    font-weight:bold;
    margin:15px 0;
}

.tempo{
    color:#b3b3b3;
}

.botao{
    display:inline-block;
    margin-top:20px;
    padding:12px 20px;
    background:#7c3aed;
    color:white;
    text-decoration:none;
    border-radius:10px;
    transition:0.3s;
}

.botao:hover{
    background:#9333ea;
}

</style>

</head>

<body>

<div class="container">

<h1>Nossos Serviços ✂️</h1>

<div class="grid">

<?php foreach($servicos as $servico): ?>

<div class="card">

<h2><?= $servico['nome']; ?></h2>

<div class="preco">
<?= $servico['preco']; ?>
</div>

<div class="tempo">
Tempo médio: <?= $servico['tempo']; ?>
</div>

<a href="agendamento.php" class="botao">
Agendar
</a>

</div>

<?php endforeach; ?>

</div>

</div>

</body>
</html>