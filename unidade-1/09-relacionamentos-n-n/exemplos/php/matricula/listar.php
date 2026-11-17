<?php
require __DIR__ . '/../verificar_login.php';
$matriculas = $pdo->query(
    'SELECT a.nome AS aluno, t.nome AS turma, t.id AS turma_id
     FROM matriculas AS m
     JOIN alunos AS a ON a.id = m.aluno_id
     JOIN turmas AS t ON t.id = m.turma_id
     ORDER BY t.nome, a.nome'
);
$titulo = 'Matrículas';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1>Matrículas</h1>
<p>
    <a href="criar_ids_form.php">Matricular por IDs</a>
    | <a href="criar_selects_form.php">Matricular por listas</a>
</p>
<ul>
    <?php foreach ($matriculas as $matricula): ?>
        <li><?= h($matricula['aluno']) ?> —
            <a href="/php/turma/detalhes.php?id=<?= $matricula['turma_id'] ?>"><?= h($matricula['turma']) ?></a>
        </li>
    <?php endforeach; ?>
</ul>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
