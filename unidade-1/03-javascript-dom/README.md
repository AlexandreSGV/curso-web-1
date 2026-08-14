# JavaScript e DOM

Neste kit, você acrescentará interatividade ao formulário do consultório criado
no assunto anterior. O formulário verificará os campos e mostrará uma mensagem
sem recarregar a página.

Ao final, você deverá conseguir:

- carregar um arquivo JavaScript externo;
- localizar elementos do HTML;
- responder ao envio de um formulário;
- ler valores, tomar uma decisão e alterar um texto na página;
- consultar o console para acompanhar o código e localizar erros.

O [exemplo completo](exemplo/index.html) possui `index.html`, `styles.css` e
`script.js`. A aplicação prática está em [atividade.md](atividade.md).

## O que você já conhece

Você já usou variáveis, condições e funções em TypeScript. Neste exemplo, esses
conceitos continuam presentes em JavaScript:

```javascript
const nome = "Ana";

if (nome.length < 3) {
  console.log("Nome muito curto");
}
```

A diferença prática deste kit é o local da execução: o JavaScript será
executado pelo navegador e poderá acessar a página. Não usaremos TypeScript,
tipos escritos no código, npm ou ferramentas de compilação.

Se precisar rever a construção da página, consulte o kit de
[HTML, CSS e Grid](../02-html-css-grid/).

## Documento, elemento e DOM

Quando o navegador lê o HTML, ele representa a página como objetos ligados
entre si. Essa representação é o **DOM**, sigla de *Document Object Model*.

| Termo | Significado neste exemplo |
|---|---|
| Documento | A página inteira, acessada no código por `document`. |
| Elemento | Um objeto que representa uma etiqueta do HTML, como `form` ou `input`. |
| DOM | A representação que permite ao JavaScript localizar e alterar elementos. |
| Evento | Algo que acontece na página, como o envio do formulário. |
| Manipulador | A função executada quando o evento acontece. |

O fluxo usado será sempre este:

```text
localizar elemento → ouvir evento → ler ou alterar informação
```

## 1. Carregue o JavaScript externo

O exemplo mantém cada responsabilidade em um arquivo:

```text
exemplo/
├── index.html
├── styles.css
└── script.js
```

Esta linha fica dentro de `head`, depois do CSS:

```html
<script src="script.js" defer></script>
```

`src` informa o arquivo. `defer` faz o navegador aguardar a leitura do HTML
antes de executar o JavaScript. Assim, os elementos já existem quando o script
tenta localizá-los.

No início de `script.js`, há uma mensagem de conferência:

```javascript
console.log("JavaScript carregado. Formulário localizado:", formulario);
```

### Checkpoint 1 — console

1. Abra [o exemplo](exemplo/index.html) no navegador.
2. Pressione `F12` e selecione **Console**.
3. Recarregue a página.

O console deve mostrar **JavaScript carregado**. Se nada aparecer, confira o
nome escrito em `src`.

## 2. Prepare os elementos no HTML

Os elementos que serão usados pelo JavaScript possuem identificadores:

```html
<form id="formulario-atendimento">
  <label for="nome">Nome completo</label>
  <input type="text" id="nome" name="nome">

  <button type="submit">Solicitar horário</button>
</form>

<p id="mensagem-formulario" aria-live="polite">
  Preencha os três campos para testar.
</p>
```

O atributo `aria-live="polite"` ajuda tecnologias assistivas a anunciar quando
o texto da mensagem muda.

## 3. Localize poucos elementos

`document.querySelector` recebe um seletor CSS e devolve o primeiro elemento
correspondente:

```javascript
const formulario = document.querySelector("#formulario-atendimento");
const campoNome = document.querySelector("#nome");
const campoEspecialidade = document.querySelector("#especialidade");
const campoData = document.querySelector("#data");
const mensagem = document.querySelector("#mensagem-formulario");
```

O sinal `#` indica que a busca usa um `id`. Cada constante passa a guardar uma
referência ao elemento encontrado.

### Checkpoint 2 — elemento localizado

No console, a mensagem inicial deve apresentar o elemento `form`. Se aparecer
`null`, o seletor não encontrou nada. Compare o texto de `querySelector` com o
`id` no HTML.

## 4. Ouça o envio do formulário

Um formulário produz o evento `submit` quando o usuário tenta enviá-lo:

```javascript
formulario.addEventListener("submit", function (evento) {
  evento.preventDefault();

  console.log("O formulário foi enviado");
});
```

`addEventListener` registra a função que será executada. Essa função é o
**manipulador do evento**.

Normalmente, o envio faz o navegador abrir o endereço indicado pelo formulário.
Neste exemplo ainda não existe servidor para receber os dados. Por isso,
`evento.preventDefault()` impede somente esse comportamento padrão e mantém a
página aberta para vermos a mensagem.

## 5. Leia os valores

Dentro do manipulador, a propriedade `.value` devolve o conteúdo atual do
campo:

```javascript
const nomeInformado = campoNome.value.trim();
const especialidadeInformada = campoEspecialidade.value;
const dataInformada = campoData.value;
```

`trim()` retira espaços do começo e do final do nome. Isso evita aceitar um
campo preenchido apenas com espaços.

## 6. Valide e atualize a página

A condição verifica os três valores:

```javascript
if (nomeInformado.length < 3 || especialidadeInformada === "" || dataInformada === "") {
  mensagem.textContent = "Informe um nome com pelo menos 3 letras, a especialidade e a data.";
  return;
}
```

- `.length` informa a quantidade de caracteres;
- `=== ""` verifica se o valor está vazio;
- `||` significa **ou**;
- `return` encerra o manipulador quando há erro;
- `.textContent` troca o texto do elemento.

Se os dados passarem pela condição, a mensagem de sucesso é criada:

```javascript
mensagem.textContent = `Solicitação registrada para ${nomeInformado}: ${especialidadeInformada} em ${dataInformada}.`;
```

O texto entre crases permite inserir valores com `${...}`, recurso que também
existe em TypeScript.

### Checkpoint 3 — caminho de erro

1. Deixe os campos vazios.
2. Clique em **Solicitar horário**.

A página não deve recarregar. A mensagem deve pedir o preenchimento correto.

### Checkpoint 4 — caminho de sucesso

1. Informe um nome com pelo menos três letras.
2. Escolha a especialidade e a data.
3. Envie novamente.

A mensagem deve apresentar os três valores. O console também deve mostrar os
valores lidos.

## Como observar erros no console

O console mostra a mensagem, o arquivo e a linha aproximada do erro. Comece pela
primeira linha em vermelho.

| Mensagem ou sinal | O que conferir |
|---|---|
| `script.js` não carregou | Nome e caminho usados em `src`. |
| `... is null` | Seletor do JavaScript e `id` do HTML. |
| `Unexpected token` | Aspas, parênteses e chaves perto da linha indicada. |
| Nada acontece ao enviar | Evento `submit`, botão `type="submit"` e console. |

Depois da correção, salve o arquivo e recarregue a página.

## Validação no navegador e no servidor

Esta validação oferece retorno rápido, mas o usuário pode desativar ou alterar o
JavaScript. Portanto, ela não protege os dados por si só.

Quando o formulário for conectado ao PHP, o servidor deverá validar novamente
todos os valores. A regra permanente é:

```text
navegador: melhora a experiência → servidor: confirma e protege o processamento
```

Neste kit não há envio HTTP, banco de dados ou armazenamento.

## Síntese

- `document.querySelector` localiza um elemento do DOM.
- `addEventListener` registra um manipulador para um evento.
- `.value` lê um campo e `.textContent` altera um texto.
- `preventDefault` mantém esta demonstração de formulário na mesma página.
- O console ajuda a acompanhar valores e encontrar erros.

Agora aplique esse fluxo na [atividade do kit](atividade.md).
