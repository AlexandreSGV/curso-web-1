<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$comando = $pdo->prepare('UPDATE professores SET nome = ? WHERE id = ?');
$comando->execute([$_POST['nome'], $_POST['id']]);
header('Location: /php/professor/listar.php', true, 303);
exit;
