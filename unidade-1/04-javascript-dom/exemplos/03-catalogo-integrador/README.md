# Atividade integradora resolvida: catálogo de livros

A solução reúne formulário de busca, validação, eventos `submit`, `input` e `click`, consulta HTTP, JSON e criação de elementos no DOM.

## Executar

Tenha o PHP CLI instalado. Na pasta `unidade-1/04-javascript-dom/exemplos`, execute:

```bat
php -S localhost:8000
```

Abra [http://localhost:8000/03-catalogo-integrador/](http://localhost:8000/03-catalogo-integrador/). Mantenha o terminal aberto; `Ctrl+C` encerra o servidor. A execução é local e não depende das APIs externas.

**Não abra com `file:///`.** Um servidor estático, como o Live Server usado sozinho, também não executa PHP. Se precisar, consulte o [guia de ambiente](../../../../apoio/ambiente-web1-windows/).

## Arquivos e responsabilidades

| Arquivo | Responsabilidade |
|---|---|
| [index.html](index.html) | Formulário, lista e áreas de mensagem |
| [styles.css](styles.css) | Apresentação |
| [script.js](script.js) | Eventos, leitura, validação, requisição e DOM |
| [api/livros.php](api/livros.php) | Validar a consulta, pesquisar em um array e responder JSON |

O PHP é um apoio pronto para esta etapa: não é necessário estudar todos os seus comandos para acompanhar o JavaScript. Ele usa dados fictícios, sem banco, sessão ou gravação de registros. O POST opcional da proposta não faz parte deste catálogo; o exemplo JSONPlaceholder já demonstra o envio de JSON.

## Testes de estudo

| Ação | Resultado esperado |
|---|---|
| Buscar `JavaScript` | Dois livros |
| Buscar `Ana` | Dois livros |
| Buscar `PHP` | Um livro |
| Buscar `abacaxi` | Lista vazia com orientação |
| Enviar o campo vazio | Bloqueio pela validação HTML |
| Enviar três espaços | Mensagem da validação JavaScript; nenhuma consulta |
| Editar o campo | Atualização do contador pelo evento `input` |
| Restaurar a última busca | Campo e contador recuperados sem nova consulta |
| Recarregar a página | Busca em memória apagada |

Em `F12`, aba Rede/Network, reduza a velocidade para observar o carregamento. Depois de carregar a página, simule rede offline e envie uma busca para observar a falha. Se seu navegador não aplicar essa simulação ao endereço local, interrompa temporariamente o servidor e busque na página já aberta. Reative a rede ou o servidor e repita: o botão não deve permanecer desabilitado após a falha.

## Observando a API sem o JavaScript

Abra [api/livros.php?busca=JavaScript](api/livros.php?busca=JavaScript) no servidor local. O resultado é um array JSON, não uma página de listagem. A interface é construída pelo JavaScript.

O endpoint aceita apenas `GET`. A busca precisa ser um texto de 2 a 60 caracteres após retirar espaços das pontas. Uma busca inválida recebe HTTP `400`; outro método recebe `405`. A busca válida sem correspondências recebe `200` com `[]`.

O catálogo usa títulos e autores simples, sem normalização de acentos. `stripos` procura um trecho e ignora diferenças entre maiúsculas e minúsculas ASCII. [PHP — stripos](https://www.php.net/manual/pt_BR/function.stripos.php).

## Serializar e desserializar

`ultimaBuscaJSON` guarda o critério como texto, produzido por `JSON.stringify({ busca: busca })`. O botão de restauração usa `JSON.parse()` para recuperar o objeto e sua propriedade `busca`. Isso é independente do JSON recebido da API, que já é convertido por `resposta.json()`.

## Pequenas modificações propostas

1. Exiba também o ID de cada livro.
2. Acrescente um livro ao array PHP e pesquise por ele.
3. Altere a apresentação da lista sem mudar a consulta.

[Voltar à apostila](../../README.md)
