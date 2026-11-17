<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$turmaId = (int) $_POST['turma_id'];
$comando = $pdo->prepare('DELETE FROM matriculas WHERE aluno_id = ? AND turma_id = ?');
$comando->execute([$_POST['aluno_id'], $turmaId]);

ir('/turma/detalhes.php?id=' . $turmaId);
