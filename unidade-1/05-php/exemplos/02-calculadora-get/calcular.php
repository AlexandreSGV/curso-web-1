<?php
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Allow: GET');
    http_response_code(405);
    exit('Use o método GET.');
}

$a = $_GET['a'] ?? '';
$b = $_GET['b'] ?? '';

if (!is_numeric($a) || !is_numeric($b)) {
    http_response_code(400);
    exit('Informe dois números válidos.');
}

$a = (float) $a;
$b = (float) $b;
$resultado = $a + $b;

if (!is_finite($resultado)) {
    http_response_code(400);
    exit('Os valores ultrapassam o limite numérico deste cálculo.');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>Resultado com GET</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
<main>
  <h1>Resultado com GET</h1>
  <p class="resultado"><?= $a ?> + <?= $b ?> = <strong><?= $resultado ?></strong></p>
  <p>Observe os valores de a e b na URL.</p>
  <a href="index.html">Novo cálculo</a>
</main>
</body>
</html>
