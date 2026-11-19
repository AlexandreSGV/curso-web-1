<?php
require __DIR__ . '/../funcoes.php';
exigir_post();
require __DIR__ . '/../../config/conexao.php';

$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$comando = $pdo->prepare('INSERT INTO usuarios (nome, login, senha) VALUES (?, ?, ?)');
$comando->execute([$_POST['nome'], $_POST['login'], $senha]);
header('Location: /php/login/form.php', true, 303);
exit;
