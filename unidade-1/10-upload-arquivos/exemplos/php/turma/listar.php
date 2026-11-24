<?php
require __DIR__ . '/../verificar_login.php';
$registros = $pdo->query('SELECT t.id, t.nome, p.nome AS professor FROM turmas AS t JOIN professores AS p ON p.id = t.professor_id ORDER BY t.nome, t.id');
$titulo = 'Turmas';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1>Turmas</h1>
<p><a href="criar_form.php">Cadastrar novo registro</a></p>
<ul>
    <?php foreach ($registros as $registro): ?>
        <li>
            <?= $registro['id'] ?> — <?= $registro['nome'] ?> — <?= $registro['professor'] ?>
            | <a href="detalhes.php?id=<?= $registro['id'] ?>">Detalhes</a>
            | <a href="editar_form.php?id=<?= $registro['id'] ?>">Editar</a>
            <form method="post" action="deletar_action.php" style="display: inline">
                <button name="id" value="<?= $registro['id'] ?>">Excluir</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
