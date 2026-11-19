<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$comando = $pdo->prepare('INSERT INTO alunos (nome) VALUES (?)');
$comando->execute([$_POST['nome']]);
header('Location: /php/aluno/listar.php', true, 303);
exit;
