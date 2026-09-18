<?php
$a = (float) $_POST['a'];
$b = (float) $_POST['b'];
$resultado = $a + $b;
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
