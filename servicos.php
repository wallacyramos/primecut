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

<title>Serviços | Prime Cut</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#0d0d0d;
    color:white;
    font-family:Arial, Helvetica, sans-serif;
}

header{
    width:100%;
    padding:20px 50px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:#111;
    border-bottom:1px solid #222;
}

.logo{
    font-size:28px;
    font-weight:bold;
    color:#8b5cf6;
}

nav a{
    color:white;
    text-decoration:none;
    margin-left:20px;
    transition:.3s;
}

nav a:hover{
    color:#8b5cf6;
}

.container{
    width:90%;
    max-width:1200px;
    margin:auto;
    padding:60px 0;
}

.titulo{
    text-align:center;
    margin-bottom:50px;
}

.titulo h1{
    font-size:48px;
    margin-bottom:10px;
}

.titulo p{
    color:#999;
}

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:25px;
}

.card{
    background:#151515;
    border:1px solid #262626;
    border-radius:18px;
    padding:30px;
    transition:.3s;
}

.card:hover{
    transform:translateY(-5px);
    border-color:#8b5cf6;
    box-shadow:0 0 25px rgba(139,92,246,.3);
}

.card h2{
    color:#8b5cf6;
    margin-bottom:20px;
}

.preco{
    font-size:32px;
    font-weight:bold;
    margin-bottom:15px;
}

.tempo{
    color:#aaa;
    margin-bottom:25px;
}

.botao{
    display:inline-block;
    width:100%;
    text-align:center;
    background:#8b5cf6;
    padding:14px;
    border-radius:12px;
    color:white;
    text-decoration:none;
    font-weight:bold;
    transition:.3s;
}

.botao:hover{
    background:#7c3aed;
}

footer{
    text-align:center;
    padding:30px;
    color:#666;
    border-top:1px solid #222;
    margin-top:60px;
}

</style>

</head>

<body>

<header>

<div class="logo">
Prime Cut
</div>

<nav>
    <a href="barbeiros.php">Barbeiros</a>
    <a href="servicos.php">Serviços</a>
    <a href="agendamento.php">Agendamento</a>
    <a href="login.php">Login</a>
</nav>

</header>

<div class="container">

<div class="titulo">
    <h1>Nossos Serviços</h1>
    <p>Escolha o melhor serviço para seu estilo.</p>
</div>

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
Agendar Agora
</a>

</div>

<?php endforeach; ?>

</div>

</div>

<footer>
© <?php echo date('Y'); ?> Prime Cut Barber
</footer>

</body>
</html>