<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$comando = $pdo->prepare('INSERT INTO usuarios (nome, login, senha) VALUES (?, ?, ?)');
$comando->execute([$_POST['nome'], $_POST['login'], $senha]);
ir('/php/usuario/listar.php');
