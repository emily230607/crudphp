<?php

session_start();

if (!isset($_SESSION['autenticado'])) {
    header("Location: login.php?error=acesso_negado");
    exit();
}

if (!isset($_POST['cod_doce']) || !isset($_POST['nome']) || !isset($_POST['tipo']) || !isset($_POST['quantidade'])) {
    header("Location: listar_doces.php?error=dados_incompletos");
    exit();
}

$cod_doce = $_POST['cod_doce'];
$nome = trim($_POST['nome']);
$tipo = trim($_POST['tipo']);
$quantidade = trim($_POST['quantidade']);

if (empty($nome) || empty($tipo) || empty($quantidade)) {
    header("Location: editar_doce.php?id=" . urlencode($cod_doce) . "&error=dados_incompletos");
    exit();
}

if (!is_numeric($quantidade) || $quantidade < 0) {
    header("Location: editar_doce.php?id=" . urlencode($cod_doce) . "&error=quantidade_invalida");
    exit();
}

require_once "conexao.php";

if (atualizar_doce($cod_doce, $nome, $tipo, $quantidade)) {
    header("Location: listar_doces.php?success=atualizado");
} else {
    header("Location: editar_doce.php?id=" . urlencode($cod_doce) . "&error=erro_atualizacao");
}
exit();
?>