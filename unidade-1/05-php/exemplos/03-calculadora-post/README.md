# 03 — Calculadora com POST

Siga as [instruções de execução](../) e abra [o formulário POST](http://localhost:8000/03-calculadora-post/index.html).

O [index.html](index.html) usa `method="post"` e `action="calcular.php"`. Os campos `name="a"` e `name="b"` chegam ao [calcular.php](calcular.php) em `$_POST`.

O PHP lê os dois valores, converte para `float`, soma e devolve uma página HTML. Experimente `10` e `5`: o resultado será `15`. Depois teste zero, negativos e decimais.

Abra **Rede/Network** antes de enviar. Observe o método POST, os dados no corpo da requisição e a resposta com status `200`. Os campos não ficam na URL; isso não significa que estejam criptografados pelo método POST.

Comece pelo `index.html` e envie o formulário: esse envio fornece os valores que a action espera receber em `$_POST`.

Compare o código com a [versão GET](../02-calculadora-get/): mudam o `method` do formulário e o array usado para ler os dados. O processamento da soma permanece igual.
