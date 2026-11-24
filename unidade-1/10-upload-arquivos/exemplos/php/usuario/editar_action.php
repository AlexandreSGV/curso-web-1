<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

if ($_POST['senha'] === '') {
    $comando = $pdo->prepare('UPDATE usuarios SET nome = ?, login = ? WHERE id = ?');
    $comando->execute([$_POST['nome'], $_POST['login'], $_POST['id']]);
} else {
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $comando = $pdo->prepare('UPDATE usuarios SET nome = ?, login = ?, senha = ? WHERE id = ?');
    $comando->execute([$_POST['nome'], $_POST['login'], $senha, $_POST['id']]);
}
header('Location: /php/usuario/listar.php', true, 303);
exit;
