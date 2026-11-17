<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$id = (int) $_POST['id'];
$comando = $pdo->prepare('DELETE FROM alunos WHERE id = ?');
$comando->execute([$id]);
ir('/aluno/listar.php');
