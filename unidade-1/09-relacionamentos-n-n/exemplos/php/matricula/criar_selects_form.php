<?php
require __DIR__ . '/../verificar_login.php';
$alunos = $pdo->query('SELECT id, nome FROM alunos ORDER BY nome, id');
$turmas = $pdo->query('SELECT id, nome FROM turmas ORDER BY nome, id');
$titulo = 'Matrícula por listas';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1>Matrícula por listas</h1>
<form method="post" action="criar_action.php">
    <p><label>Aluno:
        <select name="aluno_id" required>
            <option value="">Escolha um aluno</option>
            <?php foreach ($alunos as $aluno): ?>
                <option value="<?= $aluno['id'] ?>"><?= $aluno['nome'] ?></option>
            <?php endforeach; ?>
        </select>
    </label></p>
    <p><label>Turma:
        <select name="turma_id" required>
            <option value="">Escolha uma turma</option>
            <?php foreach ($turmas as $turma): ?>
                <option value="<?= $turma['id'] ?>"><?= $turma['nome'] ?></option>
            <?php endforeach; ?>
        </select>
    </label></p>
    <button>Matricular</button>
</form>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
