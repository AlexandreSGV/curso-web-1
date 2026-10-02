<?php
require '../conexao.php';
$consulta = $pdo->prepare('SELECT * FROM alunos WHERE id = ?');
$consulta->execute([$_GET['id']]);
$aluno = $consulta->fetch(PDO::FETCH_ASSOC);

include '../templates/cabecalho.php';
include '../templates/menu.php';
?>

<main class="mx-auto max-w-5xl p-6">
    <h1 class="mb-4 text-2xl">Editar aluno</h1>
    <form action="update_action.php" method="post" class="max-w-md space-y-3">
        <input type="hidden" name="id" value="<?= $aluno['id'] ?>">
        <p>Nome: <input name="nome" value="<?= $aluno['nome'] ?>" class="block w-full border p-2"></p>
        <p>E-mail: <input name="email" value="<?= $aluno['email'] ?>" class="block w-full border p-2"></p>
        <p>Data de nascimento: <input type="date" name="data_nascimento" value="<?= $aluno['data_nascimento'] ?>" class="block w-full border p-2"></p>
        <p>Telefone: <input type="tel" name="telefone" value="<?= $aluno['telefone'] ?>" class="block w-full border p-2"></p>
        <button class="bg-blue-700 px-3 py-2 text-white">Salvar alterações</button>
        <a href="index.php" class="text-blue-700 underline">Voltar</a>
    </form>
</main>

<?php include '../templates/rodape.php'; ?>
