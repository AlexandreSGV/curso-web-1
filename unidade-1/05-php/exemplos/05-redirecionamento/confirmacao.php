<?php
$nome = $_GET['nome'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>Boas-vindas</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
<main>
  <h1>Olá, <?= $nome ?>!</h1>
  <p>O navegador abriu esta página com GET depois de receber um redirecionamento 303.</p>
  <p>O nome veio pela URL. Este exemplo não armazena dados.</p>
  <a href="index.html">Voltar ao formulário</a>
</main>
</body>
</html>
