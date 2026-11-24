<?php
require __DIR__ . '/../verificar_login.php';
$id = (int) ($_GET['id'] ?? 0);
$imagem = buscar($pdo, 'SELECT titulo, descricao, tag FROM imagens_turma WHERE id = ?', $id);
$titulo = 'Editar foto';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1>Editar foto</h1>
<form method="post" action="editar_action.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">
    <p><label>Título: <input name="titulo" maxlength="100" value="<?= $imagem['titulo'] ?>" required></label></p>
    <p><label>Descrição: <textarea name="descricao" required><?= $imagem['descricao'] ?></textarea></label></p>
    <p><label>Tag: <input name="tag" maxlength="50" value="<?= $imagem['tag'] ?>" required></label></p>
    <p><label>Nova foto (JPG, opcional): <input type="file" name="foto" accept="image/jpeg"></label></p>
    <button>Salvar</button>
    <a href="detalhes.php?id=<?= $id ?>">Voltar à foto</a>
</form>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
