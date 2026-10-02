<?php
require 'conexao.php';

$consulta = $pdo->prepare('SELECT * FROM alunos WHERE id = ?');
$consulta->execute([$_GET['id']]);
$aluno = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<h1>Detalhes do aluno</h1>
<p>ID: <?= $aluno['id'] ?></p>
<p>Nome: <?= $aluno['nome'] ?></p>
<p>E-mail: <?= $aluno['email'] ?></p>
<p>Data de nascimento: <?= $aluno['data_nascimento'] ?></p>
<p>Telefone: <?= $aluno['telefone'] ?></p>

<a href="update.php?id=<?= $aluno['id'] ?>">Editar</a>
<a href="delete.php?id=<?= $aluno['id'] ?>">Excluir</a>
<a href="index.php">Voltar à listagem</a>
