# 04 — Resposta JSON e status HTTP

Siga as [instruções de execução](../). Há dois arquivos independentes para observar o corpo JSON e o status da resposta.

| Arquivo e endereço | Status | Corpo esperado |
|---|---|---|
| [Soma de 10 e 5](http://localhost:8000/04-resposta-json/index.php?a=10&b=5) | `200` | `{"resultado":15}` |
| [Demonstração de erro](http://localhost:8000/04-resposta-json/erro.php) | `400` | `{"erro":"Informe dois números."}` |

O cabeçalho `Content-Type: application/json` informa o formato. `json_encode()` prepara o texto JSON; `http_response_code()` define o status. A resposta não inclui HTML.

O [index.php](index.php) lê `a` e `b`, soma e devolve o resultado. O [erro.php](erro.php) sempre responde com `400` e uma mensagem fixa, para demonstrar como preparar uma resposta de erro.

Confira o código de status na aba **Rede/Network**. O navegador pode formatar o JSON para facilitar a leitura; o corpo continua sendo texto JSON.
