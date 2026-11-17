<?php
require __DIR__ . '/../inicio.php';
exigir_login();
$id = (int) ($_GET['id'] ?? 0);
$registro = buscar('SELECT nome, login FROM usuarios WHERE id = ?', $id);
$titulo = 'Editar usuário';
include __DIR__ . '/../../templates/cabecalho.php';
?>
<h1>Editar usuário</h1>
<form method="post" action="editar_action.php">
    <?php campo_token(); ?>
    <input type="hidden" name="id" value="<?= $id ?>">
    <p><label>Nome: <input name="nome" maxlength="100" value="<?= h($registro['nome']) ?>" required></label></p>
    <p><label>Usuário: <input name="login" maxlength="60" value="<?= h($registro['login']) ?>" required></label></p>
    <p><label>Senha (deixe em branco para manter a atual): <input type="password" name="senha" autocomplete="new-password"></label></p>
    <button>Salvar</button>
    <a href="listar.php">Voltar à lista</a>
</form>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>
