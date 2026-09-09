# Lista de missões

Adicione pequenas tarefas, marque as concluídas, reabra uma tarefa ou remova um item. O contador acompanha as alterações na lista.

## Executar

Abra [index.html](index.html) diretamente no navegador. Não é preciso servidor ou internet. Os outros arquivos são [script.js](script.js) e [styles.css](styles.css).

## O que observar no código

`criarMissao()` constrói um `li`, um texto e dois botões com `createElement()`. A função registra os eventos de cada botão antes de inserir o item com `append()`.

O botão está diretamente dentro do `li`. Assim, `evento.target.parentElement` permite localizar a missão que recebeu a ação. `classList.toggle()` alterna a classe `concluida`; o CSS muda o fundo e risca o texto. `remove()` retira o item do DOM.

`atualizarProgresso()` usa `querySelectorAll()` para obter os itens atuais e `for...of` para contar os concluídos. A lista no DOM guarda o estado desta demonstração; recarregar volta às duas missões iniciais.

## Experimente

1. Adicione uma missão: o total deve aumentar.
2. Conclua uma missão: o texto fica riscado e o contador aumenta.
3. Clique em **Reabrir**: a marca de conclusão é retirada.
4. Remova uma missão concluída: tanto o total quanto a contagem de concluídas devem ser atualizados.
5. Remova todas: o contador deve mostrar `0 de 0`.
6. Tente cadastrar apenas espaços: uma mensagem pede um texto válido.
7. Digite `<b>Minha missão</b>`: as marcações devem aparecer como texto, pois usamos `textContent`.

Os botões também podem ser alcançados com `Tab` e acionados pelo teclado. O texto **Concluir/Reabrir** e `aria-pressed` indicam seu estado, além da cor.

## Modifique

Troque as duas missões iniciais e crie outra aparência para a classe `concluida`. Depois acrescente uma mensagem especial quando todas as missões estiverem concluídas, lembrando de tratar a lista vazia.

[DOM na apostila](../../README.md#3-dom-encontrando-e-alterando-elementos)
