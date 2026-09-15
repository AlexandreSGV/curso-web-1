# 04 — Resposta JSON e status HTTP

Siga as [instruções de execução](../). O [index.php](index.php) é um pequeno endereço de API: recebe dois números por GET e devolve JSON.

| Consulta | Status | Corpo esperado |
|---|---|---|
| [Soma de 10 e 5](http://localhost:8000/04-resposta-json/index.php?a=10&b=5) | `200` | `{"resultado":15}` |
| [Valor não numérico](http://localhost:8000/04-resposta-json/index.php?a=abc&b=5) | `400` | Objeto com o campo `erro` |
| [Valor ausente](http://localhost:8000/04-resposta-json/index.php?a=10) | `400` | Objeto com o campo `erro` |

O cabeçalho `Content-Type: application/json` informa o formato. `json_encode()` prepara o texto JSON; `http_response_code()` define o status. A resposta não inclui HTML.

Uma requisição com método diferente de GET recebe `405`, o cabeçalho `Allow: GET` e um objeto JSON de erro. Resultados fora do limite numérico também recebem erro, em vez de tentar serializar um valor infinito.

Confira o código de status na aba **Rede/Network**. O navegador pode formatar o JSON para facilitar a leitura; o corpo continua sendo texto JSON.
