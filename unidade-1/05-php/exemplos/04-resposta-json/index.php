<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Allow: GET');
    http_response_code(405);
    echo json_encode(['erro' => 'Use o método GET.']);
    exit;
}

$a = $_GET['a'] ?? '';
$b = $_GET['b'] ?? '';

if (!is_numeric($a) || !is_numeric($b)) {
    http_response_code(400);
    echo json_encode(['erro' => 'Informe dois números válidos.']);
    exit;
}

$resultado = (float) $a + (float) $b;

if (!is_finite($resultado)) {
    http_response_code(400);
    echo json_encode(['erro' => 'Valores fora do limite numérico.']);
    exit;
}

http_response_code(200);
echo json_encode(['resultado' => $resultado]);
