# PHP: primeiros passos no servidor

Uma página pode enviar dados para o servidor, solicitar um cálculo e receber uma resposta preparada naquele momento. Nesta apostila, vamos usar **PHP no back-end** para realizar essas tarefas.

A apresentação da sintaxe será breve e acompanhada de exemplos. O foco está em receber uma requisição, processar dados e devolver HTML ou JSON.

## Índice

1. [PHP no servidor](#1-php-no-servidor)
2. [Executando o primeiro arquivo](#2-executando-o-primeiro-arquivo)
3. [Sintaxe essencial](#3-sintaxe-essencial)
4. [Arrays e foreach](#4-arrays-e-foreach)
5. [Preparando HTML com PHP](#5-preparando-html-com-php)
6. [Recebendo e validando dados](#6-recebendo-e-validando-dados)
7. [Calculadora com GET](#7-calculadora-com-get)
8. [Formulário e action com POST](#8-formulário-e-action-com-post)
9. [Respostas HTTP e JSON](#9-respostas-http-e-json)
10. [Redirecionamentos](#10-redirecionamentos)
11. [Chamando uma API pelo servidor](#11-chamando-uma-api-pelo-servidor)
12. [Exemplos e consulta rápida](#12-exemplos-e-consulta-rápida)

## 1. PHP no servidor

**PHP** significa *PHP: Hypertext Preprocessor*. É uma linguagem de código aberto, bastante utilizada no desenvolvimento Web. Permite combinar instruções de programação com HTML e também produzir respostas em outros formatos, como JSON.

Algumas características:

- executa em diferentes sistemas operacionais;
- possui tipagem dinâmica: uma variável recebe um tipo conforme o valor atribuído;
- oferece recursos prontos para formulários, arquivos, bancos de dados e comunicação HTTP;
- permite escrever pequenos scripts e organizar aplicações maiores;
- pode ser executada pelo terminal; aqui, o foco será atender requisições Web.

No uso Web, o servidor encaminha o arquivo ao interpretador PHP e envia ao cliente a saída produzida. [Manual do PHP — Introdução](https://www.php.net/manual/pt_BR/introduction.php).

No **back-end, do lado do servidor**, o PHP recebe os dados das requisições, valida entradas, realiza o processamento e aplica as **regras de negócio** da aplicação. Por exemplo, uma regra pode impedir o empréstimo de um livro indisponível. O PHP também pode acessar o banco de dados para consultar, cadastrar, atualizar e excluir informações.

Após esse processamento, o PHP prepara a resposta que o servidor envia ao cliente. Ele pode **gerar HTML para compor as páginas do front-end** ou **enviar dados em JSON** para uma interface utilizar. O navegador apresenta essas páginas e executa o JavaScript responsável pelas interações.

### Onde cada parte executa?

| Tecnologia | Papel nos exemplos |
|---|---|
| HTML | Estruturar o formulário e a página de resultado |
| CSS | Definir a apresentação da página |
| JavaScript no navegador | Tratar interações e modificar o DOM, quando necessário |
| PHP no servidor | Receber dados, validar, calcular, consultar serviços e preparar a resposta |

Considere uma calculadora:

1. O navegador apresenta um formulário HTML.
2. O usuário envia dois números.
3. O navegador faz uma requisição ao servidor.
4. O PHP recebe os números e calcula a soma.
5. O servidor devolve uma página com o resultado.

**O navegador recebe o resultado da execução, não o código-fonte PHP.** Um `foreach` pode gerar dez linhas de uma tabela; o navegador recebe essas linhas em HTML.

O PHP não altera diretamente o DOM de uma página que já está aberta. Ele prepara uma resposta; o navegador pode exibi-la como uma nova página, ou um JavaScript pode usar os dados recebidos. Nos formulários desta apostila, a própria navegação apresenta a resposta, sem precisar de JavaScript.

Cliente e servidor podem estar no mesmo computador durante o desenvolvimento. Ainda assim, navegador e servidor PHP são processos com responsabilidades distintas.

## 2. Executando o primeiro arquivo

Use a instalação descrita no [guia de ambiente de Web 1](../../apoio/ambiente-web1-windows/). Confira no terminal:

```bash
php -v
```

Crie uma pasta de teste e salve nela um arquivo `index.php`, em **UTF-8 sem BOM**:

```php
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>Primeiro PHP</title>
</head>
<body>
  <h1>Minha primeira página com PHP</h1>
  <p><?php echo 'Olá, turma!'; ?></p>
</body>
</html>
```

No terminal, dentro dessa pasta, execute:

```bash
php -S localhost:8000
```

Abra [http://localhost:8000/index.php](http://localhost:8000/index.php). Mantenha o terminal aberto; `Ctrl+C` encerra o servidor. Esse servidor embutido serve para desenvolvimento e estudo.

Abrir o arquivo por `file:///` não executa PHP. Um servidor que entrega apenas arquivos estáticos, como o Live Server usado para HTML, também não interpreta PHP por conta própria.

### Abrindo e fechando um trecho PHP

- `<?php` inicia o código PHP.
- `?>` encerra o trecho e permite continuar escrevendo HTML.
- `echo` escreve na saída que será enviada ao cliente.
- `<?= $nome ?>` é uma forma curta de escrever `<?php echo $nome; ?>`.

Em um arquivo que contém **somente PHP**, comece com `<?php` e deixe de fora o fechamento `?>`. Isso evita espaços acidentais na saída, que podem atrapalhar os cabeçalhos HTTP.

## 3. Sintaxe essencial

Os trechos desta seção são independentes e devem ser colocados dentro de `<?php ... ?>` quando usados em uma página.

### Variáveis, constantes e textos

```php
$nome = 'Ana';             // string
$quantidade = 3;           // int
$preco = 12.50;            // float: ponto na parte decimal
$disponivel = true;        // bool: true ou false
$observacao = null;        // ausência de valor
const NOME_LOJA = 'Papelaria';

$total = $quantidade * $preco;
echo "Olá, $nome!";                 // insere o valor da variável
echo 'Total: ' . $total;            // ponto concatena textos
echo '$nome';                      // aspas simples: texto literal
echo NOME_LOJA;                    // constante não usa $
```

As variáveis começam com `$`; não usamos `let` para declará-las. `$nome` e `$Nome` são variáveis diferentes. As instruções normalmente terminam com `;`, e os blocos usam `{ ... }`.

Use `//` para comentar uma linha e `/* ... */` para um comentário de várias linhas. `echo` não acrescenta automaticamente uma quebra visual no HTML: organize a saída com elementos como `<p>`.

### Operadores, condições e repetições

```php
$estoque = 3;

if ($estoque === 0) {
    echo 'Produto indisponível';
} elseif ($estoque < 5) {
    echo 'Poucas unidades';
} else {
    echo 'Produto disponível';
}

for ($numero = 1; $numero <= 3; $numero++) {
    echo $numero . ' ';
}

$tentativas = 0;
while ($tentativas < 2) {
    $tentativas++;
}
```

| Operadores | Uso |
|---|---|
| `+`, `-`, `*`, `/`, `%` | Soma, subtração, multiplicação, divisão e resto da divisão inteira |
| `.` | Concatenação de textos |
| `=` | Atribuição |
| `===`, `!==` | Comparação considerando valor e tipo |
| `>`, `<`, `>=`, `<=` | Comparações de ordem |
| `&&`, `\|\|`, `!` | E, ou e não |
| `++` | Incremento de uma unidade |

`5 === '5'` é `false`: um valor é inteiro e o outro é texto. O operador `==` permite conversões de tipo na comparação; prefira `===` e faça as conversões necessárias de forma explícita.

### Funções e conversões

```php
function calcularTotal($preco, $quantidade)
{
    return $preco * $quantidade;
}

$total = calcularTotal(12.50, 3);
echo $total; // 37.5

$texto = '12.50';
$numero = (float) $texto;
echo $numero + 2; // 14.5
```

`return` devolve um valor para quem chamou a função. `echo` escreve na resposta. São ações diferentes. Variáveis criadas dentro de uma função pertencem ao seu escopo; passe os dados necessários pelos parâmetros.

`(int)`, `(float)` e `(string)` convertem valores. Nas calculadoras, usaremos `(float)` para transformar os números enviados pelo formulário em valores numéricos.

Para investigar valores durante o estudo:

```php
var_dump($numero); // mostra o valor e o tipo
```

**Experimente:** a [página de comandos básicos](exemplos/01-comandos-basicos/) reúne essas estruturas. No [index.php](exemplos/01-comandos-basicos/index.php), altere a quantidade e a disponibilidade do produto; depois recarregue a página.

## 4. Arrays e foreach

### Array com índices numéricos

```php
$cores = ['Azul', 'Verde'];
$cores[] = 'Roxo';              // acrescenta um item

echo $cores[0];                 // Azul
echo count($cores);             // 3

foreach ($cores as $cor) {
    echo $cor . ' ';
}
```

Nessa lista, os índices começam em zero. `count()` informa a quantidade de itens e `foreach` percorre cada valor sem exigir que controlemos o índice.

### Array associativo: chaves com significado

```php
$produto = [
    'nome' => 'Caderno',
    'preco' => 12.50,
    'estoque' => 12
];

echo $produto['nome'];          // Caderno
$produto['estoque'] = 10;

foreach ($produto as $campo => $valor) {
    echo $campo . ': ' . $valor . '<br>';
}
```

`=>` associa uma chave a um valor. `$produto['nome']` acessa o valor da chave `nome`. Não usamos a sintaxe `$produto.nome` para acessar um array PHP.

| Forma do foreach | O que fica disponível em cada repetição |
|---|---|
| `foreach ($cores as $cor)` | O valor atual |
| `foreach ($produto as $campo => $valor)` | A chave atual e seu valor |

Um array PHP reúne pares de chave e valor. As chaves podem ser numéricas ou textuais; aqui, usamos listas e registros como duas maneiras práticas de organizar os dados. [Manual do PHP — Arrays](https://www.php.net/manual/pt_BR/language.types.array.php).

### Uma lista de registros

```php
$produtos = [
    ['nome' => 'Caderno', 'preco' => 12.50],
    ['nome' => 'Caneta', 'preco' => 3.00]
];

foreach ($produtos as $produto) {
    echo $produto['nome'] . '<br>';
}
```

Cada item da lista é outro array. Esse formato será útil para apresentar resultados de consultas e dados recebidos de APIs.

## 5. Preparando HTML com PHP

Podemos deixar o HTML visível no arquivo e usar PHP apenas nos pontos que precisam de dados ou repetições:

```php
<?php
$produto = ['nome' => 'Caderno', 'categoria' => 'Material escolar'];
?>
<table>
  <thead><tr><th>Campo</th><th>Valor</th></tr></thead>
  <tbody>
    <?php foreach ($produto as $campo => $valor): ?>
      <tr>
        <th><?= $campo ?></th>
        <td><?= $valor ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
```

`foreach (...):` e `endforeach;` são uma sintaxe alternativa às chaves, útil quando há HTML entre os trechos de PHP. Também existem `if (...): ... endif;` e `for (...): ... endfor;`.

O [exemplo de comandos básicos](exemplos/01-comandos-basicos/index.php) apresenta uma tabela com `foreach`: a cada repetição, uma nova linha exibe a chave e o valor do array. Alterar o array e recarregar a página altera a tabela recebida pelo navegador.

## 6. Recebendo e validando dados

PHP disponibiliza arrays especiais para acessar os dados da requisição:

| Variável | Conteúdo usado nesta apostila |
|---|---|
| `$_GET` | Parâmetros da URL, depois de `?` |
| `$_POST` | Campos enviados no corpo de um formulário com POST |

Essas variáveis são chamadas de **superglobais**. Para ler um campo, usamos sua chave:

```php
$nome = $_POST['nome'];
```

Campos de formulários comuns chegam como **texto**, mesmo quando o HTML usa `type="number"`. Para calcular, podemos converter o valor:

```php
$a = (float) $_GET['a'];
```

Na URL, escreva decimais com ponto, como `a=2.5`. Nos exemplos de calculadora, envie os dois números pelo formulário ou pelos parâmetros indicados.

### Uma validação simples

Na action de um formulário POST com um campo `name="nome"`, podemos conferir se o texto foi preenchido:

```php
$nome = $_POST['nome'];

if ($nome === '') {
    echo 'Preencha o nome.';
} else {
    echo 'Olá, ' . $nome;
}
```

Aqui, o foco é usar uma condição para validar um campo. O atributo `required` faz uma conferência no navegador; este `if` faz a conferência no servidor.

## 7. Calculadora com GET

O navegador pode enviar dois valores pela própria URL:

```text
http://localhost:8000/02-calculadora-get/calcular.php?a=10&b=5
```

`?` inicia os parâmetros e `&` separa um parâmetro do seguinte. O PHP acessa esses valores por `$_GET['a']` e `$_GET['b']`.

O núcleo de `calcular.php` é:

```php
<?php
$a = (float) $_GET['a'];
$b = (float) $_GET['b'];
$resultado = $a + $b;
echo 'Resultado: ' . $resultado;
```

Para `a=10&b=5`, o corpo da resposta contém `Resultado: 15`. Altere os valores na URL e envie uma nova requisição.

Também é possível gerar essa URL com um formulário:

```html
<form action="calcular.php" method="get">
  <label for="a">Primeiro valor</label>
  <input type="number" id="a" name="a" step="any" required>

  <label for="b">Segundo valor</label>
  <input type="number" id="b" name="b" step="any" required>

  <button type="submit">Somar</button>
</form>
```

`action` indica o endereço que receberá a requisição. `method="get"` coloca os campos na URL. `name="a"` define a chave que será recebida pelo PHP; `id="a"` liga o campo ao `label` e pode ser usado por CSS e JavaScript. **Um campo sem `name` não envia um par nome/valor.**

GET é adequado para consultas e cálculos sem alteração de dados persistentes. O endereço pode ser guardado ou compartilhado, e seus parâmetros ficam visíveis na URL.

**Experimente:** abra a [calculadora GET](exemplos/02-calculadora-get/). Compare o [formulário](exemplos/02-calculadora-get/index.html) com o [processamento em PHP](exemplos/02-calculadora-get/calcular.php). Localize a leitura dos dois valores, a soma e a apresentação do resultado.

## 8. Formulário e action com POST

Na versão POST, o cálculo continua igual. O formulário passa a usar:

```html
<form action="calcular.php" method="post">
  <label for="a">Primeiro valor</label>
  <input type="number" id="a" name="a" step="any" required>

  <label for="b">Segundo valor</label>
  <input type="number" id="b" name="b" step="any" required>

  <button type="submit">Somar</button>
</form>
```

No PHP, lemos `$_POST` e fazemos a mesma soma:

```php
<?php
$a = (float) $_POST['a'];
$b = (float) $_POST['b'];
$resultado = $a + $b;
echo 'Resultado: ' . $resultado;
```

O nome do arquivo indicado em `action` continua sendo `calcular.php`. O que muda é `method="post"` no formulário e o uso de `$_POST` no processamento.

Os campos POST são enviados no **corpo da requisição**. Eles não aparecem na URL, mas continuam acessíveis nas ferramentas de desenvolvimento do navegador. POST não criptografa os dados; a proteção da comunicação depende de HTTPS.

| Comparação | GET | POST do formulário |
|---|---|---|
| Onde ficam os campos | Na URL | No corpo da requisição |
| Como os exemplos leem | `$_GET` | `$_POST` |
| Uso comum | Consultas e buscas | Envio de dados para processamento, como cadastros |
| Na nossa calculadora | Recebe dois valores e soma | Recebe dois valores e soma |

O array `$_GET` lê os parâmetros da URL **mesmo se a requisição for POST**. Já `$_POST` recebe os campos dos formatos de formulário usuais; um corpo JSON precisa ser lido e convertido separadamente. [Manual do PHP — GET](https://www.php.net/manual/en/reserved.variables.get.php) e [POST](https://www.php.net/manual/en/reserved.variables.post.php).

**Experimente:** execute a [calculadora POST](exemplos/03-calculadora-post/) e acompanhe o envio na aba **Rede/Network** do navegador. Localize os dados enviados e a página de resultado. Comece pelo formulário `index.html`: ele envia os números para a action `calcular.php`.

## 9. Respostas HTTP e JSON

Uma resposta tem **código de status**, **cabeçalhos** e **corpo**. Imprimir uma mensagem é apenas uma parte da resposta.

| Código | Significado |
|---|---|
| `200` | Processamento realizado com sucesso |
| `303` | O navegador deve buscar o resultado em outro endereço |
| `400` | Dados ausentes ou inválidos |

### Uma resposta com dados

```php
<?php
header('Content-Type: application/json');
http_response_code(200);

$dados = ['resultado' => 15];
echo json_encode($dados);
```

O corpo será:

```json
{"resultado":15}
```

`Content-Type` informa o formato. Uma resposta JSON pode ser usada por outro programa; uma resposta HTML prepara uma página para apresentação.

### Serializar e desserializar

```php
$produto = ['nome' => 'Caderno', 'preco' => 12.50];

$textoJson = json_encode($produto);         // array PHP → texto JSON
$dados = json_decode($textoJson, true);     // texto JSON → array PHP

echo $dados['nome'];
```

O `true` no segundo argumento de `json_decode()` faz os objetos JSON serem representados como arrays associativos. Uma lista PHP com índices consecutivos a partir de zero normalmente vira uma lista JSON (`[...]`); um registro com chaves textuais vira um objeto JSON (`{...}`). JSON é texto, e um array PHP é uma estrutura em memória.

Consulte também o [Manual do PHP — json_decode](https://www.php.net/manual/pt_BR/function.json-decode.php).

### Uma resposta de erro

```php
<?php
header('Content-Type: application/json');
http_response_code(400);
echo json_encode(['erro' => 'Informe dois números.']);
```

Este trecho produz uma resposta de erro para demonstrar o status `400`. `http_response_code()` define o status; `echo` envia os dados. Em uma resposta JSON, mantenha o corpo somente nesse formato, sem misturá-lo com HTML.

Envie `header()` e o status **antes de qualquer saída**, inclusive HTML e espaços fora das tags PHP. Salvar arquivos PHP sem BOM ajuda a evitar uma saída invisível antes do código. [Manual do PHP — header](https://www.php.net/manual/pt_BR/function.header.php).

**Experimente:** o [exemplo de resposta JSON](exemplos/04-resposta-json/) tem dois arquivos curtos. `index.php?a=10&b=5` calcula a soma e responde com `200`; [erro.php](exemplos/04-resposta-json/erro.php) produz sempre a resposta de demonstração com `400`. Abra os dois e compare o corpo e o status na aba Rede/Network.

## 10. Redirecionamentos

Uma resposta também pode orientar o navegador a abrir outro endereço. Depois de processar um POST, podemos responder com `303` e o cabeçalho `Location`:

```php
<?php
header('Location: confirmacao.php', true, 303);
exit;
```

`true` indica que esse cabeçalho substitui outro `Location` eventualmente definido. `303` orienta o navegador a buscar a página de destino por GET após o POST. `exit` impede que o script continue executando depois de preparar o redirecionamento.

O fluxo passa a ser:

1. O formulário envia um POST para `processar.php`.
2. O PHP recebe os dados e responde com `303` e `Location`.
3. O navegador faz um novo GET para a página indicada.

Assim, atualizar a página final repete o GET, em vez de reenviar o formulário. Uma nova requisição não recebe automaticamente as variáveis locais do script anterior.

No [exemplo de redirecionamento](exemplos/05-redirecionamento/), passamos um nome fictício pela URL de destino:

```php
$nome = $_POST['nome'];
header('Location: confirmacao.php?nome=' . rawurlencode($nome), true, 303);
exit;
```

`rawurlencode()` codifica o valor para usá-lo como parâmetro da URL, inclusive quando o nome contém espaços. A página final lê `$_GET['nome']` e apresenta o valor. O exemplo não armazena dados.

## 11. Chamando uma API pelo servidor

O PHP também pode atuar como cliente HTTP de outro servidor. Por exemplo, ele consulta o **JSONPlaceholder**, recebe JSON e prepara uma página HTML com os dados.

O endereço [https://jsonplaceholder.typicode.com/posts/1](https://jsonplaceholder.typicode.com/posts/1) retorna uma publicação de demonstração, com campos como `title` e `body`. A consulta não exige chave de API. [JSONPlaceholder — Guia](https://jsonplaceholder.typicode.com/guide/).

Podemos buscar o JSON e colocá-lo em `$publicacao` com duas instruções:

```php
$texto = file_get_contents('https://jsonplaceholder.typicode.com/posts/1');
$publicacao = json_decode($texto, true);
```

`file_get_contents()` faz a consulta GET e devolve o corpo da resposta como texto. `json_decode(..., true)` transforma esse texto em um array associativo. [Manual do PHP — file_get_contents](https://www.php.net/manual/pt_BR/function.file-get-contents.php).

Agora os dados podem ser apresentados no HTML:

```php
<h2><?= $publicacao['title'] ?></h2>
<p><?= $publicacao['body'] ?></p>
```

Para executar a consulta, é preciso acesso à internet, `allow_url_fopen` habilitado (padrão do PHP) e suporte a HTTPS pela extensão OpenSSL, indicada no [guia de ambiente](../../apoio/ambiente-web1-windows/). [Manual do PHP — Configuração de acesso a URLs](https://www.php.net/manual/pt_BR/filesystem.configuration.php).

**Experimente:** a última seção da [página de comandos básicos](exemplos/01-comandos-basicos/) apresenta a publicação. O arquivo [consulta-api.php](exemplos/01-comandos-basicos/consulta-api.php) prepara `$publicacao`; o `index.php` gera o HTML.

A chamada entre o servidor PHP e o JSONPlaceholder não aparece como uma chamada direta do navegador ao JSONPlaceholder na aba Rede. O navegador solicitou nossa página; foi o servidor que consultou a API.

## 12. Exemplos e consulta rápida

### Executando os exemplos da apostila

A partir da raiz do repositório:

```bash
cd unidade-1/05-php/exemplos
php -S localhost:8000
```

Abra os endereços indicados no [índice dos exemplos](exemplos/). Eles executam em PHP 8 e compartilham um pequeno `styles.css` apenas para apresentação.

| Exemplo | O que observar |
|---|---|
| [01 — Comandos básicos](exemplos/01-comandos-basicos/) | Variáveis, condições, função, arrays, `foreach`, tabela e API |
| [02 — Calculadora GET](exemplos/02-calculadora-get/) | Parâmetros na URL, soma e resposta HTML |
| [03 — Calculadora POST](exemplos/03-calculadora-post/) | Formulário, `action`, corpo da requisição e processamento |
| [04 — Resposta JSON](exemplos/04-resposta-json/) | Corpo JSON e códigos `200` e `400` em arquivos separados |
| [05 — Redirecionamento](exemplos/05-redirecionamento/) | POST, `Location`, `303` e novo GET |

O exemplo 01 inclui outro arquivo com:

```php
require 'consulta-api.php';
```

`require` carrega e executa o arquivo indicado, que está na mesma pasta do `index.php`. Assim, a consulta fica em um arquivo pequeno e a apresentação fica na página.

### Erros que vale saber localizar

| Sintoma | O que conferir |
|---|---|
| O PHP não executa | Use o servidor PHP e um endereço `http://localhost:8000/...` |
| `Parse error` | Confira a linha indicada, os `;`, as aspas e o fechamento dos blocos |
| `Undefined array key` | Confira o `name` enviado e se os parâmetros indicados no exemplo foram preenchidos |
| `Headers already sent` | Procure saída antes de `header()`, incluindo HTML, espaços e BOM |
| O formulário chega sem o campo esperado | Confira `action`, `method`, `name` e se o campo está desabilitado |
| A resposta deveria ser JSON, mas não é | Procure HTML, avisos ou saídas de depuração misturados aos dados |
| A consulta à API falha | Confira a conexão, o endereço e a configuração de acesso a URLs do PHP |

Leia também as mensagens no terminal do servidor. Para conferir a sintaxe de um arquivo sem executá-lo, use `php -l calcular.php` na pasta correspondente.

### Pequenas modificações para praticar

1. Acrescente um campo ao array associativo e observe a nova linha da tabela.
2. Teste a calculadora com zero, um número negativo e um decimal.
3. Compare o resultado HTML da calculadora com a resposta JSON para os mesmos números.
4. Troque a soma por multiplicação. Depois, implemente divisão e trate divisor zero.
5. Na consulta à API, troque `/posts/1` por `/posts/2` e observe a resposta.

### O que você precisa guardar

- O PHP executa no servidor; o navegador recebe a saída produzida.
- As variáveis usam `$`, a concatenação usa `.` e os arrays associam chaves a valores.
- `foreach` percorre valores ou pares de chave e valor.
- O `name` do campo identifica o dado recebido pelo PHP.
- Uma condição `if` permite conferir o preenchimento de um campo.
- `echo` prepara o corpo; `header()` e `http_response_code()` preparam outras partes da resposta.
- `json_encode()` serializa dados; `json_decode()` interpreta texto JSON.
- Um redirecionamento provoca outra requisição.
- O servidor PHP também pode fazer requisições para APIs externas.

## Referências

- [Manual do PHP — Introdução](https://www.php.net/manual/pt_BR/introduction.php)
- [Manual do PHP — Formulários](https://www.php.net/manual/pt_BR/tutorial.forms.php)
- [Manual do PHP — Arrays](https://www.php.net/manual/pt_BR/language.types.array.php)
- [Manual do PHP — foreach](https://www.php.net/manual/en/control-structures.foreach.php)
- [Manual do PHP — http_response_code](https://www.php.net/manual/pt_BR/function.http-response-code.php)
- [Manual do PHP — JSON](https://www.php.net/manual/pt_BR/book.json.php)
- [Manual do PHP — file_get_contents](https://www.php.net/manual/pt_BR/function.file-get-contents.php)
- [JSONPlaceholder — Guia](https://jsonplaceholder.typicode.com/guide/)
