<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/config.php';

$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
    flash('ID inválido.', 'danger');
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

$pdo = getPdo();
$stmt = $pdo->prepare('DELETE FROM produtos WHERE id = :id');
$stmt->execute([':id' => $id]);

flash('Item removido.');
header('Location: ' . BASE_URL . '/index.php');
exit;


