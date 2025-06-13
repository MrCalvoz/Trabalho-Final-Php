<?php
require_once 'includes/conexao.php';
require_once 'includes/autenticacao.php';
protegerPagina();

// Lógica para estatísticas do dashboard
$stmt = $conn->prepare("
    SELECT 
        COUNT(*) as total,
        SUM(CASE WHEN status = 'pendente' THEN 1 ELSE 0 END) as pendentes,
        SUM(CASE WHEN status = 'em_andamento' THEN 1 ELSE 0 END) as em_andamento,
        SUM(CASE WHEN status = 'concluida' THEN 1 ELSE 0 END) as concluidas
    FROM tarefas 
    WHERE usuario_id = ?
");
$stmt->execute([$_SESSION['usuario_id']]);
$estatisticas = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Sistema de Tarefas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_login']) ?>!</h1>
            <a href="logout.php" class="btn-logout">Sair</a>
        </header>
        
        <div class="stats">
            <div class="stat-card">
                <h3>Total de Tarefas</h3>
                <p><?= $estatisticas['total'] ?></p>
            </div>
            <div class="stat-card">
                <h3>Pendentes</h3>
                <p><?= $estatisticas['pendentes'] ?></p>
            </div>
            <div class="stat-card">
                <h3>Em Andamento</h3>
                <p><?= $estatisticas['em_andamento'] ?></p>
            </div>
            <div class="stat-card">
                <h3>Concluídas</h3>
                <p><?= $estatisticas['concluidas'] ?></p>
            </div>
        </div>
        
        <div class="actions">
            <a href="tarefas.php" class="btn">Ver Todas as Tarefas</a>
            <a href="nova_tarefa.php" class="btn">Adicionar Nova Tarefa</a>
        </div>
    </div>
</body>
</html>