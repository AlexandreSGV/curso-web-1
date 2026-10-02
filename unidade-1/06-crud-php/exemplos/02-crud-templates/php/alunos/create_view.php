<?php include '../templates/cabecalho.php'; ?>
<?php include '../templates/menu.php'; ?>

<main class="mx-auto max-w-5xl p-6">
    <h1 class="mb-4 text-2xl">Cadastrar aluno</h1>
    <form action="create_action.php" method="post" class="max-w-md space-y-3">
        <p>Nome: <input name="nome" class="block w-full border p-2"></p>
        <p>E-mail: <input name="email" class="block w-full border p-2"></p>
        <p>Data de nascimento: <input type="date" name="data_nascimento" class="block w-full border p-2"></p>
        <p>Telefone: <input type="tel" name="telefone" class="block w-full border p-2"></p>
        <button class="bg-blue-700 px-3 py-2 text-white">Salvar</button>
        <a href="index.php" class="text-blue-700 underline">Voltar</a>
    </form>
</main>

<?php include '../templates/rodape.php'; ?>
