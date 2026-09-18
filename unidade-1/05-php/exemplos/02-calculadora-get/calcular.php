<?php
$a = (float) $_GET['a'];
$b = (float) $_GET['b'];
$resultado = $a + $b;
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
