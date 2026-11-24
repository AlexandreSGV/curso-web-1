<?php
session_start(['use_strict_mode' => true, 'cookie_httponly' => true, 'cookie_samesite' => 'Lax']);
require __DIR__ . '/../funcoes.php';
exigir_post();
require __DIR__ . '/../../config/conexao.php';

$consulta = $pdo->prepare('SELECT id, senha FROM usuarios WHERE login = ?');
$consulta->execute([$_POST['login']]);
$usuario = $consulta->fetch();

if (!$usuario || !password_verify($_POST['senha'], $usuario['senha'])) {
    header('Location: /php/login/form.php?erro=1', true, 303);
    exit;
}

session_regenerate_id(true);
$_SESSION = ['usuario_id' => $usuario['id']];
header('Location: /', true, 303);
exit;
