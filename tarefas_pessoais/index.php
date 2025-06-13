<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
require_once 'includes/autenticacao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (empty($login) || empty($senha)) {
        $erro = 'Por favor, preencha todos os campos.';
    } else {
        if (fazerLogin($conn, $login, $senha)) {
            header('Location: dashboard.php');
            exit();
        } else {
            $erro = 'Login ou senha incorretos.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Sistema de Tarefas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if ($erro): ?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label>Usuário:</label>
                <input type="text" name="login" required>
            </div>
            <div class="form-group">
                <label>Senha:</label>
                <input type="password" name="senha" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
        <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
    </div>
</body>
</html>