<?php
require '../conexao.php';

$comando = $pdo->prepare(
    'UPDATE alunos SET nome = ?, email = ?, data_nascimento = ?, telefone = ? WHERE id = ?'
);
$comando->execute([
    $_POST['nome'], $_POST['email'], $_POST['data_nascimento'], $_POST['telefone'], $_POST['id']
]);
header('Location: index.php', true, 303);
exit;
