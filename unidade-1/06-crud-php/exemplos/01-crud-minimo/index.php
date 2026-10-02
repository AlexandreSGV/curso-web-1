<?php
require 'conexao.php';

if (isset($_GET['excluir'])) {
    $comando = $pdo->prepare('DELETE FROM alunos WHERE id = ?');
    $comando->execute([$_GET['excluir']]);
    header('Location: index.php', true, 303);
    exit;
}

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
                <a href="update.php?id=<?= $aluno['id'] ?>">Editar</a>
                <a href="index.php?excluir=<?= $aluno['id'] ?>">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
