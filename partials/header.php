<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';
$currentPage = basename($_SERVER['SCRIPT_NAME'] ?? '');
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
  <link href="<?= BASE_URL ?>/assets/style.css?v=2" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='0.9em' font-size='90'>🍧</text></svg>">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-acai shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= BASE_URL ?>/index.php">
        <span class="brand-text"><i class="bi bi-basket2"></i> <?= htmlspecialchars(APP_NAME) ?></span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navb" aria-controls="navb" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navb">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link <?= $currentPage === 'index.php' ? 'active' : '' ?>" href="<?= BASE_URL ?>/index.php" aria-current="<?= $currentPage === 'index.php' ? 'page' : 'false' ?>"><i class="bi bi-ui-checks"></i> <?= htmlspecialchars(NAV_LABEL_STOCK) ?></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <main class="py-4">
    <div class="container">
      <?php if (!empty($_SESSION['flash'])): ?>
        <div class="toast-container position-fixed top-0 end-0 p-3">
          <?php foreach ($_SESSION['flash'] as $idx => $flash): ?>
            <div class="toast align-items-center text-bg-<?= htmlspecialchars($flash['type'] === 'danger' ? 'danger' : ($flash['type'] === 'warning' ? 'warning' : 'success')) ?> border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4500">
              <div class="d-flex">
                <div class="toast-body">
                  <?= htmlspecialchars($flash['message']) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
            </div>
          <?php endforeach; unset($_SESSION['flash']); ?>
        </div>
      <?php endif; ?>
    

