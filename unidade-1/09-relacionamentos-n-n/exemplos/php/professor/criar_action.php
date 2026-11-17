<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$comando = $pdo->prepare('INSERT INTO professores (nome) VALUES (?)');
$comando->execute([$_POST['nome']]);
ir('/php/professor/listar.php');
