<?php
require __DIR__ . '/../verificar_login.php';
$id = (int) ($_GET['id'] ?? 0);
$registro = buscar($pdo, 'SELECT nome FROM professores WHERE id = ?', $id);
$titulo = 'Editar professor';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1>Editar professor</h1>
<form method="post" action="editar_action.php">
    <?php campo_token(); ?>
    <input type="hidden" name="id" value="<?= $id ?>">
    <p><label>Nome: <input name="nome" maxlength="100" value="<?= h($registro['nome']) ?>" required></label></p>
    <button>Salvar</button>
    <a href="listar.php">Voltar à lista</a>
</form>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
