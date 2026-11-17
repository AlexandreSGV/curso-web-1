<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$comando = $pdo->prepare('INSERT INTO turmas (nome, professor_id) VALUES (?, ?)');
$comando->execute([$_POST['nome'], $_POST['professor_id']]);
ir('/turma/listar.php');
