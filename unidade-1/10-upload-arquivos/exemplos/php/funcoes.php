<?php

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

// Aceita apenas requisições POST nas ações dos formulários.
function exigir_post() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Allow: POST');
        http_response_code(405);
        exit('Use o formulário da página.');
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

// Move a foto temporária e devolve o caminho que será guardado no banco.
function salvar_imagem($temporario, $pasta) {
    if ($temporario === '') {
        return null;
    }

    $dataHora = date('Ymd_His');
    $sufixo = bin2hex(random_bytes(8));
    $nome = $dataHora . '_' . $sufixo . '.jpg';
    $caminho = 'storage/' . $pasta . '/' . $nome;

    return move_uploaded_file($temporario, __DIR__ . '/../' . $caminho) ? $caminho : null;
}
