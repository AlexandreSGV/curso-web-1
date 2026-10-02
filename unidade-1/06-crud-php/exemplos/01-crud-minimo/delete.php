<?php
require 'conexao.php';

$comando = $pdo->prepare('DELETE FROM alunos WHERE id = ?');
$comando->execute([$_GET['id']]);
header('Location: index.php', true, 303);
exit;
