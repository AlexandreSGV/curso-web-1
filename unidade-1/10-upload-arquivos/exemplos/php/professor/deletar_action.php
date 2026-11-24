<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$id = (int) $_POST['id'];
$registro = buscar($pdo, 'SELECT foto_caminho FROM professores WHERE id = ?', $id);
$turmas = $pdo->prepare('SELECT id FROM turmas WHERE professor_id = ?');
$turmas->execute([$id]);
if ($turmas->fetch()) {
    header('Location: /php/professor/detalhes.php?id=' . $id . '&em_uso=1', true, 303);
    exit;
}

$comando = $pdo->prepare('DELETE FROM professores WHERE id = ?');
$comando->execute([$id]);

if ($registro['foto_caminho'] !== null) {
    unlink(__DIR__ . '/../../' . $registro['foto_caminho']);
}

header('Location: /php/professor/listar.php', true, 303);
exit;
