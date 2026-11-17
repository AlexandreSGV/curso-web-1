<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

if ($_POST['senha'] === '') {
    $comando = $pdo->prepare('UPDATE usuarios SET nome = ?, login = ? WHERE id = ?');
    $comando->execute([$_POST['nome'], $_POST['login'], $_POST['id']]);
} else {
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $comando = $pdo->prepare('UPDATE usuarios SET nome = ?, login = ?, senha = ? WHERE id = ?');
    $comando->execute([$_POST['nome'], $_POST['login'], $senha, $_POST['id']]);
}
ir('/usuario/listar.php');
