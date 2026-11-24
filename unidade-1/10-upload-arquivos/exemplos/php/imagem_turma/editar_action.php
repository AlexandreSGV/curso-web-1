<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$id = (int) $_POST['id'];
$imagem = buscar($pdo, 'SELECT caminho FROM imagens_turma WHERE id = ?', $id);
$novoCaminho = salvar_imagem($_FILES['foto']['tmp_name'] ?? '', 'turmas');

$comando = $pdo->prepare('UPDATE imagens_turma SET titulo = ?, descricao = ?, tag = ?, caminho = ? WHERE id = ?');
$comando->execute([$_POST['titulo'], $_POST['descricao'], $_POST['tag'], $novoCaminho ?? $imagem['caminho'], $id]);

if ($novoCaminho !== null) {
    unlink(__DIR__ . '/../../' . $imagem['caminho']);
}

header('Location: /php/imagem_turma/detalhes.php?id=' . $id, true, 303);
exit;
