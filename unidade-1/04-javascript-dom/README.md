# JavaScript no navegador: DOM, eventos, formulários, JSON e APIs

O HTML organiza o conteúdo, o CSS cuida da apresentação e o JavaScript permite responder ao usuário e modificar a página. Nesta apostila, vamos usar JavaScript no **front-end, executado pelo navegador**.

A apresentação da sintaxe será breve, com foco em conectar o código à página e aos serviços acessados pela Web.

Ao final, você deverá conseguir ler e validar campos, tratar eventos, atualizar o DOM, converter dados em JSON e apresentar respostas de APIs. Não usaremos frameworks, ferramentas de compilação nem recursos avançados da linguagem.

## Índice

1. [JavaScript no front-end](#1-javascript-no-front-end)
2. [Sintaxe básica de JavaScript](#2-sintaxe-básica-de-javascript)
3. [DOM: encontrando e alterando elementos](#3-dom-encontrando-e-alterando-elementos)
4. [Escutando e tratando eventos](#4-escutando-e-tratando-eventos)
5. [Lendo e validando formulários](#5-lendo-e-validando-formulários)
6. [Objetos, texto JSON e conversões](#6-objetos-texto-json-e-conversões)
7. [Chamando APIs](#7-chamando-apis)
8. [Exemplo: JSONPlaceholder](#8-exemplo-jsonplaceholder)
9. [Exemplo: OpenWeatherMap](#9-exemplo-openweathermap)
10. [Atividade integradora resolvida: catálogo de livros](#10-atividade-integradora-resolvida-catálogo-de-livros)
11. [Executando e investigando erros](#11-executando-e-investigando-erros)
12. [Quadro de consulta rápida](#12-quadro-de-consulta-rápida)

## 1. JavaScript no front-end

Em um catálogo, cada tecnologia tem uma responsabilidade:

| Tecnologia | Exemplo de responsabilidade |
|---|---|
| HTML | Criar o formulário e a área onde os livros serão apresentados |
| CSS | Definir cores, espaçamento e organização dos livros |
| JavaScript | Ler a busca, consultar uma API e preencher a lista |

O JavaScript também pode executar no servidor, mas esse uso não será estudado aqui. Nos exemplos desta apostila, o navegador executa o JavaScript; no catálogo, o servidor executa um pequeno arquivo PHP.

### Ligando o arquivo à página

Salve os arquivos como UTF-8 no editor. Mantenha `index.html`, `styles.css` e `script.js` na mesma pasta:

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>JavaScript no navegador</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js" defer></script>
</head>
<body>
  <h1>Biblioteca</h1>
  <p id="mensagem">Página carregada.</p>
</body>
</html>
```

`src` indica o arquivo. Nesse script externo, `defer` permite executar o código depois da interpretação do HTML, quando seus elementos já estão disponíveis. Separar os arquivos facilita localizar e manter cada responsabilidade. [MDN — script](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/script).

No `script.js`, experimente:

```javascript
console.log("JavaScript carregado");
document.querySelector("#mensagem").textContent = "Agora a página foi alterada pelo JavaScript.";
```

Abra o console com `F12` e recarregue. Uma mensagem aparece no console; a outra, na própria página. São lugares diferentes.

## 2. Sintaxe básica de JavaScript

Esta seção reúne as principais estruturas e alguns detalhes da sintaxe de JavaScript. Os trechos abaixo são independentes.

### Variáveis, valores e operações

```javascript
const nome = "Ana";          // texto: string
let quantidade = 2;          // número: number
const disponivel = true;     // booleano: boolean
const observacao = null;     // ausência intencional de valor
let resultado;              // ainda não recebeu um valor: undefined

quantidade = quantidade + 1;
const total = quantidade * 15;
const mensagem = `${nome} selecionou ${quantidade} livros.`;
console.log(mensagem, total);
```

- Use `const` quando não for reatribuir a variável e `let` quando precisar reatribuir.
- JavaScript diferencia maiúsculas e minúsculas: `nome` e `Nome` são diferentes.
- `//` comenta uma linha; `/* ... */` delimita um comentário de várias linhas.
- As crases permitem inserir valores no texto com `${...}`.
- `const` e `let` pertencem ao bloco `{ ... }` onde foram declarados; nos exemplos novos, não precisamos usar `var`.

### Comparações e conversões

```javascript
console.log(5 === "5");        // false: os tipos são diferentes
console.log(5 !== "5");        // true
console.log(Number("5") + 2);  // 7
console.log("5" + 2);          // "52": concatenação de texto
console.log(String(25));       // "25"
```

Prefira `===` e `!==`: eles comparam sem converter automaticamente os tipos. Use `>`, `<`, `>=` e `<=` para comparações; `&&` significa **e**, `||` significa **ou** e `!` significa **não**. Não confunda `=` (atribuição) com `===` (comparação).

`Number("abc")` produz `NaN`, um resultado numérico inválido. `Number.isFinite(valor)` verifica se há um número finito e `Number.isInteger(valor)` verifica se é inteiro. Valide também o campo vazio: `Number("")` resulta em `0`.

### Condições e repetições

```javascript
const quantidade = 3;

if (quantidade === 0) {
  console.log("Nenhum resultado");
} else if (quantidade === 1) {
  console.log("Um resultado");
} else {
  console.log("Vários resultados");
}

for (let indice = 0; indice < 3; indice++) {
  console.log(indice); // 0, 1, 2
}

let tentativas = 0;
while (tentativas < 2) {
  tentativas++;
}
```

`++` acrescenta uma unidade. O laço `for...of`, mostrado a seguir, será nossa principal forma de percorrer listas.

### Arrays, objetos e funções

```javascript
const livros = [
  { titulo: "HTML e CSS", ano: 2023 },
  { titulo: "JavaScript no navegador", ano: 2024 }
];

console.log(livros[0].titulo); // índices começam em zero
console.log(livros.length);   // 2
livros.push({ titulo: "PHP para a Web", ano: 2025 });

for (const livro of livros) {
  console.log(`${livro.titulo} — ${livro.ano}`);
}

function calcularTotal(preco, quantidade) {
  return preco * quantidade;
}

console.log(calcularTotal(15, 2)); // 30
```

Um array reúne itens; um objeto reúne propriedades de um item. `livros[0]` acessa o primeiro objeto e `.titulo` acessa sua propriedade. Também existe o acesso por colchetes, como `livro["titulo"]`, útil quando o nome da propriedade vem de uma variável.

`const` impede trocar a referência da variável por outra, mas não congela o array nem o objeto: `push()` e alterações de propriedades continuam permitidos.

Nas funções, usamos `function`, nome, parâmetros entre parênteses e corpo entre chaves. `return` devolve um resultado ou encerra a função. Vamos preferir funções com nome para facilitar a leitura dos exemplos.

### Experimente: monte seu lanche

O [simulador de pedido](exemplos/04-monte-seu-lanche/) reúne conversões com `Number()`, cálculos, `const`, `let`, condições e funções. Escolha o sanduíche, a quantidade e uma bebida opcional; o JavaScript calcula o subtotal e aplica uma promoção fictícia.

No [script.js](exemplos/04-monte-seu-lanche/script.js), localize `calcularPedido()` e altere a quantidade mínima para receber desconto. Você verá os efeitos da condição no resultado apresentado pela página.

## 3. DOM: encontrando e alterando elementos

**DOM** significa *Document Object Model*: a representação da página como objetos que o JavaScript pode acessar. `document` é nossa entrada para localizar os elementos.

### Seletores que você já conhece do CSS

```javascript
const mensagem = document.querySelector("#mensagem");
const primeiroAviso = document.querySelector(".aviso");
const formulario = document.querySelector("form");
const avisos = document.querySelectorAll(".aviso");
```

`querySelector()` devolve o primeiro elemento encontrado, ou `null` quando não encontra. `querySelectorAll()` devolve uma coleção de correspondências, que podemos percorrer com `for...of`.

Você também encontrará `document.getElementById("mensagem")`: nesse caso, o nome do `id` é informado **sem `#`**. [MDN — querySelector](https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector).

### Texto, campo, aparência e atributos

Supondo que os elementos abaixo existam no HTML:

```javascript
const mensagem = document.querySelector("#mensagem");
const campo = document.querySelector("#busca");
const botao = document.querySelector("#buscar");

mensagem.textContent = "Digite um título.";
campo.value = "JavaScript";
mensagem.classList.add("erro");
mensagem.classList.remove("erro");
botao.disabled = true;
botao.disabled = false;
campo.setAttribute("placeholder", "Parte do título");
```

`.value` lê ou altera o valor de um campo. `.textContent` lê ou altera o texto de um elemento. `classList` modifica as classes; a aparência dessas classes continua no CSS. `classList.toggle("destaque")` alterna entre adicionar e remover a classe.

### Criando e removendo elementos

Com `<ul id="livros"></ul>` no HTML:

```javascript
const lista = document.querySelector("#livros");
const titulos = ["HTML e CSS", "JavaScript no navegador"];

lista.textContent = ""; // remove o conteúdo anterior

for (const titulo of titulos) {
  const item = document.createElement("li");
  item.textContent = titulo;
  lista.append(item);
}
```

`createElement()` cria um elemento; `append()` o insere. Para remover um elemento específico já localizado, use `elemento.remove()`.

Nos exemplos, dados de formulários e APIs entram na página por `textContent`, não por `innerHTML`. Assim, um texto que contenha `<script>` é tratado como texto, não como marcação a interpretar. Isso evita uma fonte comum de injeção de HTML. [MDN — innerHTML](https://developer.mozilla.org/en-US/docs/Web/API/Element/innerHTML).

### Experimente: lista de missões

Na [lista de missões](exemplos/05-lista-de-missoes/), adicione tarefas, marque as concluídas e remova itens. O [código](exemplos/05-lista-de-missoes/script.js) cria os elementos com `createElement()`, muda classes com `classList` e retira elementos com `remove()`.

Cada botão está diretamente dentro de um `li`; `parentElement` localiza esse elemento pai. A função `atualizarProgresso()` percorre os itens atuais com `querySelectorAll()` e `for...of`. Observe como o contador se ajusta ao concluir, reabrir ou remover uma missão, inclusive quando a lista fica vazia.

## 4. Escutando e tratando eventos

Um evento informa que algo aconteceu na página. O código registra uma função para tratar essa ocorrência.

```html
<button id="botao" type="button">Mostrar mensagem</button>
<p id="mensagem"></p>
```

```javascript
const botao = document.querySelector("#botao");
const mensagem = document.querySelector("#mensagem");

function mostrarMensagem() {
  mensagem.textContent = "Você clicou no botão.";
}

botao.addEventListener("click", mostrarMensagem);
```

`addEventListener` registra o evento e a função tratadora. Escrevemos `mostrarMensagem` **sem `()`**, porque estamos indicando qual função executar quando houver um clique. `mostrarMensagem()` a executaria imediatamente. [MDN — addEventListener](https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener).

| Evento | Uso frequente |
|---|---|
| `click` | Acionar um botão |
| `input` | Reagir enquanto o usuário edita um campo |
| `change` | Reagir à escolha de uma opção de `select` |
| `submit` | Tratar o envio de um formulário, inclusive pelo teclado |

O navegador pode entregar à função um objeto com informações sobre o evento:

```javascript
function informarEscolha(evento) {
  console.log(evento.target.value);
}

document.querySelector("#cidade").addEventListener("change", informarEscolha);
```

`evento.target` identifica o elemento onde o evento se originou. Nesse exemplo, é o `select` de cidades.

Para formulários, ouviremos `submit` no próprio `form`, não somente `click` no botão. `evento.preventDefault()` cancela a ação padrão de enviar o formulário e navegar para sua resposta; nossa função passa a cuidar do que acontecerá. Ele não valida campos nem envia dados por conta própria.

### Experimente: adivinhe o número

No [jogo de adivinhação](exemplos/06-jogo-adivinhacao/), cada `submit` verifica um palpite e cada `click` em **Novo jogo** reinicia a partida. O [script](exemplos/06-jogo-adivinhacao/script.js) guarda o número secreto, a quantidade de tentativas e a situação da partida em variáveis.

Tente jogar também com Enter. Depois localize as condições que produzem as dicas de maior ou menor, a vitória e o fim das tentativas. O README mostra como fixar temporariamente o número secreto para testar cada caminho.

## 5. Lendo e validando formulários

Use primeiro a validação do HTML e complemente com JavaScript quando houver uma regra específica:

```html
<form id="cadastro">
  <label for="nome">Nome</label>
  <input id="nome" name="nome" type="text" minlength="3" required>

  <label for="email">E-mail</label>
  <input id="email" name="email" type="email" required>

  <label for="quantidade">Quantidade de livros</label>
  <input id="quantidade" name="quantidade" type="number" min="1" max="5" step="1" required>

  <button type="submit">Conferir dados</button>
</form>
<p id="mensagem" role="status"></p>
```

```javascript
const formulario = document.querySelector("#cadastro");
const mensagem = document.querySelector("#mensagem");

function validarCadastro(evento) {
  evento.preventDefault();
  const nome = document.querySelector("#nome").value.trim();
  const email = document.querySelector("#email").value.trim();
  const quantidade = Number(document.querySelector("#quantidade").value);
  mensagem.classList.remove("erro");

  if (nome.length < 3 || !Number.isInteger(quantidade) || quantidade < 1 || quantidade > 5) {
    mensagem.textContent = "Informe um nome com pelo menos 3 caracteres e uma quantidade inteira de 1 a 5.";
    mensagem.classList.add("erro");
    return;
  }

  mensagem.textContent = `Dados conferidos: ${nome}, ${email}, ${quantidade} livros. Nenhum cadastro foi enviado.`;
}

formulario.addEventListener("submit", validarCadastro);
```

Observe os detalhes:

- `required`, `type`, `min`, `max`, `step` e `minlength` ajudam o navegador a validar.
- Na submissão normal pelo usuário, um campo inválido pode ser bloqueado pelo HTML **antes** de o evento `submit` chegar à função.
- Campos de texto, número e `select` fornecem uma **string** em `.value`. Faça a conversão quando precisar calcular.
- Para saber se um checkbox está marcado, use `.checked`, que fornece `true` ou `false`.
- `trim()` remove espaços das pontas; assim, três espaços não passam pela regra do nome.
- `return` encerra o tratamento quando a validação falha.
- `role="status"` ajuda tecnologias assistivas a anunciar mudanças na mensagem.

**Validar não é salvar.** Esse exemplo só confere valores e mostra uma mensagem. Também não é suficiente para proteger uma aplicação: o usuário pode alterar ou contornar o JavaScript. Quando houver envio a um servidor, o PHP deverá validar novamente. [MDN — validação de formulários](https://developer.mozilla.org/en-US/docs/Learn_web_development/Extensions/Forms/Form_validation).

### Experimente: valide as opções do pedido

Volte ao [exemplo da lanchonete](exemplos/04-monte-seu-lanche/). Seu formulário usa `select`, `input` numérico e checkbox. Compare a leitura de `.value` com `.checked` e tente quantidades vazias, fracionadas ou fora de 1 a 10.

O HTML fornece a primeira validação e o JavaScript também verifica os valores antes de calcular. Ao alterar uma opção, o resumo anterior é ocultado até fazer um novo cálculo, evitando apresentar um total que já não corresponde aos campos.

## 6. Objetos, texto JSON e conversões

JSON é um formato de **texto** para representar dados. É comum uma API enviar JSON e o JavaScript convertê-lo em dados que podem ser acessados no programa. Não é exclusivo de JavaScript: PHP e outras linguagens também trabalham com ele.

### Serializar: objeto para texto JSON

```javascript
const livro = { titulo: "JavaScript", ano: 2024, disponivel: true };
const textoJSON = JSON.stringify(livro);

console.log(textoJSON);
// {"titulo":"JavaScript","ano":2024,"disponivel":true}
console.log(typeof textoJSON); // "string"
```

### Desserializar: texto JSON para dados JavaScript

```javascript
const textoJSON = '{"titulo":"JavaScript","ano":2024}';
const livro = JSON.parse(textoJSON);

console.log(livro.titulo); // JavaScript
console.log(livro.ano);   // 2024
```

JSON pode representar objetos, arrays e valores simples. Nas APIs desta apostila, usaremos objetos e arrays de objetos. Os nomes das propriedades e os textos usam aspas duplas; comentários e vírgula depois do último item não são permitidos. `JSON.parse()` gera um erro quando recebe um texto inválido. [MDN — trabalhando com JSON](https://developer.mozilla.org/en-US/docs/Learn_web_development/Core/Scripting/JSON).

| Operação | Entrada | Resultado |
|---|---|---|
| `JSON.stringify(dados)` | Dados JavaScript | Texto JSON |
| `JSON.parse(texto)` | Texto JSON válido | Dados JavaScript |
| `resposta.json()` | Corpo de uma resposta HTTP | Leitura e conversão do JSON para a etapa seguinte do processamento |

`resposta.json()` já realiza a conversão: não aplique `JSON.parse()` outra vez sobre o objeto recebido. E serializar não envia nem armazena dados automaticamente.

### Experimente: ficha de personagem em JSON

Na [ficha de personagem](exemplos/07-ficha-personagem-json/), preencha nome, classe e nível. O botão de geração cria um objeto e o transforma em texto com `JSON.stringify()`. Edite esse texto e use **Importar JSON** para recuperar os valores com `JSON.parse()`.

O [código](exemplos/07-ficha-personagem-json/script.js) distingue dois problemas: uma aspa ausente torna o JSON inválido; já o nível `99` é um número válido em JSON, mas não atende à regra da ficha. Um pequeno `try/catch` mostra uma mensagem quando a leitura do texto falha, sem interromper o uso da página. Corrija o texto e tente novamente.

## 7. Chamando APIs

Uma API oferece uma interface para outro programa solicitar operações ou informações. Na Web, normalmente acessamos um **endpoint**, isto é, um endereço que recebe uma requisição HTTP.

| Elemento | Exemplo |
|---|---|
| Endpoint | `https://jsonplaceholder.typicode.com/posts` |
| Método | `GET` para consultar; `POST` para enviar dados nesta demonstração |
| Parâmetro na URL | `?userId=1` |
| Resposta | Código HTTP e corpo com os dados, geralmente em JSON |

Se necessário, reveja a [apostila de HTTP](../02-http/).

### Um padrão mínimo de consulta

Para que o primeiro contato continue concentrado no front-end, vamos reutilizar este pequeno padrão. Os exemplos usam `fetch`, `.then` e `.catch` sem desenvolver a teoria de Promises, callbacks ou assincronicidade. Esses mecanismos existem por trás da consulta; não estamos fazendo uma chamada síncrona nem bloqueando o navegador.

Com `<p id="mensagem"></p>` no HTML:

```javascript
const mensagem = document.querySelector("#mensagem");
mensagem.textContent = "Carregando...";

fetch("https://jsonplaceholder.typicode.com/posts/1")
  .then(lerResposta)
  .then(mostrarPublicacao)
  .catch(mostrarErro);

function lerResposta(resposta) {
  if (!resposta.ok) {
    throw new Error(`Falha HTTP ${resposta.status}.`);
  }
  return resposta.json();
}

function mostrarPublicacao(publicacao) {
  mensagem.textContent = publicacao.title;
}

function mostrarErro(erro) {
  mensagem.textContent = "Não foi possível consultar a publicação.";
  console.error(erro.message);
}
```

Leia assim: iniciar o pedido; quando houver resposta, verificá-la e ler o JSON; quando os dados estiverem disponíveis, apresentá-los; se houver falha no caminho, mostrar o erro. Não tente usar o resultado em uma linha solta logo depois de `fetch`: ele ainda pode não ter chegado.

`resposta.ok` indica status de 200 a 299. Respostas como 404 e 500 precisam ser verificadas explicitamente: não são tratadas automaticamente como falha de rede. Nesse padrão, `throw new Error(...)` encaminha a falha para o tratamento final. [MDN — usando Fetch](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch).

Ao adaptar o padrão, altere principalmente a URL, os campos apresentados e a função que monta a interface. Não precisamos usar `async/await`, criar Promises manualmente ou estudar os mecanismos internos neste momento.

### Interface durante a consulta

Uma consulta deve comunicar quatro situações: **carregando**, **sucesso**, **nenhum resultado** e **erro**. Nos exemplos, o botão de envio fica desabilitado durante seu pedido, evitando repetir a mesma operação enquanto ela está em andamento; volta a funcionar tanto no sucesso quanto na falha.

Para inserir texto digitado na URL, usamos `encodeURIComponent()`:

```javascript
const busca = "HTML e CSS";
const url = `api/livros.php?busca=${encodeURIComponent(busca)}`;
```

Isso representa corretamente espaços e caracteres especiais no parâmetro. Não é criptografia nem substitui a validação.

## 8. Exemplo: JSONPlaceholder

[Abra a pasta do exemplo](exemplos/01-jsonplaceholder/) · [HTML](exemplos/01-jsonplaceholder/index.html) · [JavaScript](exemplos/01-jsonplaceholder/script.js)

O exemplo tem duas partes:

1. Consultar publicações de um usuário e criar uma lista no DOM com `for...of`.
2. Validar título e texto, serializar um objeto e enviá-lo com `POST`.

No envio, observe este trecho do arquivo:

```javascript
const publicacao = { title: titulo, body: texto, userId: 1 };
const textoJSON = JSON.stringify(publicacao);

fetch("https://jsonplaceholder.typicode.com/posts", {
  method: "POST",
  headers: { "Content-Type": "application/json" },
  body: textoJSON
})
  .then(lerResposta)
  .then(mostrarEnvio)
  .catch(mostrarErroEnvio);
```

`method` escolhe a operação; `headers` informa o formato; `body` contém o texto enviado. Os nomes `title`, `body` e `userId` pertencem ao contrato da API, por isso não são traduzidos no objeto enviado.

O JSONPlaceholder não exige chave para esse exemplo. Seus cadastros são **simulados**: a resposta não significa que o registro ficou salvo. O item enviado não aparecerá na consulta posterior. Use dados fictícios. [Guia do JSONPlaceholder](https://jsonplaceholder.typicode.com/guide/).

Para estudar: consulte o usuário `1`, depois `999`; envie textos válidos e tente textos compostos só por espaços. Compare o JSON enviado com o objeto devolvido, exibido novamente como texto na página.

## 9. Exemplo: OpenWeatherMap

[Abra a pasta do exemplo](exemplos/02-openweathermap/) · [HTML](exemplos/02-openweathermap/index.html) · [JavaScript](exemplos/02-openweathermap/script.js)

O usuário escolhe Recife, São Paulo ou Curitiba e informa sua chave de teste. A página usa coordenadas aproximadas já cadastradas, evitando uma segunda consulta para transformar nome de cidade em localização.

O endereço usa a API **Current Weather Data**:

```text
https://api.openweathermap.org/data/2.5/weather?lat=LATITUDE&lon=LONGITUDE&units=metric&lang=pt_br&appid=SUA_CHAVE
```

`lat` e `lon` identificam a localização; `appid` é a chave; `units=metric` solicita temperatura em Celsius e `lang=pt_br` solicita descrições em português. Não confunda esse endpoint com o produto One Call. [OpenWeatherMap — Current Weather Data](https://old.openweathermap.org/current).

Depois da conversão do JSON, o exemplo lê propriedades de objetos e de um array:

```javascript
document.querySelector("#local").textContent = dados.name;
document.querySelector("#temperatura").textContent = `${dados.main.temp} °C`;
document.querySelector("#descricao").textContent = dados.weather[0].description;
```

Você precisa de uma conta e de uma chave habilitada para esse endpoint; confira as condições da sua conta. Não há chave incluída no repositório. O campo de senha apenas oculta os caracteres na tela: código e requisições do navegador podem ser inspecionados. A página não grava a chave em armazenamento local.

**Uso didático:** não publique chaves no Git. Em uma aplicação que precise proteger a chave, a consulta deve passar por um servidor sob seu controle. O exemplo informa falhas de acesso e limite de consultas; sua configuração está no [guia de execução](exemplos/02-openweathermap/README.md).

## 10. Atividade integradora resolvida: catálogo de livros

[Abra a solução completa](exemplos/03-catalogo-integrador/) · [HTML](exemplos/03-catalogo-integrador/index.html) · [JavaScript](exemplos/03-catalogo-integrador/script.js) · [API PHP](exemplos/03-catalogo-integrador/api/livros.php)

Esta é a implementação da atividade proposta na discussão de planejamento: uma busca que integra os assuntos da apostila. O PHP é fornecido como apoio; o foco desta etapa é compreender o JavaScript que o consulta.

| Etapa | Onde observar |
|---|---|
| Capturar o formulário | Evento `submit` chama `buscarLivros` |
| Impedir a navegação padrão | `evento.preventDefault()` |
| Ler e validar a busca | `.value.trim()` e condição de tamanho |
| Consultar o servidor | `fetch` para `api/livros.php?busca=...` |
| Receber dados | `lerResposta` verifica HTTP e lê o JSON |
| Percorrer e apresentar | `mostrarLivros` usa `for...of`, `createElement` e `textContent` |
| Orientar o usuário | Mensagens de carregamento, resultado, lista vazia e erro |

A API pesquisa título e autor em seis livros fictícios definidos em um array. Ela valida o parâmetro novamente e devolve um array JSON; quando não encontra livros, devolve `[]`. Não há banco, sessão nem persistência. O cadastro com POST era opcional na proposta: aqui a solução cobre a busca completa; o envio de JSON já foi demonstrado no JSONPlaceholder.

Além disso, o campo mostra a contagem de caracteres pelo evento `input`. A última busca é serializada em memória com `JSON.stringify()`. Um botão com evento `click` usa `JSON.parse()` para restaurar o campo, sem disparar outra consulta. Alterar `.value` pelo código não dispara `input` automaticamente; por isso a função de restauração também atualiza o contador.

### Experimente e confira

1. Busque `JavaScript`: devem aparecer dois livros.
2. Busque `Ana`: devem aparecer os dois livros dessa autora.
3. Busque `abacaxi`: a lista fica vazia e aparece uma orientação.
4. Tente enviar só espaços: a validação JavaScript deve impedir a consulta.
5. Altere o campo e restaure a última busca: observe o JSON e o valor recuperado.
6. Nas ferramentas do navegador, simule uma rede lenta e depois uma falha de rede; observe as mensagens e a liberação do botão.

As instruções detalhadas estão no [README do exemplo](exemplos/03-catalogo-integrador/README.md).

## 11. Executando e investigando erros

Os exemplos não exigem npm nem framework. Os exemplos **04 a 07** funcionam sem servidor e sem internet: abra o `index.html` da respectiva pasta diretamente no navegador. Consulte o [índice dos sete exemplos](exemplos/README.md) para escolher pelo assunto.

Para servir todos pelo mesmo endereço local, incluindo a API PHP do catálogo, tenha o PHP CLI instalado e abra o terminal na pasta `unidade-1/04-javascript-dom/exemplos`:

```bat
php -S localhost:8000
```

Mantenha o terminal aberto e acesse:

- [JSONPlaceholder](http://localhost:8000/01-jsonplaceholder/)
- [OpenWeatherMap](http://localhost:8000/02-openweathermap/)
- [Catálogo integrador](http://localhost:8000/03-catalogo-integrador/)
- [Monte seu lanche](http://localhost:8000/04-monte-seu-lanche/)
- [Lista de missões](http://localhost:8000/05-lista-de-missoes/)
- [Jogo de adivinhação](http://localhost:8000/06-jogo-adivinhacao/)
- [Ficha de personagem em JSON](http://localhost:8000/07-ficha-personagem-json/)

Pare o servidor com `Ctrl+C`. O servidor embutido é para estudo local, não para publicar uma aplicação em produção. Se precisar preparar o PHP, consulte o [guia de ambiente da disciplina](../../apoio/ambiente-web1-windows/).

Os exemplos externos também podem ser servidos por um servidor estático local. **O catálogo precisa de PHP:** abrir o arquivo com `file:///` ou usar apenas um servidor estático não executa a API. Os links do GitHub mostram o código; para usar as páginas, baixe ou atualize o repositório e abra os endereços locais.

### Console e Rede

Abra `F12`. No **Console**, veja mensagens de erro e valores de teste com `console.log()`. Na aba **Rede / Network**, observe URL, método, status e resposta das consultas. No POST, confira também a carga enviada (*Payload*).

| Problema | O que conferir |
|---|---|
| O script não executa | Caminho em `src`, `defer` e primeiro erro do console |
| Erro envolvendo `null` | O seletor corresponde a um elemento existente? |
| A soma virou texto | Houve conversão com `Number()`? |
| O formulário não chega à função | Alguma validação nativa do HTML o bloqueou? |
| JSON inválido ou resposta começando com `<` | A URL devolveu HTML ou um erro PHP em vez de JSON? |
| Falha HTTP | Status e corpo da resposta na aba Rede |
| API local não funciona | PHP iniciado, caminho correto e acesso por `http://localhost` |
| A API externa falha | Conexão, permissão do serviço e, no clima, chave e limite de uso |

Uma API em outro domínio precisa permitir a leitura pelo navegador, por meio de CORS. Não tente resolver esse bloqueio com `mode: "no-cors"`: nesse modo o JavaScript não consegue ler o corpo da resposta. [MDN — requisições entre origens](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch#making_cross-origin_requests).

## 12. Quadro de consulta rápida

| Recurso | Para que usamos |
|---|---|
| `const` / `let` | Declarar variáveis sem ou com reatribuição |
| `===` | Comparar valor e tipo sem conversão automática |
| `Number()` | Converter um texto em número |
| `for...of` | Percorrer itens de uma lista |
| `querySelector()` | Localizar um elemento usando seletor CSS |
| `.value` / `.checked` | Ler o valor de um campo / se está marcado |
| `.textContent` | Ler ou escrever texto em um elemento |
| `.classList` | Adicionar, remover ou alternar classes CSS |
| `createElement()` / `append()` | Criar e inserir elementos |
| `addEventListener()` | Registrar o tratamento de um evento |
| `preventDefault()` | Cancelar a ação padrão do evento |
| `JSON.stringify()` | Serializar dados em texto JSON |
| `JSON.parse()` | Desserializar texto JSON |
| `fetch()` | Iniciar uma requisição HTTP |
| `resposta.ok` | Verificar se o status HTTP indica sucesso |
| `resposta.json()` | Ler e converter o JSON da resposta |

O objetivo é reconhecer o caminho **interação do usuário → leitura e validação → operação → atualização da página**, conseguindo identificar onde cada parte está implementada. Use os exemplos para mudar uma regra, um campo e uma forma de apresentação antes de criar sua própria versão.

## Referências

- [MDN — fundamentos de JavaScript](https://developer.mozilla.org/en-US/curriculum/core/javascript-fundamentals/)
- [MDN — manipulação de documentos](https://developer.mozilla.org/en-US/docs/Learn_web_development/Core/Scripting/DOM_scripting)
- [MDN — eventos](https://developer.mozilla.org/en-US/docs/Learn_web_development/Core/Scripting/Events)
- [MDN — JSON](https://developer.mozilla.org/en-US/docs/Learn_web_development/Core/Scripting/JSON)
- [MDN — Fetch](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch)
- [JSONPlaceholder — guia](https://jsonplaceholder.typicode.com/guide/)
- [OpenWeatherMap — Current Weather Data](https://old.openweathermap.org/current)
- [PHP — json_encode](https://www.php.net/manual/pt_BR/function.json-encode.php)

Material anterior: [HTML e CSS](../03-html-css/).
