<?php
require __DIR__ . '/../verificar_login.php';
$titulo = 'Cadastrar aluno';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1>Cadastrar aluno</h1>
<form method="post" action="criar_action.php">
    <p><label>Nome: <input name="nome" maxlength="100" required></label></p>
    <button>Salvar</button>
    <a href="listar.php">Voltar à lista</a>
</form>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
