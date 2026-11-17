<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$comando = $pdo->prepare('UPDATE professores SET nome = ? WHERE id = ?');
$comando->execute([$_POST['nome'], $_POST['id']]);
ir('/php/professor/listar.php');
