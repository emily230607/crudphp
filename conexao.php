<?php

    $host = 'localhost';
    $port = '3307';
    $dbname = 'confeitaria';
    $username = 'root';
    $password = '';

        try {
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }

        $usuarios_sistema = [
            'Emily' => '123456789'
        ];

        function autenticar_usuario($login, $senha) {
            global $usuarios_sistema;
            
            if (isset($usuarios_sistema[$login]) && $usuarios_sistema[$login] === $senha) {
                return [
                    'login' => $login,
                    'autenticado' => true
                ];
            }
            return false;
        }

        function cadastrar_doce($nome, $tipo, $quantidade) {
            global $pdo;
            $stmt = $pdo->prepare("INSERT INTO doces (nomeDoce, tipoDoce, quantidade) VALUES (:nome, :tipo, :quantidade)");
            return $stmt->execute([
                'nome' => $nome,
                'tipo' => $tipo,
                'quantidade' => $quantidade
            ]);
        }

        function listar_doces() {
            global $pdo;
            $stmt = $pdo->query("SELECT * FROM doces ORDER BY cod_doce DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        function buscar_doce($cod_doce) {
            global $pdo;
            $stmt = $pdo->prepare("SELECT * FROM doces WHERE cod_doce = :cod_doce");
            $stmt->execute(['cod_doce' => $cod_doce]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        function atualizar_doce($cod_doce, $nome, $tipo, $quantidade) {
            global $pdo;
            $stmt = $pdo->prepare("UPDATE doces SET nomeDoce = :nome, tipoDoce = :tipo, quantidade = :quantidade WHERE cod_doce = :cod_doce");
            return $stmt->execute([
                'cod_doce' => $cod_doce,
                'nome' => $nome,
                'tipo' => $tipo,
                'quantidade' => $quantidade
            ]);
        }

        function excluir_doce($cod_doce) {
            global $pdo;
            $stmt = $pdo->prepare("DELETE FROM doces WHERE cod_doce = :cod_doce");
            return $stmt->execute(['cod_doce' => $cod_doce]);
        }

        function pesquisar_doces($termo) {
            global $pdo;
            $stmt = $pdo->prepare("SELECT * FROM doces WHERE nomeDoce LIKE :termo OR tipoDoce LIKE :termo ORDER BY cod_doce DESC");
            $stmt->execute(['termo' => "%$termo%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
?>