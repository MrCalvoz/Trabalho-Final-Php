<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';

$erros = [];
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dados = sanitizarEntrada($_POST);
    
    if (empty($dados['login'])) {
        $erros[] = 'O nome de usuário é obrigatório.';
    }
    
    if (empty($dados['email']) || !validarEmail($dados['email'])) {
        $erros[] = 'Por favor, insira um e-mail válido.';
    }
    
    if (empty($dados['senha']) || !validarSenha($dados['senha'])) {
        $erros[] = 'A senha deve ter pelo menos 6 caracteres.';
    }
    
    if ($dados['senha'] !== $dados['confirmar_senha']) {
        $erros[] = 'As senhas não coincidem.';
    }
    
    if (verificarUsuarioExistente($conn, $dados['login'], $dados['email'])) {
        $erros[] = 'Nome de usuário ou e-mail já cadastrado.';
    }
    
    if (empty($erros)) {
        $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO usuarios (login, email, senha) VALUES (?, ?, ?)");
        if ($stmt->execute([$dados['login'], $dados['email'], $senhaHash])) {
            $sucesso = true;
        } else {
            $erros[] = 'Erro ao cadastrar usuário. Tente novamente.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro - Sistema de Tarefas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Usuário</h1>
        
        <?php if ($sucesso): ?>
            <div class="alert alert-success">
                Cadastro realizado com sucesso! <a href="index.php">Faça login</a>
            </div>
        <?php else: ?>
            <?php foreach ($erros as $erro): ?>
                <div class="alert alert-danger"><?= $erro ?></div>
            <?php endforeach; ?>
            
            <form method="post">
                <div class="form-group">
                    <label>Nome de Usuário:</label>
                    <input type="text" name="login" required>
                </div>
                <div class="form-group">
                    <label>E-mail:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Senha:</label>
                    <input type="password" name="senha" required>
                </div>
                <div class="form-group">
                    <label>Confirmar Senha:</label>
                    <input type="password" name="confirmar_senha" required>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
            <p>Já tem uma conta? <a href="index.php">Faça login</a></p>
        <?php endif; ?>
    </div>
</body>
</html>