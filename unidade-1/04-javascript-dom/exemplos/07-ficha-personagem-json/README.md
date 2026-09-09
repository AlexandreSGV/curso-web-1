# Ficha de personagem em JSON

Crie uma ficha com nome, classe e nível. Converta-a em texto JSON, edite esse texto e recupere os dados no formulário e no cartão.

## Executar

Abra [index.html](index.html) diretamente no navegador. Funciona sem internet e sem servidor. Os arquivos de apoio são [script.js](script.js) e [styles.css](styles.css).

## O que observar no código

`gerarFicha()` lê os campos, cria um objeto e usa `JSON.stringify()` para serializá-lo. Na chamada `JSON.stringify(ficha, null, 2)`, o último argumento apenas organiza o texto com recuo de dois espaços.

`importarFicha()` usa `JSON.parse()` para desserializar o texto. O bloco `try/catch` trata um erro de escrita do JSON: se a leitura falhar, `catch` mostra uma orientação e a página continua funcionando.

Há duas verificações diferentes:

| Situação | Exemplo | Tratamento |
|---|---|---|
| Texto não é JSON válido | Falta uma aspa ou chave | Mensagem de erro de sintaxe |
| JSON válido, mas ficha inadequada | `null`, `[]`, nível `"5"` ou nível `99` | Mensagem de validação dos dados |
| Ficha válida | Nome, classe permitida e nível inteiro de 1 a 20 | Formulário e cartão atualizados |

O nível é um número no JSON, sem aspas. As classes aceitas são `Explorador`, `Criador` e `Guardião`. Propriedades adicionais são ignoradas ao montar a ficha importada. Textos são apresentados com `textContent`.

## Experimente

1. Gere a ficha de Luna e observe o JSON.
2. No JSON, altere `"nome"` para `"Kai"` e `"nivel"` para `5`; importe.
3. Retire uma aspa e importe: aparece uma orientação de sintaxe.
4. Corrija a escrita e use nível `99`: o JSON é válido, mas a regra da ficha o rejeita.
5. Use nível `5` novamente: a importação volta a funcionar.

Os dados ficam apenas na memória da página. Se quiser guardar uma ficha, copie o texto antes de recarregar; poderá colá-lo e importá-lo depois.

## Modifique

Acrescente uma quarta classe no `select` e na validação JavaScript. Depois inclua uma propriedade `pontos`, acompanhando sua passagem pelo formulário, pelo objeto, pelo JSON e pelo cartão.

[JSON na apostila](../../README.md#6-objetos-texto-json-e-conversões)
