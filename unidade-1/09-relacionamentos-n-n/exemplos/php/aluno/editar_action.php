<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$comando = $pdo->prepare('UPDATE alunos SET nome = ? WHERE id = ?');
$comando->execute([$_POST['nome'], $_POST['id']]);
header('Location: /php/aluno/listar.php', true, 303);
exit;
