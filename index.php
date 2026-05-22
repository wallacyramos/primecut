<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Prime Cut — Barbearia Premium</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Syne:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- NAV -->
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
      <?php
      session_start();
      if(isset($_SESSION['user_id'])): ?>
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

<!-- HERO -->
<section class="hero">
  <div class="hero-bg">
    <div class="hero-grid"></div>
  </div>
  <div class="hero-content">
    <div class="hero-badge">✦ Desde 2018 · São Paulo</div>
    <h1 class="hero-title">
      Sua aparência.<br>
      <span class="gold">Redefinida.</span>
    </h1>
    <p class="hero-sub">Não é só um corte. É uma experiência completa de estilo, feita sob medida para você. Diagnóstico personalizado, barbeiros especializados e agendamento online.</p>
    <div class="hero-btns">
      <a href="agendamento.php" class="btn btn-gold btn-lg">Agendar Horário</a>
      <a href="diagnostico.php" class="btn btn-outline btn-lg">Fazer Diagnóstico</a>
    </div>
    <div class="hero-stats">
      <div class="stat"><span class="stat-n">4.800+</span><span class="stat-l">Clientes ativos</span></div>
      <div class="stat-div"></div>
      <div class="stat"><span class="stat-n">98%</span><span class="stat-l">Satisfação</span></div>
      <div class="stat-div"></div>
      <div class="stat"><span class="stat-n">6</span><span class="stat-l">Barbeiros expert</span></div>
    </div>
  </div>
  <div class="hero-img-wrap">
    <div class="hero-img-frame">
      <div class="hero-img-placeholder">
        <svg viewBox="0 0 400 500" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect width="400" height="500" fill="#1a1a1a"/>
          <circle cx="200" cy="160" r="80" fill="#2a2a2a"/>
          <rect x="120" y="260" width="160" height="200" rx="8" fill="#2a2a2a"/>
          <!-- Scissors icon decorative -->
          <path d="M180 140 L220 140 M180 155 L215 175 M215 140 L180 175" stroke="#C9A84C" stroke-width="2.5" stroke-linecap="round"/>
          <text x="200" y="420" text-anchor="middle" fill="#C9A84C" font-family="serif" font-size="14">PRIME CUT</text>
        </svg>
      </div>
      <div class="hero-img-accent"></div>
    </div>
  </div>
</section>

<!-- SERVIÇOS DESTAQUE -->
<section class="section services-section">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">O que oferecemos</span>
      <h2>Serviços <span class="gold">Prime</span></h2>
      <p>Cada serviço pensado para elevar seu estilo ao próximo nível.</p>
    </div>
    <div class="services-grid">
      <?php
      $services = [
        ['icon' => '✂', 'name' => 'Corte Masculino', 'desc' => 'Técnica precisa para cada tipo de cabelo e formato de rosto.', 'price' => '45', 'time' => '40 min'],
        ['icon' => '🪒', 'name' => 'Barba', 'desc' => 'Modelagem, hidratação e acabamento perfeito para sua barba.', 'price' => '35', 'time' => '30 min'],
        ['icon' => '⭐', 'name' => 'Corte + Barba', 'desc' => 'A combinação perfeita com desconto especial.', 'price' => '70', 'time' => '60 min'],
        ['icon' => '💎', 'name' => 'Pigmentação', 'desc' => 'Cobertura natural de grisalhos com resultado premium.', 'price' => '120', 'time' => '90 min'],
        ['icon' => '✨', 'name' => 'Hidratação', 'desc' => 'Nutrição profunda para cabelos ressecados ou danificados.', 'price' => '55', 'time' => '45 min'],
        ['icon' => '👑', 'name' => 'Plano VIP', 'desc' => 'Corte + barba semanal com prioridade e descontos exclusivos.', 'price' => '249/mês', 'time' => 'Semanal'],
      ];
      foreach($services as $s): ?>
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
    <div class="section-cta">
      <a href="servicos.php" class="btn btn-outline">Ver todos os serviços →</a>
    </div>
  </div>
</section>

<!-- DIFERENCIAIS -->
<section class="section features-section">
  <div class="container">
    <div class="features-grid">
      <div class="features-text">
        <span class="section-tag">Por que a Prime Cut</span>
        <h2>Além do corte.<br><span class="gold">Uma experiência.</span></h2>
        <p>Criamos uma plataforma completa para que você controle sua aparência com praticidade e inteligência.</p>
        <a href="diagnostico.php" class="btn btn-gold">Fazer Diagnóstico de Estilo</a>
      </div>
      <div class="features-cards">
        <?php
        $features = [
          ['ico' => '🧠', 'title' => 'Diagnóstico de Estilo', 'desc' => 'Responda perguntas rápidas e receba indicações personalizadas de serviço e barbeiro.'],
          ['ico' => '🔄', 'title' => 'Meu Corte de Sempre', 'desc' => 'Repita o mesmo serviço com um clique. Sem perder tempo escolhendo.'],
          ['ico' => '⭐', 'title' => 'Programa de Fidelidade', 'desc' => 'Acumule pontos a cada atendimento e troque por serviços ou descontos.'],
          ['ico' => '🔔', 'title' => 'Lembrete Inteligente', 'desc' => 'O sistema sabe quando está na hora do seu próximo corte e te avisa.'],
        ];
        foreach($features as $f): ?>
        <div class="feature-card">
          <div class="feature-ico"><?= $f['ico'] ?></div>
          <div>
            <h4><?= $f['title'] ?></h4>
            <p><?= $f['desc'] ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- PLANOS -->
<section class="section plans-section">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Assinatura</span>
      <h2>Planos <span class="gold">Prime</span></h2>
      <p>Assine e tenha acesso garantido às melhores experiências.</p>
    </div>
    <div class="plans-grid">
      <div class="plan-card">
        <div class="plan-header">
          <span class="plan-tag">Básico</span>
          <div class="plan-price"><span>R$</span>149<span>/mês</span></div>
        </div>
        <ul class="plan-features">
          <li>✓ 2 cortes por mês</li>
          <li>✓ Agendamento online</li>
          <li>✓ Histórico de serviços</li>
          <li>✗ Prioridade no agendamento</li>
        </ul>
        <a href="cadastro.php" class="btn btn-outline w-full">Assinar Básico</a>
      </div>
      <div class="plan-card plan-featured">
        <div class="plan-badge">Mais popular</div>
        <div class="plan-header">
          <span class="plan-tag">Estilo</span>
          <div class="plan-price"><span>R$</span>219<span>/mês</span></div>
        </div>
        <ul class="plan-features">
          <li>✓ Corte + barba quinzenal</li>
          <li>✓ 10% de desconto em adicionais</li>
          <li>✓ Lembrete inteligente</li>
          <li>✓ Barbeiro reservado</li>
        </ul>
        <a href="cadastro.php" class="btn btn-gold w-full">Assinar Estilo</a>
      </div>
      <div class="plan-card">
        <div class="plan-header">
          <span class="plan-tag">VIP</span>
          <div class="plan-price"><span>R$</span>349<span>/mês</span></div>
        </div>
        <ul class="plan-features">
          <li>✓ Corte + barba semanal</li>
          <li>✓ Prioridade máxima</li>
          <li>✓ 20% desconto em todos serviços</li>
          <li>✓ Atendimento exclusivo</li>
        </ul>
        <a href="cadastro.php" class="btn btn-outline w-full">Assinar VIP</a>
      </div>
    </div>
  </div>
</section>

<!-- DEPOIMENTOS -->
<section class="section testimonials-section">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Depoimentos</span>
      <h2>O que dizem <span class="gold">nossos clientes</span></h2>
    </div>
    <div class="testimonials-grid">
      <?php
      $testimonials = [
        ['name' => 'Rafael M.', 'role' => 'Designer', 'text' => 'O diagnóstico de estilo foi incrível. Me indicou o corte perfeito e agora faço o "meu corte de sempre" com um clique. Nunca mais errei.', 'stars' => 5],
        ['name' => 'Carlos A.', 'role' => 'Empresário', 'text' => 'Assino o plano VIP há 8 meses. A praticidade do agendamento e a qualidade dos barbeiros não têm igual em São Paulo.', 'stars' => 5],
        ['name' => 'Bruno S.', 'role' => 'Arquiteto', 'text' => 'O lembrete inteligente me salvou várias vezes. Chego na barbearia sempre com o horário certo e nunca espero.', 'stars' => 5],
      ];
      foreach($testimonials as $t): ?>
      <div class="testimonial-card">
        <div class="testimonial-stars"><?= str_repeat('★', $t['stars']) ?></div>
        <p>"<?= $t['text'] ?>"</p>
        <div class="testimonial-author">
          <div class="testimonial-avatar"><?= substr($t['name'], 0, 1) ?></div>
          <div>
            <strong><?= $t['name'] ?></strong>
            <span><?= $t['role'] ?></span>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA FINAL -->
<section class="section cta-section">
  <div class="container">
    <div class="cta-box">
      <div class="cta-content">
        <h2>Pronto para <span class="gold">elevar seu estilo?</span></h2>
        <p>Agende agora ou faça seu diagnóstico gratuito e descubra o corte ideal para você.</p>
        <div class="cta-btns">
          <a href="agendamento.php" class="btn btn-gold btn-lg">Agendar Online</a>
          <a href="https://wa.me/5511999999999" target="_blank" class="btn btn-ghost btn-lg">💬 WhatsApp</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="logo"><span class="logo-pc">PRIME</span><span class="logo-cut">CUT</span></div>
        <p>Barbearia premium em São Paulo. Estilo, precisão e experiência incomparável desde 2018.</p>
        <div class="footer-social">
          <a href="#" class="social-btn">IG</a>
          <a href="#" class="social-btn">WA</a>
          <a href="#" class="social-btn">FB</a>
        </div>
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