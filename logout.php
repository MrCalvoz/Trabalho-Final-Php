<?php
require_once 'includes/autenticacao.php';

session_start();
session_unset();
session_destroy();

header('Location: index.php');
exit();
?>