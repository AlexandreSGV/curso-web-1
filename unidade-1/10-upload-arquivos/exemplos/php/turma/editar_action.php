<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$comando = $pdo->prepare('UPDATE turmas SET nome = ?, professor_id = ? WHERE id = ?');
$comando->execute([$_POST['nome'], $_POST['professor_id'], $_POST['id']]);
header('Location: /php/turma/listar.php', true, 303);
exit;
