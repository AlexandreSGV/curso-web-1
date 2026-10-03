<?php
require 'conexao.php';
header('Content-Type: application/json; charset=utf-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

if ($metodo === 'GET') {
    if ($id !== null) {
        $comando = $pdo->prepare('SELECT * FROM alunos WHERE id = ?');
        $comando->execute([$id]);
        $aluno = $comando->fetch(PDO::FETCH_ASSOC);

        if (!$aluno) {
            http_response_code(404);
            echo json_encode(['mensagem' => 'Aluno não encontrado.']);
            exit;
        }

        echo json_encode($aluno);
    } else {
        $alunos = $pdo->query('SELECT * FROM alunos ORDER BY id DESC');
        echo json_encode($alunos->fetchAll(PDO::FETCH_ASSOC));
    }
    exit;
}

// POST e PUT enviam JSON no corpo da requisição.
$dados = json_decode(file_get_contents('php://input'), true);

if ($metodo === 'POST') {
    $comando = $pdo->prepare(
        'INSERT INTO alunos (nome, email, data_nascimento, telefone) VALUES (?, ?, ?, ?)'
    );
    $comando->execute([$dados['nome'], $dados['email'], $dados['data_nascimento'], $dados['telefone']]);
    http_response_code(201);
    echo json_encode(['id' => (int) $pdo->lastInsertId(), 'mensagem' => 'Aluno cadastrado.']);
} elseif ($metodo === 'PUT') {
    $comando = $pdo->prepare(
        'UPDATE alunos SET nome = ?, email = ?, data_nascimento = ?, telefone = ? WHERE id = ?'
    );
    $comando->execute([$dados['nome'], $dados['email'], $dados['data_nascimento'], $dados['telefone'], $id]);
    echo json_encode(['mensagem' => 'Alteração concluída.']);
} elseif ($metodo === 'DELETE') {
    $comando = $pdo->prepare('DELETE FROM alunos WHERE id = ?');
    $comando->execute([$id]);
    echo json_encode(['mensagem' => 'Exclusão concluída.']);
} else {
    http_response_code(405);
    header('Allow: GET, POST, PUT, DELETE');
    echo json_encode(['mensagem' => 'Método não disponível.']);
}
