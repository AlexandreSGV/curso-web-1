# 03 — Calculadora com POST

Siga as [instruções de execução](../) e abra [o formulário POST](http://localhost:8000/03-calculadora-post/index.html).

O [index.html](index.html) usa `method="post"` e `action="calcular.php"`. Os campos `name="a"` e `name="b"` chegam ao [calcular.php](calcular.php) em `$_POST`.

O PHP verifica o método, valida os valores, converte para `float`, soma e devolve uma página HTML. A calculadora aceita zero, negativos e decimais; valores ausentes ou inválidos recebem status `400`.

Abra **Rede/Network** antes de enviar. Observe o método POST, os dados no corpo da requisição e a resposta com status `200`. Os campos não ficam na URL; isso não significa que estejam criptografados pelo método POST.

Ao abrir diretamente [calcular.php](http://localhost:8000/03-calculadora-post/calcular.php) pela barra de endereço, o navegador faz GET. O exemplo responde com `405`, `Allow: POST` e uma orientação para enviar o formulário.

Compare o código com a [versão GET](../02-calculadora-get/): mudam o método aceito e o array usado para ler os dados. O processamento da soma permanece igual.
