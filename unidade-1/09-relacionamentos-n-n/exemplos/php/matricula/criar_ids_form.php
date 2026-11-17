<?php
require __DIR__ . '/../inicio.php';
exigir_login();
$titulo = 'Matrícula por IDs';
include __DIR__ . '/../../templates/cabecalho.php';
?>
<h1>Matrícula por IDs</h1>
<?php if (isset($_GET['ids_invalidos'])): ?>
    <p>Confira se o aluno e a turma existem.</p>
<?php endif; ?>
<p>Consulte os números em <a href="/aluno/listar.php">Alunos</a> e <a href="/turma/listar.php">Turmas</a>.</p>
<form method="post" action="criar_action.php">
    <?php campo_token(); ?>
    <p><label>ID do aluno: <input type="number" name="aluno_id" min="1" required></label></p>
    <p><label>ID da turma: <input type="number" name="turma_id" min="1" required></label></p>
    <button>Matricular</button>
</form>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>
