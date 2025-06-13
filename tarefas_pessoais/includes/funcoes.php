<?php
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validarSenha($senha) {
    return strlen($senha) >= 6;
}

function sanitizarEntrada($dados) {
    foreach ($dados as $key => $value) {
        $dados[$key] = htmlspecialchars(strip_tags(trim($value)));
    }
    return $dados;
}

function verificarUsuarioExistente($conn, $login, $email) {
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE login = ? OR email = ?");
    $stmt->execute([$login, $email]);
    return $stmt->fetch();
}
?>