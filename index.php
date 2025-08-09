<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/helpers.php';

$pdo = getPdo();

$q = trim($_GET['q'] ?? '');
$where = '';
$params = [];
if ($q !== '') {
    $where = 'WHERE nome LIKE :q OR categoria LIKE :q';
    $params[':q'] = "%$q%";
}

$stmt = $pdo->prepare("SELECT * FROM produtos $where ORDER BY nome ASC");
$stmt->execute($params);
$produtos = $stmt->fetchAll();

// Métricas
$totalItens = count($produtos);
$somaEstoque = 0;
foreach ($produtos as $p) { $somaEstoque += (int)$p['quantidade']; }

include __DIR__ . '/partials/header.php';
?>

<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h3 fw-semibold mb-0">Estoque</h1>
  <a href="<?= BASE_URL ?>/create.php" class="btn btn-acai"><i class="bi bi-plus-circle"></i> Novo item</a>
</div>

<div class="toolbar mb-3">
  <span class="metric-pill"><i class="bi bi-list-ul"></i> <?= $totalItens ?> itens</span>
  <span class="metric-pill"><i class="bi bi-box-seam"></i> <?= $somaEstoque ?> unidades totais</span>
</div>

<form class="row g-2 mb-3" method="get" action="<?= BASE_URL ?>/index.php">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-text"><i class="bi bi-search"></i></span>
      <input type="text" name="q" class="form-control" placeholder="Buscar por nome ou categoria" value="<?= htmlspecialchars($q) ?>">
    </div>
  </div>
  <div class="col-md-6 d-flex gap-2">
    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i> Buscar</button>
    <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/index.php"><i class="bi bi-x-circle"></i> Limpar</a>
  </div>
  <div class="col-12">
    <div class="table-responsive">
      <table class="table table-hover align-middle card-table">
        <thead>
          <tr>
            <th>Produto</th>
            <th>Categoria</th>
            <th class="text-end">Preço (R$)</th>
            <th class="text-end">Qtd</th>
            <th>Unidade</th>
            <th class="text-end">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!$produtos): ?>
            <tr>
              <td colspan="6">
                <div class="empty-state">
                  <i class="bi bi-clipboard-x"></i>
                  <div class="mt-2">Nenhum item encontrado.</div>
                </div>
              </td>
            </tr>
          <?php else: foreach ($produtos as $p): ?>
            <tr class="card-hover">
              <td data-label="Produto">
                <div class="fw-semibold"><?= htmlspecialchars($p['nome']) ?></div>
                <?php if (!empty($p['descricao'])): ?>
                  <div class="text-muted small"><?= htmlspecialchars($p['descricao']) ?></div>
                <?php endif; ?>
              </td>
              <td data-label="Categoria"><span class="badge badge-soft"><?= htmlspecialchars($p['categoria']) ?></span></td>
              <td class="text-end" data-label="Preço (R$)"><?= number_format((float)$p['preco'], 2, ',', '.') ?></td>
              <?php $isLow = ((int)$p['quantidade']) <= 5; ?>
              <td class="text-end <?= $isLow ? 'qty-low' : '' ?>" data-label="Qtd">
                <?= (int)$p['quantidade'] ?>
                <?php if ($isLow): ?><span class="badge badge-low ms-1">baixo</span><?php endif; ?>
              </td>
              <td data-label="Unidade"><?= htmlspecialchars($p['unidade']) ?></td>
              <td class="text-end" data-label="Ações">
                <a class="btn btn-sm btn-outline-primary" href="<?= BASE_URL ?>/edit.php?id=<?= (int)$p['id'] ?>"><i class="bi bi-pencil"></i></a>
                <a class="btn btn-sm btn-outline-danger" href="<?= BASE_URL ?>/delete.php?id=<?= (int)$p['id'] ?>" data-confirm="Remover este item?">
                  <i class="bi bi-trash"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</form>

<?php include __DIR__ . '/partials/footer.php'; ?>


