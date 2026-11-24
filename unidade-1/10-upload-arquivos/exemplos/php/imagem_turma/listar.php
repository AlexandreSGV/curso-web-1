<?php
require __DIR__ . '/../verificar_login.php';
$turmaId = (int) ($_GET['turma_id'] ?? 0);
$turma = buscar($pdo, 'SELECT nome FROM turmas WHERE id = ?', $turmaId);

$consulta = $pdo->prepare('SELECT id, titulo, caminho FROM imagens_turma WHERE turma_id = ? ORDER BY id');
$consulta->execute([$turmaId]);
$imagens = $consulta->fetchAll();

$titulo = 'Galeria da turma';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1>Galeria de fotos — <?= $turma['nome'] ?></h1>
<p><a href="/php/turma/detalhes.php?id=<?= $turmaId ?>">Voltar aos detalhes da turma</a></p>

<?php if ($imagens): ?>
    <ul style="display: flex; flex-wrap: wrap; gap: 16px; padding: 0; list-style: none">
        <?php foreach ($imagens as $imagem): ?>
            <li>
                <a href="detalhes.php?id=<?= $imagem['id'] ?>">
                    <img src="/<?= $imagem['caminho'] ?>" alt="" width="150">
                    <br><?= $imagem['titulo'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>A turma ainda não tem fotos.</p>
<?php endif; ?>

<h2>Adicionar foto</h2>
<form method="post" action="criar_action.php" enctype="multipart/form-data">
    <input type="hidden" name="turma_id" value="<?= $turmaId ?>">
    <p><label>Título: <input name="titulo" maxlength="100" required></label></p>
    <p><label>Descrição: <textarea name="descricao" required></textarea></label></p>
    <p><label>Tag: <input name="tag" maxlength="50" required></label></p>
    <p><label>Foto (JPG): <input type="file" name="foto" accept="image/jpeg" required></label></p>
    <button>Adicionar foto</button>
</form>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
