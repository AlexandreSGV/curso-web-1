<?php
require __DIR__ . '/../verificar_login.php';
$titulo = 'Cadastrar professor';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1>Cadastrar professor</h1>
<form method="post" action="criar_action.php" enctype="multipart/form-data">
    <p><label>Nome: <input name="nome" maxlength="100" required></label></p>
    <p><label>Foto de perfil (JPG, opcional): <input type="file" name="foto" accept="image/jpeg"></label></p>
    <button>Salvar</button>
    <a href="listar.php">Voltar à lista</a>
</form>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
