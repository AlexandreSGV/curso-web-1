<?php
require __DIR__ . '/../inicio.php';
exigir_login();
$registros = $pdo->query('SELECT id, nome FROM professores ORDER BY nome, id');
$titulo = 'Professores';
include __DIR__ . '/../../templates/cabecalho.php';
?>
<h1>Professores</h1>
<p><a href="criar_form.php">Cadastrar novo registro</a></p>
<ul>
    <?php foreach ($registros as $registro): ?>
        <li>
            <?= $registro['id'] ?> — <?= h($registro['nome']) ?>
            | <a href="detalhes.php?id=<?= $registro['id'] ?>">Detalhes</a>
            | <a href="editar_form.php?id=<?= $registro['id'] ?>">Editar</a>
            <form method="post" action="deletar_action.php" style="display: inline">
                <?php campo_token(); ?>
                <button name="id" value="<?= $registro['id'] ?>">Excluir</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>
