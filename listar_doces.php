<?php

session_start();

if (!isset($_SESSION['autenticado'])) {
    header("Location: login.php?error=acesso_negado");
    exit();
}

require_once "conexao.php";

$termo_pesquisa = '';
if (isset($_GET['pesquisa']) && !empty($_GET['pesquisa'])) {
    $termo_pesquisa = $_GET['pesquisa'];
    $doces = pesquisar_doces($termo_pesquisa);
} else {
    $doces = listar_doces();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lista de Doces - Confeitaria</title>
</head>
<body>
    <header>
        <h1>Confeitaria</h1>
        <nav>
            <span>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_login']); ?>!</span>
            <a href="logout.php" class="btn-logout">Sair</a>
        </nav>
    </header>

    <div class="container">
        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">
                <?php 
                if ($_GET['success'] == 'cadastrado') {
                    echo "Doce cadastrado com sucesso!";
                } elseif ($_GET['success'] == 'atualizado') {
                    echo "Doce atualizado com sucesso!";
                } elseif ($_GET['success'] == 'excluido') {
                    echo "Doce excluído com sucesso!";
                }
                ?>
            </div>
        <?php endif; ?>

        <div class="header-actions">
            <h2>Lista de Doces</h2>
            <a href="cadastrar_doce.php" class="btn-primary">+ Cadastrar Novo Doce</a>
        </div>

        <form action="listar_doces.php" method="GET" class="search-form">
            <input type="text" name="pesquisa" placeholder="Pesquisar por nome ou tipo..." 
                   value="<?php echo htmlspecialchars($termo_pesquisa); ?>">
            <button type="submit" class="btn-secondary">Pesquisar</button>
            <?php if (!empty($termo_pesquisa)): ?>
                <a href="listar_doces.php" class="btn-secondary">Limpar</a>
            <?php endif; ?>
        </form>

        <?php if (count($doces) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome do Doce</th>
                        <th>Tipo</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($doces as $doce): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($doce['cod_doce']); ?></td>
                        <td><?php echo htmlspecialchars($doce['nomeDoce']); ?></td>
                        <td><?php echo htmlspecialchars($doce['tipoDoce']); ?></td>
                        <td><?php echo htmlspecialchars($doce['quantidade']); ?></td>
                        <td class="actions">
                            <a href="editar_doce.php?id=<?php echo urlencode($doce['cod_doce']); ?>" 
                               class="btn-edit">Editar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <p>Nenhum doce encontrado.</p>
                <?php if (!empty($termo_pesquisa)): ?>
                    <p>Tente uma pesquisa diferente ou <a href="listar_doces.php">visualize todos os doces</a>.</p>
                <?php else: ?>
                    <p><a href="cadastrar_doce.php">Cadastre o primeiro doce</a> da sua confeitaria!</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>