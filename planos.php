<?php

session_start();

require_once 'config/database.php';

$planos = $pdo->query("
    SELECT *
    FROM primecut.planos
    ORDER BY preco
")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Planos VIP - Prime Cut</title>

<link rel="stylesheet" href="assets/css/style.css">

<style>

body{

    background:#0b0b0b;
    color:white;
    font-family:Arial, sans-serif;
    margin:0;

}

.plans-section{

    padding:140px 40px 80px;

}

.container{

    max-width:1200px;
    margin:auto;

}

.section-header{

    text-align:center;
    margin-bottom:60px;

}

.section-tag{

    color:#d4af37;
    font-size:14px;
    text-transform:uppercase;
    letter-spacing:2px;
    display:block;
    margin-bottom:15px;

}

.section-header h2{

    font-size:56px;
    margin-bottom:15px;

}

.gold{

    color:#d4af37;

}

.section-header p{

    color:#aaa;
    font-size:18px;

}

.plans-grid{

    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));
    gap:30px;

}

.plan-card{

    background:#111;
    border:1px solid rgba(212,175,55,.15);
    border-radius:25px;
    padding:35px;
    position:relative;
    transition:.3s;

}

.plan-card:hover{

    transform:translateY(-8px);
    border-color:#d4af37;

}

.plan-featured{

    border:2px solid #d4af37;
    transform:scale(1.03);

}

.plan-badge{

    position:absolute;
    top:-15px;
    right:20px;

    background:#d4af37;
    color:#111;

    padding:8px 16px;
    border-radius:30px;

    font-size:13px;
    font-weight:bold;

}

.plan-tag{

    display:inline-block;

    padding:8px 14px;

    background:rgba(212,175,55,.1);

    color:#d4af37;

    border-radius:20px;

    margin-bottom:25px;

}

.plan-price{

    font-size:48px;
    font-weight:bold;
    margin-bottom:25px;
    color:#fff;

}

.plan-price span{

    font-size:18px;
    color:#aaa;

}

.plan-features{

    list-style:none;
    padding:0;
    margin:0 0 35px;

}

.plan-features li{

    padding:14px 0;
    border-bottom:1px solid rgba(255,255,255,.06);
    color:#ddd;

}

.btn{

    display:flex;
    align-items:center;
    justify-content:center;

    height:52px;

    border-radius:14px;

    text-decoration:none;

    font-weight:bold;

    transition:.3s;

}

.btn-gold{

    background:#d4af37;
    color:#111;

}

.btn-gold:hover{

    opacity:.9;
    transform:translateY(-2px);

}

.w-full{

    width:100%;

}

.nav{

    position:fixed;
    top:0;
    left:0;

    width:100%;

    background:#0b0b0b;

    border-bottom:1px solid rgba(255,255,255,.05);

    z-index:999;

}

.nav-inner{

    max-width:1200px;
    margin:auto;

    height:80px;

    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:0 20px;

}

.logo{

    text-decoration:none;
    font-size:28px;
    font-weight:bold;

}

.logo-pc{

    color:white;

}

.logo-cut{

    color:#d4af37;

}

.nav-links{

    display:flex;
    gap:25px;
    list-style:none;

}

.nav-links a{

    color:#ccc;
    text-decoration:none;
    transition:.3s;

}

.nav-links a:hover{

    color:#d4af37;

}

.btn-ghost{

    border:1px solid rgba(255,255,255,.15);
    color:white;
    padding:0 20px;

}

.btn-ghost:hover{

    border-color:#d4af37;
    color:#d4af37;

}

@media(max-width:768px){

    .nav-links{

        display:none;

    }

    .section-header h2{

        font-size:40px;

    }

}

</style>

</head>
<body>

<nav class="nav">

    <div class="nav-inner">

        <a href="index.php" class="logo">
            <span class="logo-pc">PRIME</span>
            <span class="logo-cut">CUT</span>
        </a>

        <ul class="nav-links">

            <li>
                <a href="index.php">Início</a>
            </li>

            <li>
                <a href="servicos.php">Serviços</a>
            </li>

            <li>
                <a href="diagnostico.php">Diagnóstico</a>
            </li>

            <li>
                <a href="agendamento.php">Agendar</a>
            </li>

        </ul>

        <a href="cliente/dashboard.php" class="btn btn-ghost">
            Minha Área
        </a>

    </div>

</nav>

<section class="plans-section">

    <div class="container">

        <div class="section-header">

            <span class="section-tag">
                Assinatura Prime
            </span>

            <h2>
                Planos <span class="gold">VIP</span>
            </h2>

            <p>
                Escolha o plano ideal para manter seu visual sempre impecável.
            </p>

        </div>

        <div class="plans-grid">

            <?php foreach($planos as $index => $plano): ?>

                <div class="plan-card <?= $index == 1 ? 'plan-featured' : '' ?>">

                    <?php if($index == 1): ?>

                        <div class="plan-badge">
                            Mais Popular
                        </div>

                    <?php endif; ?>

                    <span class="plan-tag">
                        <?= htmlspecialchars($plano['nome']) ?>
                    </span>

                    <div class="plan-price">

                        <span>R$</span>

                        <?= number_format($plano['preco'], 2, ',', '.') ?>

                        <span>/mês</span>

                    </div>

                    <p style="margin-bottom:30px; color:#bbb; line-height:1.7;">

                        <?= htmlspecialchars($plano['descricao']) ?>

                    </p>

                    <ul class="plan-features">

                        <li>

                            ✓

                            <?= $plano['cortes_mes'] >= 999
                                ? 'Cortes ilimitados'
                                : $plano['cortes_mes'] . ' cortes por mês'
                            ?>

                        </li>

                        <li>
                            ✓ Prioridade nos agendamentos
                        </li>

                        <li>
                            ✓ Atendimento premium
                        </li>

                        <li>
                            ✓ Histórico completo de serviços
                        </li>

                    </ul>

                    <a
                        href="cliente/assinar_plano.php?id=<?= $plano['id'] ?>"
                        class="btn btn-gold w-full"
                    >
                        Assinar Plano
                    </a>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>

</body>
</html>