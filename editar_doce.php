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

$doce = buscar_doce($_GET['id']);

if (!$doce) {
    header("Location: listar_doces.php?error=doce_nao_encontrado");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar Doce - Confeitaria</title>
</head>
<body>
    <header>
        <h1>Confeitaria</h1>
        <nav>
            <a href="listar_doces.php" class="btn-secondary">← Voltar para Lista</a>
            <a href="logout.php" class="btn-logout">Sair</a>
        </nav>
    </header>

    <div class="container">
        <h2>Editar Doce</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-message">
                <?php 
                if ($_GET['error'] == 'dados_incompletos') {
                    echo "Por favor, preencha todos os campos!";
                } elseif ($_GET['error'] == 'quantidade_invalida') {
                    echo "A quantidade deve ser um número positivo!";
                }
                ?>
            </div>
        <?php endif; ?>

        <form action="processar_edicao.php" method="POST" class="form-doce">
            <input type="hidden" name="cod_doce" value="<?php echo htmlspecialchars($doce['cod_doce']); ?>">

            <div class="form-group">
                <label for="nome">Nome do Doce:</label>
                <input type="text" id="nome" name="nome" 
                       value="<?php echo htmlspecialchars($doce['nomeDoce']); ?>" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo do Doce:</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione...</option>
                    <option value="Bolo" <?php echo ($doce['tipoDoce'] == 'Bolo') ? 'selected' : ''; ?>>Bolo</option>
                    <option value="Torta" <?php echo ($doce['tipoDoce'] == 'Torta') ? 'selected' : ''; ?>>Torta</option>
                    <option value="Cupcake" <?php echo ($doce['tipoDoce'] == 'Cupcake') ? 'selected' : ''; ?>>Cupcake</option>
                    <option value="Brigadeiro" <?php echo ($doce['tipoDoce'] == 'Brigadeiro') ? 'selected' : ''; ?>>Brigadeiro</option>
                    <option value="Brownie" <?php echo ($doce['tipoDoce'] == 'Brownie') ? 'selected' : ''; ?>>Brownie</option>
                    <option value="Cookie" <?php echo ($doce['tipoDoce'] == 'Cookie') ? 'selected' : ''; ?>>Cookie</option>
                    <option value="Doce de Festa" <?php echo ($doce['tipoDoce'] == 'Doce de Festa') ? 'selected' : ''; ?>>Doce de Festa</option>
                    <option value="Pudim" <?php echo ($doce['tipoDoce'] == 'Pudim') ? 'selected' : ''; ?>>Pudim</option>
                    <option value="Mousse" <?php echo ($doce['tipoDoce'] == 'Mousse') ? 'selected' : ''; ?>>Mousse</option>
                    <option value="Outro" <?php echo ($doce['tipoDoce'] == 'Outro') ? 'selected' : ''; ?>>Outro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" 
                       value="<?php echo htmlspecialchars($doce['quantidade']); ?>" min="1" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Salvar Alterações</button>
                <a href="listar_doces.php" class="btn-secondary">Cancelar</a>
                <button type="button" class="btn-danger" onclick="confirmarExclusao(<?php echo $doce['cod_doce']; ?>)">
                    Excluir Doce
                </button>
            </div>
        </form>
    </div>

    <script>
        function confirmarExclusao(cod_doce) {
            if (confirm('Tem certeza que deseja excluir este doce? Esta ação não pode ser desfeita.')) {
                window.location.href = 'excluir_doce.php?id=' + cod_doce;
            }
        }
    </script>
    <script src="script.js"></script>
</body>
</html>