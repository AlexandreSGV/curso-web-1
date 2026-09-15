<?php
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit('Envie o formulário pelo método POST.');
}

$nome = $_POST['nome'] ?? '';

if (!is_string($nome) || trim($nome) === '') {
    http_response_code(400);
    exit('Informe um nome.');
}

$nome = trim($nome);
header('Location: confirmacao.php?nome=' . rawurlencode($nome), true, 303);
exit;
