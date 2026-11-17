<?php
require __DIR__ . '/../verificar_login.php';
$titulo = 'Cadastrar usuário';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1>Cadastrar usuário</h1>
<form method="post" action="criar_action.php">
    <?php campo_token(); ?>
    <p><label>Nome: <input name="nome" maxlength="100" required></label></p>
    <p><label>Usuário: <input name="login" maxlength="60" required></label></p>
    <p><label>Senha: <input type="password" name="senha" autocomplete="new-password" required></label></p>
    <button>Salvar</button>
    <a href="listar.php">Voltar à lista</a>
</form>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
