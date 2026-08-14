<?php

$arquivoConfiguracao = __DIR__ . '/../../config/banco.php';

if (!file_exists($arquivoConfiguracao)) {
    http_response_code(500);
    exit('Crie config/banco.php a partir de config/banco.exemplo.php.');
}

require $arquivoConfiguracao;

$comando = $pdo->query(
    'SELECT id, nome, email, telefone, data_nascimento
     FROM pacientes
     ORDER BY nome'
);

$pacientes = $comando->fetchAll();
$cadastroRealizado = ($_GET['cadastro'] ?? '') === 'sucesso';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes cadastrados</title>
</head>
<body>
    <header>
        <h1>Pacientes cadastrados</h1>
        <nav aria-label="Navegação principal">
            <a href="../index.php">Início</a>
            <a href="novo.php">Cadastrar paciente</a>
        </nav>
    </header>

    <main>
        <?php if ($cadastroRealizado): ?>
            <p role="status">Paciente cadastrado com sucesso.</p>
        <?php endif; ?>

        <?php if ($pacientes === []): ?>
            <p>Nenhum paciente cadastrado.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Data de nascimento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pacientes as $paciente): ?>
                        <tr>
                            <td><?= (int) $paciente['id'] ?></td>
                            <td><?= htmlspecialchars($paciente['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($paciente['email'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($paciente['telefone'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($paciente['data_nascimento'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>
