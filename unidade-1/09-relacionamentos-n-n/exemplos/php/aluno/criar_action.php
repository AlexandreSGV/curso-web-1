<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$comando = $pdo->prepare('INSERT INTO alunos (nome) VALUES (?)');
$comando->execute([$_POST['nome']]);
ir('/aluno/listar.php');
