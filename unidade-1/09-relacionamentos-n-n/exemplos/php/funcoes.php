<?php

// Redireciona o navegador com status 303 e encerra o script.
function ir($url) {
    header('Location: ' . $url, true, 303);
    exit;
}

// Busca o usuário pelo ID da sessão. Se a conta foi excluída, limpa o ID.
function usuario_logado($pdo) {
    $consulta = $pdo->prepare('SELECT id, nome FROM usuarios WHERE id = ?');
    $consulta->execute([$_SESSION['usuario_id']]);
    $usuario = $consulta->fetch();
    if (!$usuario) {
        unset($_SESSION['usuario_id']);
    }
    return $usuario;
}

// Cria o token da sessão se necessário e o inclui como campo oculto no formulário.
function campo_token() {
    $_SESSION['token'] ??= bin2hex(random_bytes(32));
    echo '<input type="hidden" name="token" value="' . $_SESSION['token'] . '">';
}

// Aceita apenas POST e verifica se o formulário enviou o token da sessão.
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

// Executa uma consulta com um ID como parâmetro. Se não encontrar o registro, responde 404.
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
