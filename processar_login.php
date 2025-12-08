<?php

session_start();

if (!isset($_POST['login']) || !isset($_POST['senha'])) {
    header("Location: login.php?error=credenciais_invalidas");
    exit();
}

require_once "conexao.php";

$login = $_POST['login'];
$senha = $_POST['senha'];

$usuario = autenticar_usuario($login, $senha);

if ($usuario) {
    $_SESSION['usuario_login'] = $usuario['login'];
    $_SESSION['autenticado'] = true;
    header("Location: listar_doces.php");
} else {
    header("Location: login.php?error=credenciais_invalidas");
}
exit();
?>