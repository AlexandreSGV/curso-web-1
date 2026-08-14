<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: novo.php');
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$dataNascimento = $_POST['data_nascimento'] ?? '';

$partesData = explode('-', $dataNascimento);
$dataValida = count($partesData) === 3
    && checkdate((int) $partesData[1], (int) $partesData[2], (int) $partesData[0]);

if (
    $nome === ''
    || filter_var($email, FILTER_VALIDATE_EMAIL) === false
    || $telefone === ''
    || !$dataValida
) {
    header('Location: novo.php?erro=campos');
    exit;
}

$arquivoConfiguracao = __DIR__ . '/../../config/banco.php';

if (!file_exists($arquivoConfiguracao)) {
    http_response_code(500);
    exit('Crie config/banco.php a partir de config/banco.exemplo.php.');
}

require $arquivoConfiguracao;

try {
    $comando = $pdo->prepare(
        'INSERT INTO pacientes (nome, email, telefone, data_nascimento)
         VALUES (:nome, :email, :telefone, :data_nascimento)'
    );

    $comando->execute([
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone,
        'data_nascimento' => $dataNascimento,
    ]);
} catch (PDOException $erro) {
    http_response_code(500);
    exit('Não foi possível cadastrar o paciente. Tente novamente.');
}

header('Location: index.php?cadastro=sucesso');
exit;
