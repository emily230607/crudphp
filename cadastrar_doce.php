<?php

session_start();

if (!isset($_SESSION['autenticado'])) {
    header("Location: login.php?error=acesso_negado");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastrar Doce - Confeitaria</title>
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
        <h2>Cadastrar Novo Doce</h2>

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

        <form action="processar_cadastro.php" method="POST" class="form-doce">
            <div class="form-group">
                <label for="nome">Nome do Doce:</label>
                <input type="text" id="nome" name="nome" 
                       placeholder="Ex: Red Velvet" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo do Doce:</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione...</option>
                    <option value="Bolo">Bolo</option>
                    <option value="Torta">Torta</option>
                    <option value="Cupcake">Cupcake</option>
                    <option value="Brownie">Brownie</option>
                    <option value="Cookie">Cookie</option>
                    <option value="Doce de Festa">Doce de Festa</option>
                    <option value="Pudim">Pudim</option>
                    <option value="Mousse">Mousse</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" 
                       placeholder="Ex: 5" min="1" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Cadastrar Doce</button>
                <a href="listar_doces.php" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>