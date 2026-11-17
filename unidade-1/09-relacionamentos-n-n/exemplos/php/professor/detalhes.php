<?php
require __DIR__ . '/../inicio.php';
exigir_login();
$id = (int) ($_GET['id'] ?? 0);
$registro = buscar('SELECT nome FROM professores WHERE id = ?', $id);
$titulo = $registro['nome'];
include __DIR__ . '/../../templates/cabecalho.php';
?>
<h1><?= h($registro['nome']) ?></h1>
<p>ID: <?= $id ?></p>
<?php if (isset($_GET['em_uso'])): ?>
    <p>Atribua as turmas a outro professor antes de excluir este cadastro.</p>
<?php endif; ?>
<p>
    <a href="editar_form.php?id=<?= $id ?>">Editar</a>
    | <a href="listar.php">Voltar à lista</a>
</p>
<form method="post" action="deletar_action.php">
    <?php campo_token(); ?>
    <button name="id" value="<?= $id ?>">Excluir</button>
</form>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>
