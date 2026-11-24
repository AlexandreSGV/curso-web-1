<?php
session_start(['use_strict_mode' => true, 'cookie_httponly' => true, 'cookie_samesite' => 'Lax']);
require __DIR__ . '/funcoes.php';

$usuarioLogado = null;
if (isset($_SESSION['usuario_id'])) {
    require __DIR__ . '/../config/conexao.php';
    $usuarioLogado = usuario_logado($pdo);
}

if (!$usuarioLogado) {
    header('Location: /php/login/form.php', true, 303);
    exit;
}
