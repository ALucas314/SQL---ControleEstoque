<?php
require_once __DIR__ . '/config.php';

function getPdoRaw(): PDO {
    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';charset=utf8mb4';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    return new PDO($dsn, DB_USER, DB_PASS, $options);
}

function ensureDatabaseAndTables(): void {
    // Cria database se não existir
    $pdo = getPdoRaw();
    $pdo->exec('CREATE DATABASE IF NOT EXISTS `' . DB_NAME . '` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci');
    $pdo->exec('USE `' . DB_NAME . '`');

    // Cria tabela produtos
    $pdo->exec('CREATE TABLE IF NOT EXISTS produtos (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(120) NOT NULL,
        categoria VARCHAR(80) NOT NULL,
        descricao VARCHAR(255) NULL,
        preco DECIMAL(10,2) NOT NULL DEFAULT 0,
        quantidade INT NOT NULL DEFAULT 0,
        unidade VARCHAR(20) NOT NULL DEFAULT "un",
        criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        atualizado_em DATETIME NULL ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

    // Verifica quantidade de registros
    $count = (int) $pdo->query('SELECT COUNT(*) AS c FROM produtos')->fetchColumn();
    if ($count === 0) {
        // Insere 10 itens iniciais de açaí
        $stmt = $pdo->prepare('INSERT INTO produtos (nome, categoria, descricao, preco, quantidade, unidade) VALUES
            (?,?,?,?,?,?), (?,?,?,?,?,?), (?,?,?,?,?,?), (?,?,?,?,?,?), (?,?,?,?,?,?),
            (?,?,?,?,?,?), (?,?,?,?,?,?), (?,?,?,?,?,?), (?,?,?,?,?,?), (?,?,?,?,?,?)');
        $items = [
            ['Açaí Tradicional 300ml', 'Tigela', 'Açaí puro 300ml', 12.90, 30, 'un'],
            ['Açaí Tradicional 500ml', 'Tigela', 'Açaí puro 500ml', 18.90, 25, 'un'],
            ['Açaí com Granola 300ml', 'Tigela', 'Açaí + granola 300ml', 14.90, 35, 'un'],
            ['Açaí com Banana 500ml', 'Tigela', 'Açaí + banana 500ml', 20.90, 20, 'un'],
            ['Açaí Guaraná 1L', 'Balde', 'Açaí batido com guaraná 1L', 34.90, 15, 'un'],
            ['Polpa de Açaí 1kg', 'Insumo', 'Polpa para preparo', 29.90, 40, 'kg'],
            ['Granola Premium 1kg', 'Insumo', 'Granola crocante', 22.50, 10, 'kg'],
            ['Leite Condensado 395g', 'Insumo', 'Lata 395g', 6.50, 24, 'un'],
            ['Copo 500ml', 'Embalagem', 'Copo descartável 500ml', 0.60, 300, 'un'],
            ['Tampa 500ml', 'Embalagem', 'Tampa para copo 500ml', 0.25, 300, 'un'],
        ];
        $flat = [];
        foreach ($items as $it) { $flat = array_merge($flat, $it); }
        $stmt->execute($flat);
    }
}

function getPdo(): PDO {
    ensureDatabaseAndTables();
    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    return new PDO($dsn, DB_USER, DB_PASS, $options);
}

?>


