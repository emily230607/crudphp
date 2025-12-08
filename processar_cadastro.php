<?php

session_start();

if (!isset($_SESSION['autenticado'])) {
    header("Location: login.php?error=acesso_negado");
    exit();
}

if (!isset($_POST['nome']) || !isset($_POST['tipo']) || !isset($_POST['quantidade'])) {
    header("Location: cadastrar_doce.php?error=dados_incompletos");
    exit();
}

$nome = trim($_POST['nome']);
$tipo = trim($_POST['tipo']);
$quantidade = trim($_POST['quantidade']);

if (empty($nome) || empty($tipo) || empty($quantidade)) {
    header("Location: cadastrar_doce.php?error=dados_incompletos");
    exit();
}

if (!is_numeric($quantidade) || $quantidade < 0) {
    header("Location: cadastrar_doce.php?error=quantidade_invalida");
    exit();
}

require_once "conexao.php";

if (cadastrar_doce($nome, $tipo, $quantidade)) {
    header("Location: listar_doces.php?success=cadastrado");
} else {
    header("Location: cadastrar_doce.php?error=erro_cadastro");
}
exit();
?>