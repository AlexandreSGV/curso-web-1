<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$id = (int) $_POST['id'];
$registro = buscar($pdo, 'SELECT foto_caminho FROM alunos WHERE id = ?', $id);
$comando = $pdo->prepare('DELETE FROM alunos WHERE id = ?');
$comando->execute([$id]);

if ($registro['foto_caminho'] !== null) {
    unlink(__DIR__ . '/../../' . $registro['foto_caminho']);
}

header('Location: /php/aluno/listar.php', true, 303);
exit;
