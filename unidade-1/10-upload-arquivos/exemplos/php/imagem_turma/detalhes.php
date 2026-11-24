<?php
require __DIR__ . '/../verificar_login.php';
$id = (int) ($_GET['id'] ?? 0);
$imagem = buscar($pdo, 'SELECT turma_id, titulo, descricao, tag, caminho FROM imagens_turma WHERE id = ?', $id);
$titulo = 'Detalhes da foto';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1><?= $imagem['titulo'] ?></h1>
<img src="/<?= $imagem['caminho'] ?>" alt="<?= $imagem['titulo'] ?>" width="800" style="max-width: 100%">
<p><?= $imagem['descricao'] ?></p>
<p>Tag: <?= $imagem['tag'] ?></p>
<p>
    <a href="editar_form.php?id=<?= $id ?>">Editar foto</a>
    | <a href="listar.php?turma_id=<?= $imagem['turma_id'] ?>">Voltar à galeria</a>
</p>
<form method="post" action="deletar_action.php">
    <button name="id" value="<?= $id ?>">Excluir foto</button>
</form>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
