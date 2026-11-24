<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$alunoId = (int) $_POST['aluno_id'];
$turmaId = (int) $_POST['turma_id'];
$aluno = $pdo->prepare('SELECT id FROM alunos WHERE id = ?');
$aluno->execute([$alunoId]);
$turma = $pdo->prepare('SELECT id FROM turmas WHERE id = ?');
$turma->execute([$turmaId]);
if (!$aluno->fetch() || !$turma->fetch()) {
    header('Location: /php/matricula/criar_ids_form.php?ids_invalidos=1', true, 303);
    exit;
}

$comando = $pdo->prepare(
    'INSERT INTO matriculas (aluno_id, turma_id) VALUES (?, ?)
     ON DUPLICATE KEY UPDATE aluno_id = aluno_id'
);
$comando->execute([$alunoId, $turmaId]);

header('Location: /php/turma/detalhes.php?id=' . $turmaId, true, 303);
exit;
