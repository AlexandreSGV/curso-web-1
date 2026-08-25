# Atividade — interação no formulário do consultório

Acrescente JavaScript à página de consultório criada na atividade anterior. O
formulário deverá verificar os dados e apresentar uma mensagem sem recarregar a
página.

## Onde salvar

No seu repositório privado de Web 1, crie:

```text
atividades-iniciais/
└── atividade-02-javascript-dom/
    ├── index.html
    ├── styles.css
    └── script.js
```

Você pode copiar `index.html` e `styles.css` de
`atividade-01-html-css-grid` e continuar a partir deles.

## Requisitos essenciais

1. Crie `script.js` e carregue-o no HTML com `src` e `defer`.
2. Mantenha no formulário pelo menos os campos nome, especialidade e data.
3. Acrescente um `id` ao formulário e uma área visível para mensagens com
   `id` e `aria-live="polite"`.
4. Use `document.querySelector` para localizar o formulário, os três campos e a
   área de mensagem.
5. Ouça o evento `submit` com `addEventListener` e use `preventDefault`.
6. Leia os valores com `.value` e retire espaços do nome com `trim()`.
7. Se o nome tiver menos de três letras ou algum dos outros valores estiver
   vazio, mostre uma orientação com `.textContent`.
8. Caso contrário, mostre uma mensagem de sucesso com o nome e os dados do
   atendimento.

## Resultado esperado

Ao enviar o formulário vazio, a página deve permanecer aberta e exibir uma
orientação. Ao informar valores válidos, a mensagem deve ser substituída pela
confirmação. O console não deve apresentar erros.

## Critérios de correção

Será possível observar se:

- os três arquivos estão na pasta solicitada e ligados corretamente;
- os seletores encontram os elementos correspondentes do HTML;
- o evento `submit` executa sem recarregar a página;
- os valores são lidos dentro do manipulador;
- os caminhos de erro e de sucesso mostram mensagens visíveis;
- o código usa somente os recursos ensinados neste kit;
- a página continua organizada e legível.

## Melhorias opcionais

Depois de atender aos requisitos essenciais, você pode:

- validar um quarto campo usando a mesma condição;
- incluir o valor desse campo na mensagem de sucesso;
- ajustar o CSS da área de mensagem, mantendo o texto legível.

Essas melhorias não fazem parte da correção. Não use API, `fetch`, servidor,
banco de dados ou armazenamento nesta atividade.

## Entrega

Registre os arquivos no seu repositório privado de Web 1. Se precisar rever o
processo, consulte o
[guia de Git, GitHub e entrega](../../apoio/compartilhado/git-github-entrega/).

No Google Classroom, envie somente o link geral do seu repositório privado.
