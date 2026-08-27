<?php

header('X-Aula-Web1: servidor-local');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeiro servidor de Web 1</title>
</head>
<body>
    <h1>Servidor local funcionando</h1>
    <p>Esta página foi enviada pelo servidor do PHP.</p>

    <ul>
        <li><a href="/?origem=aula">Fazer outra requisição GET</a></li>
        <li><a href="/pagina-inexistente.php">Solicitar uma página que não existe</a></li>
    </ul>

    <p>Abra a aba Network das ferramentas do navegador para observar cada resposta.</p>
</body>
</html>
