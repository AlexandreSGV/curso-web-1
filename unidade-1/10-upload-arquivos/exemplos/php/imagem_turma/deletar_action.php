<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$id = (int) $_POST['id'];
$imagem = buscar($pdo, 'SELECT turma_id, caminho FROM imagens_turma WHERE id = ?', $id);
$comando = $pdo->prepare('DELETE FROM imagens_turma WHERE id = ?');
$comando->execute([$id]);
unlink(__DIR__ . '/../../' . $imagem['caminho']);

header('Location: /php/imagem_turma/listar.php?turma_id=' . $imagem['turma_id'], true, 303);
exit;
