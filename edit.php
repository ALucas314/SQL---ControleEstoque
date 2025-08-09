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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_csrf();
    $nome = input('nome');
    $categoria = input('categoria');
    $descricao = input('descricao');
    $preco = (float) str_replace([','], ['.'], input('preco', 0));
    $quantidade = (int) input('quantidade', 0);
    $unidade = input('unidade', 'un');

    if ($nome === '' || $categoria === '' || $preco < 0 || $quantidade < 0) {
        flash('Preencha os campos obrigatórios corretamente.', 'danger');
        header('Location: ' . BASE_URL . '/edit.php?id=' . $id);
        exit;
    }

    $stmt = $pdo->prepare('UPDATE produtos SET nome = :nome, categoria = :categoria, descricao = :descricao, preco = :preco, quantidade = :quantidade, unidade = :unidade WHERE id = :id');
    $stmt->execute([
        ':id' => $id,
        ':nome' => $nome,
        ':categoria' => $categoria,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':quantidade' => $quantidade,
        ':unidade' => $unidade,
    ]);
    
    flash('Item atualizado com sucesso.');
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM produtos WHERE id = :id');
$stmt->execute([':id' => $id]);
$prod = $stmt->fetch();
if (!$prod) {
    flash('Item não encontrado.', 'danger');
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

include __DIR__ . '/partials/header.php';
?>

<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card shadow-sm card-hover">
      <div class="card-body">
        <h2 class="h5">Editar item</h2>
        <form method="post" action="<?= BASE_URL ?>/edit.php?id=<?= (int)$prod['id'] ?>" class="row g-3 mt-1">
          <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
          <div class="col-md-6">
            <label class="form-label required">Nome</label>
            <input name="nome" class="form-control" required value="<?= htmlspecialchars($prod['nome']) ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label required">Categoria</label>
            <input name="categoria" class="form-control" required value="<?= htmlspecialchars($prod['categoria']) ?>">
          </div>
          <div class="col-12">
            <label class="form-label">Descrição</label>
            <input name="descricao" class="form-control" value="<?= htmlspecialchars($prod['descricao'] ?? '') ?>">
          </div>
          <div class="col-md-4">
            <label class="form-label required">Preço (R$)</label>
            <input name="preco" class="form-control" type="number" step="0.01" min="0" required value="<?= number_format((float)$prod['preco'], 2, '.', '') ?>">
          </div>
          <div class="col-md-4">
            <label class="form-label required">Quantidade</label>
            <input name="quantidade" class="form-control" type="number" min="0" required value="<?= (int)$prod['quantidade'] ?>">
          </div>
          <div class="col-md-4">
            <label class="form-label required">Unidade</label>
            <input name="unidade" class="form-control" required value="<?= htmlspecialchars($prod['unidade']) ?>">
          </div>
          <div class="col-12 d-flex gap-2">
            <button class="btn btn-acai" type="submit"><i class="bi bi-save"></i> Salvar</button>
            <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/index.php">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>


