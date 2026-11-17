<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$comando = $pdo->prepare('UPDATE alunos SET nome = ? WHERE id = ?');
$comando->execute([$_POST['nome'], $_POST['id']]);
ir('/aluno/listar.php');
