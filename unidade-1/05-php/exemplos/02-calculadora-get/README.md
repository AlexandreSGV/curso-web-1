# 02 — Calculadora com GET

Siga as [instruções de execução](../) e abra [o formulário GET](http://localhost:8000/02-calculadora-get/index.html).

O [index.html](index.html) envia `a` e `b` para [calcular.php](calcular.php). O PHP lê os dois valores em `$_GET`, converte para `float` e prepara uma página com a soma.

Também é possível enviar os valores diretamente pela URL:

```text
http://localhost:8000/02-calculadora-get/calcular.php?a=10&b=5
```

Experimente alterar os parâmetros:

| Parâmetros | Resultado esperado |
|---|---|
| `?a=10&b=5` | `15`, status `200` |
| `?a=0&b=-3` | `-3`, status `200` |
| `?a=2.5&b=1.25` | `3.75`, status `200` |

Envie os dois números, pelo formulário ou pela URL. Na URL, use ponto para a parte decimal. O processamento ocupa três instruções: ler `a`, ler `b` e somar.

Compare com a [versão POST](../03-calculadora-post/). As duas realizam apenas a soma para tornar a diferença entre os métodos fácil de localizar.
