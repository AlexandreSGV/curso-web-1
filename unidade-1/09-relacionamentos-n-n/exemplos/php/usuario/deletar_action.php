<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$id = (int) $_POST['id'];
if ($id === (int) $usuarioLogado['id']) {
    ir('/usuario/detalhes.php?id=' . $id . '&conta_atual=1');
}
$comando = $pdo->prepare('DELETE FROM usuarios WHERE id = ?');
$comando->execute([$id]);
ir('/usuario/listar.php');
