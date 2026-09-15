<?php
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit('Envie o formulário pelo método POST.');
}

$a = $_POST['a'] ?? '';
$b = $_POST['b'] ?? '';

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
  <title>Resultado com POST</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
<main>
  <h1>Resultado com POST</h1>
  <p class="resultado"><?= $a ?> + <?= $b ?> = <strong><?= $resultado ?></strong></p>
  <p>O PHP recebeu os valores do corpo da mensagem HTTP.</p>
  <a href="index.html">Novo cálculo</a>
</main>
</body>
</html>
