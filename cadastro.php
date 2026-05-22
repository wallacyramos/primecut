<?php
session_start();
require_once 'config/database.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $senha = $_POST['senha'];
    $confirmar = $_POST['confirmar'];

    if ($senha !== $confirmar) {
        $mensagem = "As senhas não coincidem.";
    } else {
        try {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO primecut.usuarios (nome, email, telefone, senha, tipo)
                    VALUES (:nome, :email, :telefone, :senha, 'cliente')";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':telefone' => $telefone,
                ':senha' => $senhaHash
            ]);

            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            $mensagem = "Erro ao cadastrar. Talvez esse e-mail já esteja em uso.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro - Prime Cut</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page">

<div class="auth-card">
    <a href="index.php" class="logo">
        <span class="logo-pc">PRIME</span><span class="logo-cut">CUT</span>
    </a>

    <h2>Criar Conta</h2>
    <p class="auth-sub">Cadastre-se para agendar seus horários.</p>

    <?php if ($mensagem): ?>
        <div class="alert alert-error"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="form-group">
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="telefone" class="form-control">
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Confirmar senha</label>
            <input type="password" name="confirmar" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-gold w-full">Cadastrar</button>
    </form>

    <div class="auth-footer">
        Já tem conta? <a href="login.php">Entrar</a>
    </div>
</div>

</body>
</html>