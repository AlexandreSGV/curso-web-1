<?php
header('Content-Type: text/html; charset=utf-8');
$nome = $_GET['nome'] ?? 'Visitante';

if (!is_string($nome) || trim($nome) === '') {
    $nome = 'Visitante';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>Boas-vindas</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
<main>
  <h1>Olá, <?= htmlspecialchars($nome) ?>!</h1>
  <p>O navegador abriu esta página com GET depois de receber um redirecionamento 303.</p>
  <p>O nome veio pela URL. Este exemplo não armazena dados.</p>
  <a href="index.html">Voltar ao formulário</a>
</main>
</body>
</html>
