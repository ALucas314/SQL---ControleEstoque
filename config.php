<?php
// Configurações básicas da aplicação
// Ajuste o DB_USER e DB_PASS conforme necessário no seu XAMPP (padrão: root sem senha)

define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', 'estoque_acai');
define('DB_USER', 'root');
define('DB_PASS', 'root');

// Nome do app e base URL (caso você coloque a pasta dentro do htdocs como /estoque_acai)
define('APP_NAME', 'Estoque Açaí');
define('BASE_URL', '/estoque_acai');

// Rótulos de navegação (personalizáveis)
define('NAV_LABEL_STOCK', 'Estoque');
define('NAV_LABEL_ADD', 'Adicionar');

// Opções gerais
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

?>


