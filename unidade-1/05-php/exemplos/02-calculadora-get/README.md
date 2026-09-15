# 02 — Calculadora com GET

Siga as [instruções de execução](../) e abra [o formulário GET](http://localhost:8000/02-calculadora-get/index.html).

O [index.html](index.html) envia `a` e `b` para [calcular.php](calcular.php). O PHP lê `$_GET`, valida os valores e prepara uma página com a soma.

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
| `?a=abc&b=5` | Mensagem de erro, status `400` |
| `?a=10` | Mensagem de erro, status `400` |

Na URL, use ponto para a parte decimal. A validação ocorre antes da conversão para `float`; zero é aceito. `is_finite()` rejeita resultados que ultrapassem o limite numérico. Uma requisição com método diferente de GET recebe `405` e `Allow: GET`.

Compare com a [versão POST](../03-calculadora-post/). As duas realizam apenas a soma para tornar a diferença entre os métodos fácil de localizar.
