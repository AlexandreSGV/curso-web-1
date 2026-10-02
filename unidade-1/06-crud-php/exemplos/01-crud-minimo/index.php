<?php
require 'conexao.php';

$consulta = $pdo->query('SELECT * FROM alunos');
$alunos = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Alunos</h1>
<a href="create.php">Cadastrar aluno</a>

<table>
    <tr>
        <th>ID</th><th>Nome</th><th>E-mail</th><th>Data de nascimento</th><th>Telefone</th><th>Ações</th>
    </tr>
    <?php foreach ($alunos as $aluno): ?>
        <tr>
            <td><?= $aluno['id'] ?></td>
            <td><?= $aluno['nome'] ?></td>
            <td><?= $aluno['email'] ?></td>
            <td><?= $aluno['data_nascimento'] ?></td>
            <td><?= $aluno['telefone'] ?></td>
            <td>
                <a href="show.php?id=<?= $aluno['id'] ?>">Ver detalhes</a>
                <a href="update.php?id=<?= $aluno['id'] ?>">Editar</a>
                <a href="delete.php?id=<?= $aluno['id'] ?>">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
