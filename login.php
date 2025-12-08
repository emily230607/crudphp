<?php

session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: listar_doces.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login - Confeitaria</title>
</head>
<body>
    <div class="container-login">
        <div class="login-box">
            <h1>Confeitaria</h1>
            <h2>Login do Sistema</h2>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message">
                    <?php 
                    if ($_GET['error'] == 'credenciais_invalidas') {
                        echo "Login e/ou senha incorretos!";
                    }
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success']) && $_GET['success'] == 'logout'): ?>
                <div class="success-message">
                    Logout realizado com sucesso!
                </div>
            <?php endif; ?>

            <form action="processar_login.php" method="POST">
                <div class="form-group">
                    <label for="login">Login:</label>
                    <input type="text" id="login" name="login" required autofocus>
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <button type="submit" class="btn-primary">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>