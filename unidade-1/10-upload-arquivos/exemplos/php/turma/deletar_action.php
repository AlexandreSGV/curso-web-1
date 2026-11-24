<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$id = (int) $_POST['id'];
$consulta = $pdo->prepare('SELECT caminho FROM imagens_turma WHERE turma_id = ?');
$consulta->execute([$id]);
$imagens = $consulta->fetchAll();

$comando = $pdo->prepare('DELETE FROM turmas WHERE id = ?');
$comando->execute([$id]);

foreach ($imagens as $imagem) {
    unlink(__DIR__ . '/../../' . $imagem['caminho']);
}

header('Location: /php/turma/listar.php', true, 303);
exit;
