# Adivinhe o número

Um jogo curto de 5 tentativas: encontre o número secreto de 1 a 20 a partir das dicas **maior** e **menor**.

## Executar

Abra [index.html](index.html) diretamente no navegador. Não exige servidor ou internet. Veja também [script.js](script.js) e [styles.css](styles.css).

## O que observar no código

- `submit` recebe um palpite, inclusive quando o jogador usa Enter.
- `click` no botão **Novo jogo** reinicia a partida.
- `let segredo`, `let tentativas` e `let encerrado` guardam o estado entre interações.
- `if` e `else if` distinguem vitória, fim das tentativas e dicas.
- `createElement()` e `append()` acrescentam os palpites ao histórico.
- Ao terminar, o campo e o envio ficam desabilitados; o reinício os libera.

O sorteio acrescenta duas operações simples ao repertório: `Math.random()` produz um número de 0 (inclusive) a 1 (exclusive); `Math.floor()` arredonda para baixo. A expressão `Math.floor(Math.random() * 20) + 1` produz um inteiro de 1 a 20.

## Experimente

Comece com `10` e use cada dica para reduzir as possibilidades. Observe que um palpite repetido também consome uma tentativa.

Para conferir os caminhos de forma previsível, durante o estudo troque temporariamente o retorno de `sortearNumero()` por `return 12;`:

1. Palpite `8`: dica de que o número é maior.
2. Palpite `18`: dica de que o número é menor.
3. Palpite `12`: vitória e bloqueio de novos palpites.
4. Reinicie e erre 5 vezes: fim das tentativas e revelação do número.
5. Reinicie novamente: histórico vazio, contador em 5 e campo habilitado.

Depois restaure o sorteio. Entradas vazias, fracionadas ou fora do intervalo não devem consumir tentativas.

## Modifique

Altere o limite para 7 tentativas. Atualize também as mensagens iniciais no HTML. Que outros trechos já se ajustam automaticamente por usar a constante `limite`?

[Eventos na apostila](../../README.md#4-escutando-e-tratando-eventos)
