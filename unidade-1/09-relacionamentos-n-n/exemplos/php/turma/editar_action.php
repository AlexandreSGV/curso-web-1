<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$comando = $pdo->prepare('UPDATE turmas SET nome = ?, professor_id = ? WHERE id = ?');
$comando->execute([$_POST['nome'], $_POST['professor_id'], $_POST['id']]);
ir('/turma/listar.php');
