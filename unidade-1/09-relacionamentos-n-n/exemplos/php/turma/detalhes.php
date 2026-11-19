<?php
require __DIR__ . '/../verificar_login.php';
$id = (int) ($_GET['id'] ?? 0);
$registro = buscar($pdo, 'SELECT t.nome, p.nome AS professor FROM turmas AS t JOIN professores AS p ON p.id = t.professor_id WHERE t.id = ?', $id);
$alunos = $pdo->prepare(
    'SELECT a.id, a.nome
     FROM matriculas AS m JOIN alunos AS a ON a.id = m.aluno_id
     WHERE m.turma_id = ? ORDER BY a.nome, a.id'
);
$alunos->execute([$id]);
$disponiveis = $pdo->query('SELECT id, nome FROM alunos ORDER BY nome, id');
$titulo = $registro['nome'];
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1><?= $registro['nome'] ?></h1>
<p>ID: <?= $id ?></p>
<p>Professor: <?= $registro['professor'] ?></p>
<p>
    <a href="editar_form.php?id=<?= $id ?>">Editar</a>
    | <a href="listar.php">Voltar à lista</a>
</p>
<form method="post" action="deletar_action.php">
    <button name="id" value="<?= $id ?>">Excluir</button>
</form>

<h2>Matricular aluno</h2>
<form method="post" action="/php/matricula/criar_action.php">
    <input type="hidden" name="turma_id" value="<?= $id ?>">
    <label>Aluno:
        <select name="aluno_id" required>
            <option value="">Escolha um aluno</option>
            <?php foreach ($disponiveis as $aluno): ?>
                <option value="<?= $aluno['id'] ?>"><?= $aluno['nome'] ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <button>Matricular</button>
</form>

<h2>Alunos matriculados</h2>
<ul>
    <?php foreach ($alunos as $aluno): ?>
        <li>
            <form method="post" action="/php/matricula/deletar_action.php">
                <a href="/php/aluno/detalhes.php?id=<?= $aluno['id'] ?>"><?= $aluno['nome'] ?></a>
                <input type="hidden" name="aluno_id" value="<?= $aluno['id'] ?>">
                <input type="hidden" name="turma_id" value="<?= $id ?>">
                <button>Desmatricular</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
