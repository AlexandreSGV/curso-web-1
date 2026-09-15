# 01 — Comandos básicos e consulta a API

Siga as [instruções de execução](../) e abra [a demonstração](http://localhost:8000/01-comandos-basicos/index.php).

- [index.php](index.php): variáveis, constante, `echo`, `<?= ?>`, função, condição, `for`, arrays, `foreach` e tabela HTML.
- [consulta-api.php](consulta-api.php): consulta uma publicação do JSONPlaceholder com cURL e converte a resposta usando `json_decode(..., true)`.

O `index.php` inclui a consulta com `require`. A consulta prepara `$publicacao` ou `$erroApi`; a página decide o que apresentar. A resposta da API é tratada como texto ao ser inserida no HTML com `htmlspecialchars()`.

Observe o total inicial de **R$ 37,50**, a tabela com três campos e a lista com três cores. Depois altere `$quantidade`, `$disponivel` e os arrays; recarregue para comparar os resultados.

A última seção depende de internet e cURL, como explicado no [índice](../). A consulta espera até cinco segundos. Se ela falhar, apresenta uma mensagem e as demonstrações locais continuam disponíveis. A falha dessa consulta não transforma toda a página de demonstrações em uma resposta de erro HTTP.

Para estudar a chamada, troque `/posts/1` por `/posts/2`. O resultado é fictício e vem de um serviço de demonstração.
