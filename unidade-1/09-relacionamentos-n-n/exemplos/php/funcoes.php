<?php

function h($texto) {
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function ir($url) {
    header('Location: ' . $url, true, 303);
    exit;
}

function usuario_logado($pdo) {
    $consulta = $pdo->prepare('SELECT id, nome FROM usuarios WHERE id = ?');
    $consulta->execute([$_SESSION['usuario_id']]);
    $usuario = $consulta->fetch();
    if (!$usuario) {
        unset($_SESSION['usuario_id']);
    }
    return $usuario;
}

function campo_token() {
    $_SESSION['token'] ??= bin2hex(random_bytes(32));
    echo '<input type="hidden" name="token" value="' . h($_SESSION['token']) . '">';
}

function exigir_post() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Allow: POST');
        http_response_code(405);
        exit('Use o formulário da página.');
    }
    $token = $_POST['token'] ?? '';
    if (!isset($_SESSION['token']) || !is_string($token) || !hash_equals($_SESSION['token'], $token)) {
        http_response_code(403);
        exit('Formulário inválido. Volte à página e tente novamente.');
    }
}

function buscar($pdo, $sql, $id) {
    $consulta = $pdo->prepare($sql);
    $consulta->execute([$id]);
    $registro = $consulta->fetch();
    if (!$registro) {
        http_response_code(404);
        exit('Registro não encontrado.');
    }
    return $registro;
}
