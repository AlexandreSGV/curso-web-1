# HTML, CSS e Grid

Neste kit, você construirá uma página simples de consultório com informações
para o paciente e um formulário de solicitação de atendimento.

Ao final, você deverá conseguir:

- organizar o conteúdo com HTML;
- aplicar aparência e espaçamento com CSS;
- criar um formulário com rótulos claros;
- distribuir as partes principais da página com CSS Grid.

Use como referência o [exemplo completo](exemplo/index.html). A atividade está
em [atividade.md](atividade.md).

## O papel do HTML e do CSS

O **HTML** descreve a estrutura e o conteúdo: títulos, parágrafos, seções,
listas e campos de formulário.

O **CSS** controla a apresentação: cores, fontes, espaçamentos, bordas e a
disposição dos elementos na tela.

Neste kit, cada linguagem fica em um arquivo:

```text
exemplo/
├── index.html
└── styles.css
```

## 1. Prepare a estrutura HTML

Crie `index.html` e comece pela estrutura básica:

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consultório Vida</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- O conteúdo visível será colocado aqui. -->
</body>
</html>
```

As partes principais são:

| Elemento | Função |
|---|---|
| `head` | Guarda configurações, título da aba e ligação com o CSS. |
| `body` | Contém tudo o que aparece na página. |
| `header` | Apresenta o cabeçalho da página. |
| `main` | Identifica o conteúdo principal. |
| `section` | Agrupa um assunto dentro do conteúdo principal. |
| `footer` | Apresenta o rodapé. |

`lang="pt-BR"` informa o idioma. `charset="UTF-8"` permite usar acentos. A
linha com `viewport` ajuda a página a se ajustar em telas menores.

### Ponto de conferência

Abra `index.html` no navegador. A aba deve mostrar **Consultório Vida**. A
página ainda estará vazia, porque o `body` não recebeu conteúdo.

## 2. Organize o conteúdo da página

Dentro de `body`, use esta sequência:

```html
<header class="cabecalho">
  <h1>Atendimento com cuidado e organização</h1>
</header>

<main class="conteudo-principal">
  <section class="cartao">
    <h2>Antes da consulta</h2>
    <p>Orientações para o paciente.</p>
  </section>

  <section class="cartao">
    <h2>Solicite um atendimento</h2>
    <!-- O formulário entrará aqui. -->
  </section>
</main>

<footer class="rodape">
  <p>Consultório Vida — exemplo acadêmico de Web 1.</p>
</footer>
```

Os nomes escritos em `class` serão usados pelo CSS. Uma mesma classe pode ser
reutilizada, como acontece com os dois cartões.

Outros elementos de conteúdo presentes no exemplo:

| Elemento | Função |
|---|---|
| `h1` e `h2` | Criam o título da página e os títulos das seções. |
| `p` | Cria um parágrafo. |
| `ul` e `li` | Criam uma lista e seus itens. |
| `div` | Agrupa elementos quando não há um significado específico. |

### Ponto de conferência

Recarregue a página. O cabeçalho, as duas seções e o rodapé devem aparecer na
ordem, ainda sem o acabamento visual.

## 3. Crie o formulário

Um campo acessível possui um `label`. O valor de `for` no rótulo deve ser igual
ao `id` do campo:

```html
<form>
  <div class="campo">
    <label for="nome">Nome completo</label>
    <input class="controle" type="text" id="nome" name="nome" required>
  </div>

  <div class="campo">
    <label for="especialidade">Especialidade</label>
    <select class="controle" id="especialidade" name="especialidade" required>
      <option value="">Selecione</option>
      <option value="clinica-geral">Clínica geral</option>
    </select>
  </div>

  <button class="botao" type="submit">Solicitar horário</button>
</form>
```

Elementos usados no exemplo:

- `form`: agrupa os campos;
- `label`: informa o que deve ser preenchido;
- `input`: recebe dados curtos, como nome, e-mail e data;
- `select`: oferece opções prontas;
- `option`: representa uma opção dentro do `select`;
- `textarea`: recebe um texto maior;
- `button`: cria o botão de envio;
- `required`: indica um campo obrigatório.

O formulário deste kit demonstra apenas a estrutura. Como ainda não existe um
sistema para receber os dados, as informações não são salvas.

## 4. Ligue o CSS ao HTML

Crie `styles.css` na mesma pasta de `index.html`. Esta linha no `head` faz a
ligação entre os arquivos:

```html
<link rel="stylesheet" href="styles.css">
```

Se o nome ou o caminho estiver incorreto, o navegador abrirá o HTML sem os
estilos.

## 5. Use seletores simples

O seletor informa qual parte do HTML receberá uma regra CSS:

| Tipo | Exemplo | O que seleciona |
|---|---|---|
| Elemento | `body` | Todos os elementos com essa etiqueta. |
| Classe | `.cartao` | Todos os elementos com `class="cartao"`. |
| Identificador | `#mensagem-atendimento` | O elemento com esse `id`, que deve ser único. |

Exemplo:

```css
body {
  background-color: #f3f7f8;
  color: #18323a;
  font-family: Arial, sans-serif;
}

.cartao {
  background-color: #ffffff;
}

#mensagem-atendimento {
  font-size: 18px;
}
```

`.cartao h2` seleciona somente os títulos `h2` que estão dentro de um cartão.
Neste primeiro contato, seletores mais complexos não são necessários.

## 6. Entenda o modelo de caixa

O navegador trata cada elemento como uma caixa:

```text
margem → borda → preenchimento → conteúdo
```

- `margin`: espaço do lado de fora da borda;
- `border`: contorno da caixa;
- `padding`: espaço entre a borda e o conteúdo;
- `width` e `max-width`: controlam a largura;
- `box-sizing: border-box`: faz a largura incluir borda e preenchimento.

No exemplo, o cartão usa:

```css
.cartao {
  padding: 24px;
  background-color: #ffffff;
  border: 1px solid #c5d3d7;
  border-radius: 8px;
}
```

`border-radius` arredonda os cantos. As propriedades `color`,
`background-color`, `font-family`, `font-size` e `line-height` cuidam de cores e
legibilidade.

Outras propriedades do exemplo são `font-weight` para o negrito, `font: inherit`
para manter a fonte nos campos, `text-align` para alinhar texto e `cursor` para
indicar o botão ao passar o ponteiro.

## 7. Monte o layout com Grid

Grid organiza os filhos diretos de um elemento em linhas e colunas. Aqui, o
elemento `main` contém os dois cartões:

```css
.conteudo-principal {
  display: grid;
  grid-template-columns: 1fr 2fr;
  gap: 24px;
}
```

- `display: grid` ativa o Grid;
- `grid-template-columns` cria duas colunas;
- `1fr 2fr` reserva uma parte para o primeiro cartão e duas para o segundo;
- `gap` cria espaço entre os cartões.

O formulário também usa Grid, mas com uma única coluna. Nesse caso, `gap`
mantém uma distância igual entre os campos.

### Ponto de conferência

Em uma janela larga, o cartão de orientações deve ocupar a coluna menor e o
formulário a coluna maior.

## 8. Ajuste opcional para tela pequena

O exemplo inclui uma regra curta para colocar os cartões em uma única coluna
quando a tela tem até 700 pixels:

```css
@media (max-width: 700px) {
  .conteudo-principal {
    grid-template-columns: 1fr;
  }
}
```

Essa adaptação é uma demonstração. Ela não será exigida na atividade deste kit.

## Como abrir e inspecionar

1. Abra a pasta `exemplo`.
2. Abra `index.html` no navegador.
3. Depois de alterar um arquivo, salve e recarregue a página.
4. Pressione `F12` e use **Elementos** para observar o HTML e as regras CSS.
5. Reduza a largura da janela para observar a mudança para uma coluna.

## Problemas comuns

### A página aparece sem cores ou espaçamento

Confira se `index.html` e `styles.css` estão na mesma pasta e se a linha usa
exatamente `href="styles.css"`.

### Uma parte da página aparece no lugar errado

Verifique se todas as etiquetas possuem fechamento e se estão na ordem correta.
O editor costuma destacar pares como `<section>` e `</section>`.

### Uma regra de classe não funciona

Compare o nome nos dois arquivos. `class="cartao"` no HTML corresponde a
`.cartao` no CSS. Letras diferentes ou ausência do ponto impedem a seleção.

### O Grid não cria as duas colunas

Confirme se `display: grid` e `grid-template-columns` estão no elemento pai dos
dois cartões. No exemplo, esse elemento é `main.conteudo-principal`.

### Clicar no rótulo não ativa o campo

Confira o par `for` e `id`. Por exemplo, `for="email"` deve apontar para
`id="email"`.

## Síntese

Você usou HTML para organizar o conteúdo, CSS para definir a apresentação e
Grid para distribuir os cartões. No próximo passo, aplique essa estrutura na
[atividade do kit](atividade.md).
