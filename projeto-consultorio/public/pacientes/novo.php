<?php

$camposInvalidos = ($_GET['erro'] ?? '') === 'campos';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar paciente</title>
</head>
<body>
    <header>
        <h1>Cadastrar paciente</h1>
        <nav aria-label="Navegação principal">
            <a href="../index.php">Início</a>
            <a href="index.php">Listar pacientes</a>
        </nav>
    </header>

    <main>
        <?php if ($camposInvalidos): ?>
            <p role="alert">Preencha todos os campos com valores válidos.</p>
        <?php endif; ?>

        <form action="salvar.php" method="post">
            <p>
                <label for="nome">Nome completo</label><br>
                <input type="text" id="nome" name="nome" maxlength="100" required>
            </p>

            <p>
                <label for="email">E-mail</label><br>
                <input type="email" id="email" name="email" maxlength="150" required>
            </p>

            <p>
                <label for="telefone">Telefone</label><br>
                <input type="tel" id="telefone" name="telefone" maxlength="20" required>
            </p>

            <p>
                <label for="data_nascimento">Data de nascimento</label><br>
                <input type="date" id="data_nascimento" name="data_nascimento" required>
            </p>

            <button type="submit">Cadastrar</button>
        </form>
    </main>
</body>
</html>
