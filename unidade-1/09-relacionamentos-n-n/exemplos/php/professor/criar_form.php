<?php
require __DIR__ . '/../inicio.php';
exigir_login();
$titulo = 'Cadastrar professor';
include __DIR__ . '/../../templates/cabecalho.php';
?>
<h1>Cadastrar professor</h1>
<form method="post" action="criar_action.php">
    <?php campo_token(); ?>
    <p><label>Nome: <input name="nome" maxlength="100" required></label></p>
    <button>Salvar</button>
    <a href="listar.php">Voltar à lista</a>
</form>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>
