<?php
session_start();
require_once 'config/database.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM primecut.usuarios WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_nome'] = $usuario['nome'];
        $_SESSION['user_tipo'] = $usuario['tipo'];

        header("Location: cliente/dashboard.php");
        exit;
    } else {
        $mensagem = "E-mail ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Login - Prime Cut</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page">

<div class="auth-card">
    <a href="index.php" class="logo">
        <span class="logo-pc">PRIME</span><span class="logo-cut">CUT</span>
    </a>

    <h2>Entrar</h2>
    <p class="auth-sub">Acesse sua área Prime Cut.</p>

    <?php if ($mensagem): ?>
        <div class="alert alert-error"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-gold w-full">Entrar</button>
    </form>

    <div class="auth-footer">
        Não tem conta? <a href="cadastro.php">Cadastrar</a>
    </div>
</div>

</body>
</html>