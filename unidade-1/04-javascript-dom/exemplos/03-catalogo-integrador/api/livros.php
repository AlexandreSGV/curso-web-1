<?php
// Apoio à atividade de JavaScript: uma API de consulta, sem banco de dados.
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Allow: GET');
    http_response_code(405);
    echo json_encode(['erro' => 'Use o método GET.']);
    exit;
}

$busca = $_GET['busca'] ?? '';

if (!is_string($busca)) {
    http_response_code(400);
    echo json_encode(['erro' => 'A busca deve ser um texto.']);
    exit;
}

$busca = trim($busca);

// O servidor repete a validação: de 2 a 60 caracteres em um texto UTF-8.
if (preg_match('/\A.{2,60}\z/us', $busca) !== 1) {
    http_response_code(400);
    echo json_encode(['erro' => 'Digite de 2 a 60 caracteres.']);
    exit;
}

$livros = [
    ['id' => 1, 'titulo' => 'HTML e CSS: primeiros passos', 'autor' => 'Ana Lima', 'ano' => 2023],
    ['id' => 2, 'titulo' => 'JavaScript no navegador', 'autor' => 'Bruno Alves', 'ano' => 2024],
    ['id' => 3, 'titulo' => 'DOM e eventos com JavaScript', 'autor' => 'Ana Lima', 'ano' => 2025],
    ['id' => 4, 'titulo' => 'PHP para a Web', 'autor' => 'Carla Santos', 'ano' => 2024],
    ['id' => 5, 'titulo' => 'Banco de dados com SQL', 'autor' => 'Daniel Costa', 'ano' => 2022],
    ['id' => 6, 'titulo' => 'HTTP: pedidos e respostas', 'autor' => 'Eva Souza', 'ano' => 2025]
];

$resultado = [];

foreach ($livros as $livro) {
    $texto = $livro['titulo'] . ' ' . $livro['autor'];

    if (stripos($texto, $busca) !== false) {
        $resultado[] = $livro;
    }
}

echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
