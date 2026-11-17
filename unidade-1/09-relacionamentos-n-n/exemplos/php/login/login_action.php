<?php
require __DIR__ . '/../inicio.php';
exigir_post();

$consulta = $pdo->prepare('SELECT id, senha FROM usuarios WHERE login = ?');
$consulta->execute([$_POST['login']]);
$usuario = $consulta->fetch();

if (!$usuario || !password_verify($_POST['senha'], $usuario['senha'])) {
    ir('/login/form.php?erro=1');
}

session_regenerate_id(true);
$_SESSION = ['usuario_id' => $usuario['id']];
ir('/');
