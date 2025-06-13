<?php
require_once 'includes/conexao.php';
require_once 'includes/autenticacao.php';
protegerPagina();

// Buscar tarefas do usuário
$stmt = $conn->prepare("SELECT * FROM tarefas WHERE usuario_id = ? ORDER BY data_criacao DESC");
$stmt->execute([$_SESSION['usuario_id']]);
$tarefas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Minhas Tarefas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Minhas Tarefas</h1>
            <nav>
                <a href="dashboard.php">Dashboard</a>
                <a href="nova_tarefa.php">Nova Tarefa</a>
                <a href="logout.php">Sair</a>
            </nav>
        </header>
        
        <?php if (empty($tarefas)): ?>
            <p>Nenhuma tarefa cadastrada ainda. <a href="nova_tarefa.php">Adicione sua primeira tarefa!</a></p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Status</th>
                        <th>Data de Criação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarefas as $tarefa): ?>
                        <tr>
                            <td><?= htmlspecialchars($tarefa['titulo']) ?></td>
                            <td><?= ucfirst(str_replace('_', ' ', $tarefa['status'])) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($tarefa['data_criacao'])) ?></td>
                            <td>
                                <a href="editar_tarefa.php?id=<?= $tarefa['id'] ?>" class="btn-edit">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>