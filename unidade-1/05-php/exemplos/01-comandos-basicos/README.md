# 01 — Comandos básicos e consulta a API

Siga as [instruções de execução](../) e abra [a demonstração](http://localhost:8000/01-comandos-basicos/index.php).

- [index.php](index.php): variáveis, constante, `echo`, `<?= ?>`, função, condição, `for`, arrays, `foreach` e tabela HTML.
- [consulta-api.php](consulta-api.php): busca o JSON com `file_get_contents()` e coloca os dados em `$publicacao` usando `json_decode(..., true)`.

O `index.php` inclui a consulta com `require` e apresenta `$publicacao['title']` e `$publicacao['body']` no HTML.

Observe o total inicial de **37.5**, a tabela com três campos e a lista com três cores. Depois altere `$quantidade`, `$disponivel` e os arrays; recarregue para comparar os resultados.

A consulta precisa de internet e acesso a URLs habilitado no PHP, como explicado no [índice](../).

Para estudar a chamada, troque `/posts/1` por `/posts/2`. O resultado é fictício e vem de um serviço de demonstração.
