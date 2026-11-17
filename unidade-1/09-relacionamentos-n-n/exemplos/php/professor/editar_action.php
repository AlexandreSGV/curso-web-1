<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$comando = $pdo->prepare('UPDATE professores SET nome = ? WHERE id = ?');
$comando->execute([$_POST['nome'], $_POST['id']]);
ir('/professor/listar.php');
