<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars(APP_NAME) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="<?= BASE_URL ?>/assets/style.css" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='0.9em' font-size='90'>🍧</text></svg>">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-gradient shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= BASE_URL ?>/index.php">
        <img src="<?= BASE_URL ?>/assets/img.jpg" alt="Logo" style="height:28px;width:28px;object-fit:cover;border-radius:6px;">
        <span><i class="bi bi-basket2"></i> <?= htmlspecialchars(APP_NAME) ?></span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navb" aria-controls="navb" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navb">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/index.php"><i class="bi bi-ui-checks"></i> Estoque</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/create.php"><i class="bi bi-plus-circle"></i> Adicionar</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <main class="py-4">
    <div class="container">
      <?php if (!empty($_SESSION['flash'])): ?>
        <?php foreach ($_SESSION['flash'] as $flash): ?>
          <div class="alert alert-<?= htmlspecialchars($flash['type']) ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endforeach; unset($_SESSION['flash']); ?>
      <?php endif; ?>
    

