<?php
header('Content-Type: application/json');
http_response_code(200);

$a = (float) $_GET['a'];
$b = (float) $_GET['b'];
$resultado = $a + $b;

echo json_encode(['resultado' => $resultado]);
