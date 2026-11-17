<?php
require __DIR__ . '/../verificar_login.php';
$id = (int) ($_GET['id'] ?? 0);
$registro = buscar($pdo, 'SELECT nome FROM alunos WHERE id = ?', $id);
$titulo = $registro['nome'];
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1><?= $registro['nome'] ?></h1>
<p>ID: <?= $id ?></p>
<p>
    <a href="editar_form.php?id=<?= $id ?>">Editar</a>
    | <a href="listar.php">Voltar à lista</a>
</p>
<form method="post" action="deletar_action.php">
    <?php campo_token(); ?>
    <button name="id" value="<?= $id ?>">Excluir</button>
</form>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
