<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$turmaId = (int) $_POST['turma_id'];
$caminho = salvar_imagem($_FILES['foto']['tmp_name'] ?? '', 'turmas');
$comando = $pdo->prepare(
    'INSERT INTO imagens_turma (turma_id, titulo, descricao, tag, caminho) VALUES (?, ?, ?, ?, ?)'
);
$comando->execute([$turmaId, $_POST['titulo'], $_POST['descricao'], $_POST['tag'], $caminho]);

header('Location: /php/imagem_turma/listar.php?turma_id=' . $turmaId, true, 303);
exit;
