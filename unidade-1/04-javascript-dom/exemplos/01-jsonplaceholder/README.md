# JSONPlaceholder: consultar e enviar JSON

Exemplo de `submit`, validação, `fetch`, `for...of`, criação de elementos e `JSON.stringify()`. Nenhuma chave de API é necessária.

## Executar

Na pasta `unidade-1/04-javascript-dom/exemplos`, com PHP CLI instalado:

```bat
php -S localhost:8000
```

Abra [http://localhost:8000/01-jsonplaceholder/](http://localhost:8000/01-jsonplaceholder/). O PHP apenas serve os arquivos deste exemplo; também é possível usar um servidor estático local. É necessário acesso à internet.

## Arquivos

- [index.html](index.html): formulários e áreas de resultado.
- [styles.css](styles.css): apresentação.
- [script.js](script.js): eventos, validação, consultas e atualização do DOM.

## O que testar

1. Consulte o usuário `1`: a API de demonstração fornece suas publicações.
2. Consulte `999`: a lista deve ficar vazia, com uma mensagem explicativa.
3. Tente um número menor que `1`: a validação HTML impede a submissão.
4. No segundo formulário, informe um título de 3 a 100 caracteres e um texto de 10 a 500 caracteres.
5. Compare o texto JSON enviado com os dados devolvidos pela API.
6. Tente preencher os campos só com espaços: o JavaScript aplica `trim()` e rejeita os valores.
7. Em `F12`, aba Rede/Network, observe o GET, o POST e sua carga enviada (Payload). Simule falha de rede e confira a mensagem e a liberação dos botões.

O JSONPlaceholder **simula** o cadastro. A resposta pode conter um novo ID, mas o registro não é persistido nem passa a aparecer no GET. Envie apenas dados fictícios. [Guia oficial](https://jsonplaceholder.typicode.com/guide/).

O bloco `fetch(...).then(...).then(...).catch(...)` é reutilizado como padrão de consulta; cada função tem nome e uma tarefa curta. A teoria dos mecanismos de espera fica fora desta introdução.

[Voltar à apostila](../../README.md)
