<?php
session_start();

$services = [
  [
    'icon' => '✂',
    'name' => 'Corte Masculino',
    'desc' => 'Técnica precisa para cada tipo de cabelo e formato de rosto.',
    'price' => '45',
    'time' => '40 min'
  ],
  [
    'icon' => '🪒',
    'name' => 'Barba',
    'desc' => 'Modelagem, hidratação e acabamento perfeito para sua barba.',
    'price' => '35',
    'time' => '30 min'
  ],
  [
    'icon' => '⭐',
    'name' => 'Corte + Barba',
    'desc' => 'A combinação perfeita com desconto especial.',
    'price' => '70',
    'time' => '60 min'
  ],
  [
    'icon' => '💎',
    'name' => 'Pigmentação',
    'desc' => 'Cobertura natural de grisalhos com resultado premium.',
    'price' => '120',
    'time' => '90 min'
  ],
  [
    'icon' => '✨',
    'name' => 'Hidratação',
    'desc' => 'Nutrição profunda para cabelos ressecados ou danificados.',
    'price' => '55',
    'time' => '45 min'
  ],
  [
    'icon' => '👑',
    'name' => 'Plano VIP',
    'desc' => 'Corte + barba semanal com prioridade e descontos exclusivos.',
    'price' => '249/mês',
    'time' => 'Semanal'
  ],
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Serviços — Prime Cut</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Syne:wght@400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

<style>

.services-section{
    padding:120px 0 80px;
}

.services-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:30px;
    margin-top:60px;
}

.service-card{
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:24px;
    padding:35px;
    transition:0.3s;
    backdrop-filter:blur(10px);
}

.service-card:hover{
    transform:translateY(-6px);
    border-color:#C9A84C;
    box-shadow:0 10px 40px rgba(201,168,76,0.15);
}

.service-icon{
    font-size:42px;
    margin-bottom:20px;
}

.service-card h3{
    font-size:28px;
    margin-bottom:15px;
    color:#fff;
}

.service-card p{
    color:#b8b8b8;
    line-height:1.7;
    margin-bottom:25px;
}

.service-footer{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
}

.service-meta{
    display:flex;
    flex-direction:column;
}

.service-price{
    font-size:28px;
    font-weight:bold;
    color:#C9A84C;
}

.service-time{
    color:#999;
    font-size:14px;
}

.hero-services{
    padding-top:180px;
    padding-bottom:100px;
    text-align:center;
}

.hero-services h1{
    font-size:72px;
    margin-bottom:20px;
    line-height:1.1;
}

.hero-services p{
    max-width:700px;
    margin:auto;
    color:#b8b8b8;
    font-size:18px;
    line-height:1.8;
}

@media(max-width:768px){

.hero-services{
    padding-top:140px;
}

.hero-services h1{
    font-size:46px;
}

.service-footer{
    flex-direction:column;
    align-items:flex-start;
}

}

</style>

</head>

<body>

<nav class="nav" id="nav">

<div class="nav-inner">

<a href="index.php" class="logo">
<span class="logo-pc">PRIME</span><span class="logo-cut">CUT</span>
</a>

<ul class="nav-links">
<li><a href="servicos.php">Serviços</a></li>
<li><a href="barbeiros.php">Barbeiros</a></li>
<li><a href="diagnostico.php">Diagnóstico</a></li>
<li><a href="contato.php">Contato</a></li>
</ul>

<div class="nav-ctas">

<?php if(isset($_SESSION['user_id'])): ?>

<a href="cliente/dashboard.php" class="btn btn-ghost">
Minha Área
</a>

<a href="agendamento.php" class="btn btn-gold">
Agendar
</a>

<?php else: ?>

<a href="login.php" class="btn btn-ghost">
Entrar
</a>

<a href="agendamento.php" class="btn btn-gold">
Agendar Agora
</a>

<?php endif; ?>

</div>

<button class="nav-toggle" id="navToggle">
<span></span>
<span></span>
<span></span>
</button>

</div>

</nav>

<section class="hero-services">

<div class="container">

<div class="hero-badge">
✦ Serviços Premium
</div>

<h1>
Nossos <span class="gold">Serviços</span>
</h1>

<p>
Escolha o serviço ideal e agende seu horário online com barbeiros especializados e experiência premium.
</p>

<div class="hero-btns" style="margin-top:40px; justify-content:center;">

<a href="agendamento.php" class="btn btn-gold btn-lg">
Agendar Agora
</a>

<a href="barbeiros.php" class="btn btn-outline btn-lg">
Ver Barbeiros
</a>

</div>

</div>

</section>

<section class="services-section">

<div class="container">

<div class="services-grid">

<?php foreach($services as $service): ?>

<div class="service-card">

<div class="service-icon">
<?= $service['icon']; ?>
</div>

<h3>
<?= $service['name']; ?>
</h3>

<p>
<?= $service['desc']; ?>
</p>

<div class="service-footer">

<div class="service-meta">

<span class="service-price">
R$ <?= $service['price']; ?>
</span>

<span class="service-time">
<?= $service['time']; ?>
</span>

</div>

<a href="agendamento.php" class="btn btn-gold">
Agendar
</a>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

</section>

<footer class="footer">

<div class="container">

<div class="footer-grid">

<div class="footer-brand">

<div class="logo">
<span class="logo-pc">PRIME</span><span class="logo-cut">CUT</span>
</div>

<p>
Barbearia premium em São Paulo. Estilo, precisão e experiência incomparável desde 2018.
</p>

</div>

<div class="footer-links">

<h5>Navegação</h5>

<ul>
<li><a href="servicos.php">Serviços</a></li>
<li><a href="barbeiros.php">Barbeiros</a></li>
<li><a href="agendamento.php">Agendar</a></li>
<li><a href="diagnostico.php">Diagnóstico</a></li>
</ul>

</div>

<div class="footer-links">

<h5>Conta</h5>

<ul>
<li><a href="login.php">Login</a></li>
<li><a href="cadastro.php">Cadastro</a></li>
<li><a href="cliente/dashboard.php">Minha Área</a></li>
</ul>

</div>

<div class="footer-contact">

<h5>Contato</h5>

<p>📍 Rua das Palmeiras, 123</p>
<p>📞 (11) 96030-3909</p>
<p>🕐 Seg–Sáb: 9h às 20h</p>

</div>

</div>

<div class="footer-bottom">
<p>© 2026 Prime Cut Barbearia. Todos os direitos reservados.</p>
</div>

</div>

</footer>

<script src="assets/js/main.js"></script>

</body>
</html>