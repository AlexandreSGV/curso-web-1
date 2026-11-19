<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$id = (int) $_POST['id'];
$comando = $pdo->prepare('DELETE FROM alunos WHERE id = ?');
$comando->execute([$id]);
header('Location: /php/aluno/listar.php', true, 303);
exit;
