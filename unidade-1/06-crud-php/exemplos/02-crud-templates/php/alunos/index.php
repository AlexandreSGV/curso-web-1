<?php
require '../conexao.php';
$consulta = $pdo->query('SELECT * FROM alunos');
$alunos = $consulta->fetchAll(PDO::FETCH_ASSOC);

include '../templates/cabecalho.php';
include '../templates/menu.php';
?>

<main class="mx-auto max-w-5xl p-6">
    <h1 class="mb-4 text-2xl">Alunos</h1>
    <a href="create_view.php" class="text-blue-700 underline">Cadastrar aluno</a>

    <div class="overflow-x-auto">
        <table class="mt-4 border-separate border-spacing-3 bg-white text-left">
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
                        <a href="show.php?id=<?= $aluno['id'] ?>" class="text-blue-700 underline">Ver detalhes</a>
                        <a href="update_view.php?id=<?= $aluno['id'] ?>" class="text-blue-700 underline">Editar</a>
                        <form action="delete_action.php" method="post">
                            <input type="hidden" name="id" value="<?= $aluno['id'] ?>">
                            <button class="text-red-700 underline">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</main>

<?php include '../templates/rodape.php'; ?>
