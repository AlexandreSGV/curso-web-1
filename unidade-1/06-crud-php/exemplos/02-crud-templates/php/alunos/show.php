<?php
require '../conexao.php';
$consulta = $pdo->prepare('SELECT * FROM alunos WHERE id = ?');
$consulta->execute([$_GET['id']]);
$aluno = $consulta->fetch(PDO::FETCH_ASSOC);

include '../templates/cabecalho.php';
include '../templates/menu.php';
?>

<main class="mx-auto max-w-5xl p-6">
    <h1 class="mb-4 text-2xl">Detalhes do aluno</h1>
    <div class="space-y-2 bg-white p-4">
        <p>ID: <?= $aluno['id'] ?></p>
        <p>Nome: <?= $aluno['nome'] ?></p>
        <p>E-mail: <?= $aluno['email'] ?></p>
        <p>Data de nascimento: <?= $aluno['data_nascimento'] ?></p>
        <p>Telefone: <?= $aluno['telefone'] ?></p>
    </div>

    <a href="update_view.php?id=<?= $aluno['id'] ?>" class="text-blue-700 underline">Editar</a>
    <a href="index.php" class="text-blue-700 underline">Voltar à listagem</a>
    <form action="delete_action.php" method="post">
        <input type="hidden" name="id" value="<?= $aluno['id'] ?>">
        <button class="text-red-700 underline">Excluir</button>
    </form>
</main>

<?php include '../templates/rodape.php'; ?>
