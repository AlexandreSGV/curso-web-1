<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$comando = $pdo->prepare('INSERT INTO professores (nome) VALUES (?)');
$comando->execute([$_POST['nome']]);
ir('/professor/listar.php');
