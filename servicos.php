<?php
session_start();

$services = [
  ['icon' => '✂', 'name' => 'Corte Masculino', 'desc' => 'Técnica precisa para cada tipo de cabelo e formato de rosto.', 'price' => '45', 'time' => '40 min'],
  ['icon' => '🪒', 'name' => 'Barba', 'desc' => 'Modelagem, hidratação e acabamento perfeito para sua barba.', 'price' => '35', 'time' => '30 min'],
  ['icon' => '⭐', 'name' => 'Corte + Barba', 'desc' => 'A combinação perfeita com desconto especial.', 'price' => '70', 'time' => '60 min'],
  ['icon' => '💎', 'name' => 'Pigmentação', 'desc' => 'Cobertura natural de grisalhos com resultado premium.', 'price' => '120', 'time' => '90 min'],
  ['icon' => '✨', 'name' => 'Hidratação', 'desc' => 'Nutrição profunda para cabelos ressecados ou danificados.', 'price' => '55', 'time' => '45 min'],
  ['icon' => '👑', 'name' => 'Plano VIP', 'desc' => 'Corte + barba semanal com prioridade e descontos exclusivos.', 'price' => '249/mês', 'time' => 'Semanal'],
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
        <a href="cliente/dashboard.php" class="btn btn-ghost">Minha Área</a>
        <a href="agendamento.php" class="btn btn-gold">Agendar</a>
      <?php else: ?>
        <a href="login.php" class="btn btn-ghost">Entrar</a>
        <a href="agendamento.php" class="btn btn-gold">Agendar Agora</a>
      <?php endif; ?>
    </div>

    <button class="nav-toggle" id="navToggle">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<section class="hero">
  <div class="hero-bg">
    <div class="hero-grid"></div>
  </div>

  <div class="hero-content">
    <div class="hero-badge">✦ Serviços Premium</div>

    <h1 class="hero-title">
      Serviços para<br>
      <span class="gold">elevar seu estilo.</span>
    </h1>

    <p class="hero-sub">
      Escolha entre cortes, barba, hidratação, pigmentação e planos exclusivos.
      Cada serviço foi pensado para entregar estilo, precisão e experiência premium.
    </p>

    <div class="hero-btns">
      <a href="agendamento.php" class="btn btn-gold btn-lg">Agendar Serviço</a>
      <a href="diagnostico.php" class="btn btn-outline btn-lg">Fazer Diagnóstico</a>
    </div>
  </div>

  <div class="hero-img-wrap">
    <div class="hero-img-frame">
      <div class="hero-img-placeholder">
        <svg viewBox="0 0 400 500" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect width="400" height="500" fill="#1a1a1a"/>
          <circle cx="200" cy="150" r="75" fill="#2a2a2a"/>
          <rect x="110" y="250" width="180" height="190" rx="10" fill="#2a2a2a"/>
          <text x="200" y="410" text-anchor="middle" fill="#C9A84C" font-family="serif" font-size="16">SERVIÇOS PRIME</text>
        </svg>
      </div>
      <div class="hero-img-accent"></div>
    </div>
  </div>
</section>

<section class="section services-section">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Tabela de serviços</span>
      <h2>Nossos <span class="gold">serviços</span></h2>
      <p>Escolha o serviço ideal e agende seu horário online.</p>
    </div>

    <div class="services-grid">
      <?php foreach($services as $s): ?>
        <div class="service-card">
          <div class="service-icon"><?= $s['icon'] ?></div>
          <h3><?= $s['name'] ?></h3>
          <p><?= $s['desc'] ?></p>

          <div class="service-footer">
            <div class="service-meta">
              <span class="service-price">R$ <?= $s['price'] ?></span>
              <span class="service-time"><?= $s['time'] ?></span>
            </div>

            <a href="agendamento.php" class="btn btn-sm btn-gold">Agendar</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section cta-section">
  <div class="container">
    <div class="cta-box">
      <div class="cta-content">
        <h2>Pronto para <span class="gold">agendar?</span></h2>
        <p>Escolha seu serviço, barbeiro e horário de forma rápida e prática.</p>

        <div class="cta-btns">
          <a href="agendamento.php" class="btn btn-gold btn-lg">Agendar Online</a>
          <a href="barbeiros.php" class="btn btn-ghost btn-lg">Ver Barbeiros</a>
        </div>
      </div>
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
        <p>Barbearia premium em São Paulo. Estilo, precisão e experiência incomparável desde 2018.</p>
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
          <li><a href="cliente/fidelidade.php">Fidelidade</a></li>
        </ul>
      </div>

      <div class="footer-contact">
        <h5>Contato</h5>
        <p>📍 Rua das Palmeiras, 123<br>Pinheiros, São Paulo - SP</p>
        <p>📞 (11) 9999-9999</p>
        <p>🕐 Seg–Sáb: 9h às 20h</p>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© 2025 Prime Cut Barbearia. Todos os direitos reservados.</p>
    </div>
  </div>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>