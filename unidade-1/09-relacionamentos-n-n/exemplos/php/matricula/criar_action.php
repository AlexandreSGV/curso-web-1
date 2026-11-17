<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$turmaId = (int) $_POST['turma_id'];
try {
    $comando = $pdo->prepare(
        'INSERT INTO matriculas (aluno_id, turma_id) VALUES (?, ?)
         ON DUPLICATE KEY UPDATE aluno_id = aluno_id'
    );
    $comando->execute([$_POST['aluno_id'], $turmaId]);
} catch (PDOException $erro) {
    if ($erro->getCode() !== '23000') {
        throw $erro;
    }
    ir('/matricula/criar_ids_form.php?ids_invalidos=1');
}

ir('/turma/detalhes.php?id=' . $turmaId);
