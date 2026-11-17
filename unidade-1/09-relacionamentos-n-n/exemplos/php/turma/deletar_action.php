<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$id = (int) $_POST['id'];
$comando = $pdo->prepare('DELETE FROM turmas WHERE id = ?');
$comando->execute([$id]);
ir('/turma/listar.php');
