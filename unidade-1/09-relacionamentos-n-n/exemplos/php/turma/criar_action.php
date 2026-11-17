<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$comando = $pdo->prepare('INSERT INTO turmas (nome, professor_id) VALUES (?, ?)');
$comando->execute([$_POST['nome'], $_POST['professor_id']]);
ir('/php/turma/listar.php');
