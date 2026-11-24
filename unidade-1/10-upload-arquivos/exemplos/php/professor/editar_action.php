<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$id = (int) $_POST['id'];
$registro = buscar($pdo, 'SELECT foto_caminho FROM professores WHERE id = ?', $id);
$novaFoto = salvar_imagem($_FILES['foto']['tmp_name'] ?? '', 'professor');

$comando = $pdo->prepare('UPDATE professores SET nome = ?, foto_caminho = ? WHERE id = ?');
$comando->execute([$_POST['nome'], $novaFoto ?? $registro['foto_caminho'], $id]);

if ($novaFoto !== null && $registro['foto_caminho'] !== null) {
    unlink(__DIR__ . '/../../' . $registro['foto_caminho']);
}

header('Location: /php/professor/listar.php', true, 303);
exit;
