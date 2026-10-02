<?php
require '../conexao.php';

$comando = $pdo->prepare(
    'INSERT INTO alunos (nome, email, data_nascimento, telefone) VALUES (?, ?, ?, ?)'
);
$comando->execute([$_POST['nome'], $_POST['email'], $_POST['data_nascimento'], $_POST['telefone']]);
header('Location: index.php', true, 303);
exit;
