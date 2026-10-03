# Exemplo 3 — CRUD de alunos com API PHP e dois front-ends

O PHP recebe requisições HTTP, executa as operações no MySQL com PDO e devolve **JSON**. O JavaScript executa no navegador: lê o formulário, chama a API e atualiza a página.

As duas interfaces oferecem cadastro, listagem, detalhes, edição e exclusão:

- [Front-end mínimo](frontend-minimo/index.html): HTML simples, sem CSS.
- [Front-end com Tailwind](frontend-tailwind/index.html): cabeçalho, formulário, tabela, contador de alunos e painel de detalhes com estilos do Tailwind.

Ambas carregam o mesmo [app.js](js/app.js) e consultam a mesma [API](api/alunos.php). A apresentação muda; os dados e as operações são compartilhados.

## Arquivos

| Caminho | Responsabilidade |
|---|---|
| [api/conexao.php](api/conexao.php) | Configurar e abrir a conexão PDO |
| [api/alunos.php](api/alunos.php) | Executar o CRUD e responder em JSON |
| [js/app.js](js/app.js) | Tratar eventos, enviar requisições e preencher o HTML |
| [frontend-minimo/index.html](frontend-minimo/index.html) | Interface sem estilos |
| [frontend-tailwind/index.html](frontend-tailwind/index.html) | Interface com Tailwind pelo CDN |
| [sql/banco.sql](sql/banco.sql) | Criar o banco e a tabela |
| [sql/popular.sql](sql/popular.sql) | Inserir oito alunos fictícios |

## Como executar no Windows

É necessário ter PHP com a extensão `pdo_mysql` habilitada e o MySQL em execução, conforme o [guia de ambiente](../../../../apoio/ambiente-web1-windows/).

### 1. Configurar a conexão

Em `api/conexao.php`, ajuste:

```php
$dbname = 'crud_alunos';
$usuario = 'root';
$senha = 'SUA_SENHA';
$porta = 3306;
```

Substitua a senha somente na sua cópia local. A porta acima é a do **MySQL**.

### 2. Preparar o banco

Este exemplo usa o mesmo banco e a mesma tabela dos exemplos 1 e 2. Se já estão criados, aproveite-os e passe à etapa 3. Os alunos já cadastrados também aparecem nesta versão.

Para criar o banco, abra o CMD na pasta `exemplos/03-crud-api` e entre no MySQL:

```bat
mysql -u root -p
```

No console MySQL, execute:

```sql
SOURCE sql/banco.sql;
```

Para começar com dados fictícios, execute também:

```sql
SOURCE sql/popular.sql;
```

O script de população também pode ser executado em um banco já criado. Ele acrescenta oito registros e não apaga os existentes. Como os três exemplos compartilham os mesmos dados, execute apenas uma cópia desse script; repeti-lo acrescenta os alunos novamente.

Saia do console:

```sql
EXIT;
```

Se o MySQL usa outra porta, informe-a ao entrar no console. Por exemplo: `mysql -h 127.0.0.1 -P 3307 -u root -p`.

### 3. Iniciar o servidor PHP

No CMD, ainda na pasta `exemplos/03-crud-api`, execute:

```bat
php -S localhost:8000
```

Mantenha esse terminal aberto e acesse:

| Página | Endereço |
|---|---|
| Front-end mínimo | [http://localhost:8000/frontend-minimo/](http://localhost:8000/frontend-minimo/) |
| Front-end com Tailwind | [http://localhost:8000/frontend-tailwind/](http://localhost:8000/frontend-tailwind/) |
| Lista em JSON | [http://localhost:8000/api/alunos.php](http://localhost:8000/api/alunos.php) |

Abra as páginas por esses endereços, e não com duplo clique nos arquivos HTML. O mesmo servidor entrega o HTML, o JavaScript e a API; não é necessário iniciar um segundo servidor. Se a porta `8000` já estiver ocupada por outro exemplo, encerre o servidor anterior com `Ctrl+C`.

O Tailwind é carregado pela internet. A interface mínima e a API funcionam localmente sem esse carregamento.

### 4. Experimentar o CRUD

1. Preencha nome, e-mail, data de nascimento e telefone. Clique em **Salvar**.
2. Na lista, clique em **Ver detalhes** para consultar um aluno.
3. Clique em **Editar**: o formulário recebe os dados. Altere um campo e salve.
4. Use **Limpar / cancelar edição** para voltar ao cadastro de um novo aluno.
5. Clique em **Excluir** e confirme a remoção.
6. Abra a outra interface e clique em **Atualizar lista** para ver os mesmos registros.

## Contrato da API

Todas as operações usam `api/alunos.php`. O método HTTP escolhe a operação; o parâmetro `id` identifica o aluno.

| Operação | Método e endereço | Corpo enviado | Resposta de sucesso |
|---|---|---|---|
| Listar | `GET api/alunos.php` | Nenhum | `200` e um array de alunos |
| Ver um aluno | `GET api/alunos.php?id=1` | Nenhum | `200` e um objeto aluno |
| Cadastrar | `POST api/alunos.php` | JSON com os quatro campos | `201`, id gerado e mensagem |
| Editar | `PUT api/alunos.php?id=1` | JSON com os quatro campos | `200` e mensagem |
| Excluir | `DELETE api/alunos.php?id=1` | Nenhum | `200` e mensagem |

Substitua `1` pelo id de um aluno existente. O JSON enviado no cadastro e na edição tem este formato:

```json
{
    "nome": "Ana Souza",
    "email": "ana.souza@example.com",
    "data_nascimento": "2005-03-12",
    "telefone": "(11) 90000-0001"
}
```

O JavaScript usa `JSON.stringify(aluno)` para produzir o texto enviado e informa `Content-Type: application/json`. No PHP, o corpo é lido assim:

```php
$dados = json_decode(file_get_contents('php://input'), true);
```

`php://input` fornece o corpo da requisição. `json_decode(..., true)` transforma esse JSON em um array associativo. Aqui não usamos `$_POST` para ler os campos, porque o corpo contém JSON, e não um formulário no formato tradicional.

Na resposta, `json_encode()` transforma os dados PHP em JSON. No navegador, `resposta.json()` converte o JSON recebido em dados acessíveis pelo JavaScript.

A consulta de um id inexistente responde com `404`. Métodos não disponíveis respondem com `405`. O formulário pede os quatro campos com `required`; a API mantém o processamento direto, sem validações detalhadas dos campos.

## O percurso de um cadastro

1. O evento `submit` chama `salvarAluno`. `preventDefault()` impede o envio tradicional do formulário.
2. O JavaScript lê os campos e envia o JSON por **POST**.
3. O PHP lê o JSON e executa o **INSERT** usando PDO.
4. O PHP responde com status **201** e uma mensagem em JSON.
5. O JavaScript apresenta a mensagem e consulta a lista por **GET**.
6. O navegador atualiza as linhas da tabela sem recarregar a página inteira.

O PHP não gera o HTML da tabela neste exemplo. Ele fornece os dados; o JavaScript preenche a interface. A senha do MySQL fica em `api/conexao.php`, no lado servidor; o front-end conhece apenas o endereço da API.

## Onde observar no código

| Assunto | Trecho principal |
|---|---|
| Consultar e apresentar uma lista | `listarAlunos` e `mostrarLista` |
| Ler os campos e enviar JSON | `salvarAluno` |
| Consultar os detalhes | `verAluno` e `mostrarDetalhes` |
| Carregar os dados para edição | `editarAluno` e `preencherFormulario` |
| Enviar uma exclusão | `excluirAluno` |
| Ler a resposta e mostrar uma falha | `lerResposta` e `mostrarErro` |

O padrão de `fetch`, `.then` e `.catch` é o mesmo da [apostila de JavaScript](../../../04-javascript-dom/#7-chamando-apis). As funções nomeadas indicam o que acontece com cada resposta.

O elemento HTML `<template id="linha-aluno">` guarda o modelo de uma linha. `cloneNode(true)` copia esse conteúdo para cada aluno; `textContent` preenche as células. Os atributos `data-campo` identificam os espaços dos dados, e `data-acao` identifica os botões. O JavaScript guarda o id de cada aluno em `botao.dataset.id`.

Os dois arquivos HTML mantêm os mesmos ids e atributos usados pelo script. No front-end com Tailwind, as classes adicionam cores, espaçamentos e organização em colunas. Por isso, o mesmo JavaScript funciona nas duas apresentações.

Para acompanhar a comunicação, abra **F12 → Rede/Network**, escolha o filtro **Fetch/XHR** e faça um cadastro. Observe o método, o JSON enviado, o status e a resposta de `alunos.php`.

## Referências

- [PHP — php://input](https://www.php.net/manual/pt_BR/wrappers.php.php)
- [MDN — Fetch](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch)
- [MDN — template](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template)
- [Tailwind — Play CDN](https://tailwindcss.com/docs/installation/play-cdn)
