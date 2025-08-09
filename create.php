<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/config.php';

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
        header('Location: ' . BASE_URL . '/create.php');
        exit;
    }

    $pdo = getPdo();
    $stmt = $pdo->prepare('INSERT INTO produtos (nome, categoria, descricao, preco, quantidade, unidade) VALUES (:nome, :categoria, :descricao, :preco, :quantidade, :unidade)');
    $stmt->execute([
        ':nome' => $nome,
        ':categoria' => $categoria,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':quantidade' => $quantidade,
        ':unidade' => $unidade,
    ]);

    flash('Item adicionado com sucesso.');
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

include __DIR__ . '/partials/header.php';
?>

<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card shadow-sm card-hover">
      <div class="card-body">
        <h2 class="h5">Adicionar item</h2>
        <form method="post" action="<?= BASE_URL ?>/create.php" class="row g-3 mt-1">
          <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
          <div class="col-md-6">
            <label class="form-label required">Nome</label>
            <input name="nome" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label required">Categoria</label>
            <input name="categoria" class="form-control" placeholder="Ex.: Tigela, Insumo, Embalagem" required>
          </div>
          <div class="col-12">
            <label class="form-label">Descrição</label>
            <input name="descricao" class="form-control" placeholder="Opcional">
          </div>
          <div class="col-md-4">
            <label class="form-label required">Preço (R$)</label>
            <div class="input-group">
              <span class="input-group-text">R$</span>
              <input name="preco" class="form-control" type="number" step="0.01" min="0" required aria-label="Preço">
            </div>
            <div class="form-help">Use vírgula ou ponto para decimais.</div>
          </div>
          <div class="col-md-4">
            <label class="form-label required">Quantidade</label>
            <input name="quantidade" class="form-control" type="number" min="0" required>
          </div>
          <div class="col-md-4">
            <label class="form-label required">Unidade</label>
            <input name="unidade" class="form-control" value="un" required>
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


