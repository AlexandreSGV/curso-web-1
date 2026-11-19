<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$id = (int) $_POST['id'];
if ($id === (int) $usuarioLogado['id']) {
    header('Location: /php/usuario/detalhes.php?id=' . $id . '&conta_atual=1', true, 303);
    exit;
}
$comando = $pdo->prepare('DELETE FROM usuarios WHERE id = ?');
$comando->execute([$id]);
header('Location: /php/usuario/listar.php', true, 303);
exit;
