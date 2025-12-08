<?php

session_start();

if (!isset($_SESSION['autenticado'])) {
    header("Location: login.php?error=acesso_negado");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: listar_doces.php");
    exit();
}

require_once "conexao.php";

$cod_doce = $_GET['id'];

if (excluir_doce($cod_doce)) {
    header("Location: listar_doces.php?success=excluido");
} else {
    header("Location: listar_doces.php?error=erro_exclusao");
}
exit();
?>