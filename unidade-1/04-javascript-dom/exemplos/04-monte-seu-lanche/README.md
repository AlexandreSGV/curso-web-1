# Monte seu lanche

Uma calculadora de pedido com preço, quantidade, bebida opcional e uma promoção fictícia. O objetivo é relacionar a sintaxe de JavaScript aos campos de uma página.

## Executar

Abra [index.html](index.html) diretamente no navegador. Não é preciso servidor, internet ou instalação de pacotes. Mantenha [script.js](script.js) e [styles.css](styles.css) na mesma pasta do HTML.

## O que observar no código

- `Number()` converte o valor do `input` e do `select` para cálculo.
- `.checked` informa se a bebida foi marcada.
- `const` guarda os valores do pedido; `let` permite mudar adicional e desconto.
- `if` aplica as regras e `return` encerra uma entrada inválida.
- O evento `submit` calcula e apresenta o resumo sem navegar.
- Os eventos `input` e `change` dos campos também chegam ao formulário. Ao editar o pedido, o resultado anterior é ocultado até calcular novamente.

`formatarReais()` é uma função curta: `toFixed(2)` produz um texto com duas casas decimais, e `replace(".", ",")` troca seu separador para exibição.

## Experimente

| Pedido | Resultado |
|---|---|
| 1 clássico, sem bebida | R$ 16,00 |
| 2 especiais, com bebida | R$ 56,00 |
| 3 clássicos, com bebida | Subtotal R$ 66,00; desconto R$ 6,60; total R$ 59,40 |
| Quantidade vazia, fracionada ou fora de 1 a 10 | Envio bloqueado pela validação HTML |
| Alterar opções depois de calcular | Resumo ocultado e pedido de novo cálculo |

O JavaScript também valida a quantidade e as opções antes do cálculo. Esta é uma simulação: nada é enviado ou cobrado.

## Modifique

Altere o valor da bebida para R$ 8,00 e atualize o texto no HTML. Depois faça a promoção valer somente a partir de 4 lanches. Localize exatamente quais condições e valores precisam mudar.

[Sintaxe na apostila](../../README.md#2-sintaxe-básica-de-javascript) · [Formulários e validação](../../README.md#5-lendo-e-validando-formulários)
