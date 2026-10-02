# CRUD com PHP: cadastro de alunos

Um sistema de informações precisa manter seus dados: cadastrar alunos, consultar uma turma, corrigir um e-mail ou excluir um registro. Essas operações formam um **CRUD**.

Esta apostila apresenta a conexão do PHP com o MySQL e o funcionamento de cada operação. Os exemplos usam uma tabela de alunos e trechos pequenos de PHP, HTML e SQL. A leitura pressupõe os fundamentos da [apostila de PHP](../05-php/).

## Índice

1. [O que é CRUD?](#1-o-que-é-crud)
2. [O caminho entre o usuário e o banco](#2-o-caminho-entre-o-usuário-e-o-banco)
3. [O mínimo de MySQL e SQL](#3-o-mínimo-de-mysql-e-sql)
4. [Conectando o PHP com PDO](#4-conectando-o-php-com-pdo)
5. [Create: cadastrar um aluno](#5-create-cadastrar-um-aluno)
6. [Read: consultar os alunos](#6-read-consultar-os-alunos)
7. [Update: alterar um aluno](#7-update-alterar-um-aluno)
8. [Delete: excluir um aluno](#8-delete-excluir-um-aluno)
9. [Organização dos dois exemplos](#9-organização-dos-dois-exemplos)
10. [Quadro de consulta rápida](#10-quadro-de-consulta-rápida)

## 1. O que é CRUD?

CRUD reúne as iniciais de quatro operações:

| Letra | Operação | No cadastro de alunos | Comando SQL |
|---|---|---|---|
| C | **Create** — criar | Cadastrar um aluno | `INSERT` |
| R | **Read** — ler ou consultar | Listar alunos ou consultar um aluno | `SELECT` |
| U | **Update** — atualizar | Alterar nome ou e-mail | `UPDATE` |
| D | **Delete** — excluir | Remover um aluno | `DELETE` |

Essas operações aparecem em sistemas escolares, lojas, bibliotecas e muitos outros sistemas. Os dados mudam, mas a necessidade de cadastrá-los, consultá-los e mantê-los atualizados permanece.

O banco de dados mantém as informações depois que a requisição termina. Uma variável PHP existe durante a execução do programa; um aluno gravado no MySQL pode ser consultado novamente em outra visita à página. Esse armazenamento duradouro é chamado de **persistência**.

CRUD descreve operações sobre os dados. Não exige um framework nem uma organização específica de pastas.

## 2. O caminho entre o usuário e o banco

O navegador apresenta a interface; o PHP executa no servidor e conversa com o banco.

| Parte | Responsabilidade |
|---|---|
| Usuário | Preenche campos e aciona links ou botões |
| Navegador — lado cliente / front-end | Apresenta o HTML e envia requisições HTTP |
| PHP — lado servidor / back-end | Recebe os dados, realiza o processamento e prepara a resposta |
| PDO — usado pelo PHP | Permite conectar ao banco e executar comandos SQL |
| MySQL — lado servidor | Armazena os registros e executa os comandos SQL recebidos |

Este é o fluxo de uma consulta:

```mermaid
sequenceDiagram
    actor U as Usuário
    box Lado cliente
        participant N as Navegador
    end
    box Lado servidor
        participant P as PHP com PDO
        participant B as MySQL
    end
    U->>N: Abre a listagem
    N->>P: Requisição HTTP GET
    P->>B: SELECT na tabela alunos
    B-->>P: Dados dos alunos
    P-->>N: Resposta HTTP com HTML
    N-->>U: Apresenta a lista
```

O navegador não envia SQL diretamente ao MySQL. Ele faz uma requisição HTTP ao servidor PHP; o PHP usa PDO para acessar o banco. A comunicação com o MySQL utiliza a conexão de banco de dados, não a requisição HTTP do navegador.

Após cadastrar, alterar ou excluir, o PHP pode responder com um **redirecionamento**. O navegador então faz outra requisição para carregar a listagem atualizada.

Mesmo quando tudo executa no computador do aluno, navegador, servidor PHP e MySQL continuam tendo funções diferentes.

## 3. O mínimo de MySQL e SQL

O cadastro utiliza um banco chamado `crud_alunos`, com uma tabela chamada `alunos`:

| Coluna | Conteúdo |
|---|---|
| `id` | Número que identifica cada aluno |
| `nome` | Nome do aluno |
| `email` | E-mail do aluno |
| `data_nascimento` | Data de nascimento do aluno |
| `telefone` | Telefone do aluno |

Uma **tabela** organiza dados em colunas e linhas. Cada linha, também chamada de **registro**, representa um aluno. O `id` permite indicar exatamente qual registro consultar, alterar ou excluir, mesmo quando dois alunos têm o mesmo nome.

**SQL** é a linguagem usada para dar instruções ao banco. Os comandos prontos a seguir apresentam as operações básicas e sua finalidade.

### Entrando no MySQL

Com o ambiente do [guia de Web 1](../../apoio/ambiente-web1-windows/) preparado, abra o **CMD** e execute:

```bat
mysql -u root -p
```

`-u root` indica o usuário. `-p` solicita a senha configurada na instalação. Depois de entrar, o prompt passa a mostrar `mysql>`.

Se o MySQL usa outra porta, indique-a com `-P` maiúsculo. Por exemplo, para a porta `3307`:

```bat
mysql -h 127.0.0.1 -P 3307 -u root -p
```

No console do MySQL, os comandos básicos são:

| Comando | Finalidade |
|---|---|
| `SHOW DATABASES;` | Listar os bancos existentes |
| `USE crud_alunos;` | Selecionar o banco para os comandos |
| `SHOW TABLES;` | Listar as tabelas do banco selecionado |
| `DESCRIBE alunos;` | Mostrar as colunas e os tipos da tabela |
| `SELECT * FROM alunos;` | Consultar os alunos cadastrados |
| `EXIT;` | Sair do console MySQL |

Use `;` para finalizar cada instrução SQL. Se aparecer `->` no console, o MySQL está aguardando a continuação da instrução.

### SQL pronto para criar o banco

O arquivo [banco.sql do exemplo 1](exemplos/01-crud-minimo/banco.sql) contém o SQL abaixo. Também é possível copiar o bloco para o console MySQL:

```sql
CREATE DATABASE crud_alunos;
USE crud_alunos;

CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(150),
    data_nascimento DATE,
    telefone VARCHAR(20)
);
```

- `CREATE DATABASE` cria o banco; `CREATE TABLE` cria a tabela.
- `INT` representa um número inteiro.
- `AUTO_INCREMENT` gera o próximo número de identificação automaticamente.
- `PRIMARY KEY` define a coluna que identifica cada registro.
- `VARCHAR(100)` guarda texto com até 100 caracteres.
- `DATE` guarda uma data no formato `AAAA-MM-DD`, como `2006-04-15`.
- O telefone é armazenado como texto (`VARCHAR(20)`) para preservar zeros iniciais e permitir sinais como `+` e `-`.

Crie esse banco uma vez. A tabela começa vazia; o formulário de cadastro permite inserir os alunos.

Para executar o arquivo `banco.sql`, abra o CMD na pasta dele, entre no MySQL e execute:

```sql
SOURCE banco.sql;
```

`SOURCE` é um comando do cliente MySQL que executa as instruções de um arquivo. [MySQL — Comandos do cliente](https://dev.mysql.com/doc/refman/8.4/en/mysql-commands.html).

### Quatro comandos para reconhecer

```sql
INSERT INTO alunos (nome, email, data_nascimento, telefone)
VALUES ('Ana', 'ana@example.com', '2006-04-15', '81999990000');
SELECT * FROM alunos;
UPDATE alunos SET nome = 'Ana Silva' WHERE id = 1;
DELETE FROM alunos WHERE id = 1;
```

São demonstrações independentes de cadastro, consulta, alteração e exclusão. `*` significa todas as colunas. `WHERE id = 1` limita a operação ao aluno de identificação `1`.

**O `WHERE` é essencial para escolher o registro na alteração e na exclusão.** Sem ele, `UPDATE` e `DELETE` atuam sobre todas as linhas da tabela. Nos exemplos, o `id` vem do link ou do formulário.

## 4. Conectando o PHP com PDO

**PDO** é um recurso do PHP para acessar bancos de dados. A conexão com MySQL utiliza a extensão `pdo_mysql`, indicada no guia de ambiente.

O arquivo reutilizável [conexao.php](exemplos/01-crud-minimo/conexao.php) reúne as configurações e a criação da conexão:

```php
<?php
$dbname = 'crud_alunos';
$usuario = 'root';
$senha = 'SUA_SENHA';
$porta = 3306;

$pdo = new PDO(
    "mysql:host=127.0.0.1;port=$porta;dbname=$dbname;charset=utf8mb4",
    $usuario,
    $senha
);
```

| Parte | Significado |
|---|---|
| `mysql` | Tipo de banco utilizado |
| `host=127.0.0.1` | MySQL no próprio computador, usando a porta configurada |
| `$dbname` | Nome do banco da conexão |
| `$usuario` | Usuário do MySQL usado no ambiente local |
| `$senha` | Senha local desse usuário |
| `$porta` | Porta do MySQL; normalmente `3306` |
| `charset=utf8mb4` | Codificação da conexão, para trabalhar com textos e acentos |

Para configurar a conexão, altere os valores das quatro variáveis. As aspas duplas permitem inserir `$porta` e `$dbname` no texto da conexão. Substitua `SUA_SENHA` pela senha do MySQL e guarde a senha real somente na sua cópia local.

O endereço `127.0.0.1` mantém a conexão pela porta indicada em `$porta`, tanto no Windows quanto no Linux. Essa é a porta do **MySQL**; a porta `8000` dos comandos de execução pertence ao **servidor PHP**.

`new PDO(...)` cria o objeto que representa a conexão, guardado em `$pdo`. A conexão é encerrada automaticamente quando o script termina. [Manual do PHP — Conexões PDO](https://www.php.net/manual/pt_BR/pdo.connections.php).

Em uma página na mesma pasta, use:

```php
require 'conexao.php';
```

Nos trechos a seguir, considere que essa linha é executada antes de acessar `$pdo`.

### Como ler os comandos PDO

```php
$comando = $pdo->prepare(
    'INSERT INTO alunos (nome, email, data_nascimento, telefone) VALUES (?, ?, ?, ?)'
);
$comando->execute(['Ana', 'ana@example.com', '2006-04-15', '81999990000']);
```

O símbolo `->` chama uma operação do objeto. `prepare()` prepara o SQL; cada `?` reserva o lugar de um valor. `execute()` executa o comando com os valores do array, **na mesma ordem dos `?`**.

Assim, nome, e-mail, data de nascimento e telefone são fornecidos separadamente do texto SQL. Não é necessário montar o comando juntando o conteúdo dos campos dentro de aspas. [Manual do PHP — prepare](https://www.php.net/manual/pt_BR/pdo.prepare.php) e [execute](https://www.php.net/manual/pt_BR/pdostatement.execute.php).

## 5. Create: cadastrar um aluno

Cadastrar significa acrescentar uma linha à tabela. O banco gera o `id`; o formulário envia nome, e-mail, data de nascimento e telefone.

### Formulário

```html
<form method="post">
    Nome: <input name="nome">
    E-mail: <input name="email">
    Data de nascimento: <input type="date" name="data_nascimento">
    Telefone: <input type="tel" name="telefone">
    <button>Salvar</button>
</form>
```

Sem `action`, o formulário envia os dados para a própria URL. Os atributos `name` definem as chaves que o PHP lê em `$_POST`.

O campo `type="date"` envia a data no formato `AAAA-MM-DD`, usado pelo MySQL. O campo `type="tel"` permite digitar o telefone como texto.

### Gravação

```php
$comando = $pdo->prepare(
    'INSERT INTO alunos (nome, email, data_nascimento, telefone) VALUES (?, ?, ?, ?)'
);
$comando->execute([$_POST['nome'], $_POST['email'], $_POST['data_nascimento'], $_POST['telefone']]);
```

`INSERT INTO alunos` indica a tabela. `(nome, email, data_nascimento, telefone)` indica as colunas preenchidas, e `VALUES (?, ?, ?, ?)` indica os quatro valores inseridos.

### Quando o formulário e o processamento ficam no mesmo arquivo

No [create.php do exemplo 1](exemplos/01-crud-minimo/create.php), a mesma página mostra o formulário e recebe o envio. Antes do HTML, fica a parte de processamento:

```php
if ($_POST) {
    $comando = $pdo->prepare(
        'INSERT INTO alunos (nome, email, data_nascimento, telefone) VALUES (?, ?, ?, ?)'
    );
    $comando->execute([$_POST['nome'], $_POST['email'], $_POST['data_nascimento'], $_POST['telefone']]);
    header('Location: index.php', true, 303);
    exit;
}
```

Nesse formulário, `if ($_POST)` distingue a abertura da página do envio dos campos. O `header()` redireciona para a listagem e `exit` encerra a execução. Esse processamento fica antes do HTML porque o redirecionamento precisa ser enviado antes da saída da página.

### Fluxo do cadastro

1. O usuário abre `create.php`; o navegador envia **GET** e recebe o formulário HTML.
2. Ao clicar em Salvar, o navegador envia **POST** com nome, e-mail, data de nascimento e telefone.
3. No servidor, o PHP lê `$_POST` e usa PDO para executar **INSERT** no MySQL.
4. O PHP responde com **303**; o navegador faz um novo **GET** para `index.php` e recebe a listagem atualizada.

## 6. Read: consultar os alunos

Consultar pode significar listar todos os alunos ou buscar apenas um. O SQL utilizado é `SELECT`.

### Listar todos

```php
$consulta = $pdo->query('SELECT * FROM alunos');
$alunos = $consulta->fetchAll(PDO::FETCH_ASSOC);
```

`query()` executa diretamente esse SQL fixo. `fetchAll()` devolve as linhas encontradas. `PDO::FETCH_ASSOC` faz cada linha ser um array associativo, com as chaves `id`, `nome`, `email`, `data_nascimento` e `telefone`.

O PHP pode percorrer os dados e gerar uma tabela, como no [index.php do exemplo 1](exemplos/01-crud-minimo/index.php):

```php
<table>
    <tr>
        <th>ID</th><th>Nome</th><th>E-mail</th><th>Data de nascimento</th><th>Telefone</th>
    </tr>
    <?php foreach ($alunos as $aluno): ?>
        <tr>
            <td><?= $aluno['id'] ?></td>
            <td><?= $aluno['nome'] ?></td>
            <td><?= $aluno['email'] ?></td>
            <td><?= $aluno['data_nascimento'] ?></td>
            <td><?= $aluno['telefone'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
```

Cada repetição cria uma linha de HTML. O navegador recebe a tabela pronta, não o `foreach` nem os arrays PHP. [Manual do PHP — fetchAll](https://www.php.net/manual/pt_BR/pdostatement.fetchall.php).

### Consultar apenas um aluno

Na listagem, o link **Ver detalhes** envia o `id` do aluno para `show.php`:

```php
<a href="show.php?id=<?= $aluno['id'] ?>">Ver detalhes</a>
```

Em uma URL como `show.php?id=3`, o PHP recebe `3` em `$_GET['id']`. O arquivo [show.php](exemplos/01-crud-minimo/show.php) consulta esse registro:

```php
$consulta = $pdo->prepare('SELECT * FROM alunos WHERE id = ?');
$consulta->execute([$_GET['id']]);
$aluno = $consulta->fetch(PDO::FETCH_ASSOC);
```

`fetch()` busca uma linha; `fetchAll()` busca todas as linhas do resultado. A página usa `$aluno` para apresentar os dados em uma tela separada:

```php
<h1>Detalhes do aluno</h1>
<p>Nome: <?= $aluno['nome'] ?></p>
<p>E-mail: <?= $aluno['email'] ?></p>
```

O exemplo completo também apresenta `id`, data de nascimento e telefone, além de links para editar, excluir e voltar à listagem. A mesma consulta por `id` preenche o formulário de edição em `update.php`.

### Fluxo da consulta

1. O usuário abre a listagem ou seleciona um aluno; o navegador envia **GET**.
2. O PHP executa **SELECT** no MySQL usando PDO.
3. O MySQL devolve os dados ao PHP, que prepara o HTML.
4. O servidor responde ao navegador, que apresenta a lista ou os dados do aluno.

## 7. Update: alterar um aluno

Alterar um aluno envolve dois momentos: buscar os dados atuais e enviar os novos valores.

Na listagem, dentro do `foreach`, o link pode carregar o `id`:

```php
<a href="update.php?id=<?= $aluno['id'] ?>">Editar</a>
```

Depois do `SELECT` por `id` mostrado na seção anterior, o formulário usa os dados encontrados:

```php
<form method="post">
    <input type="hidden" name="id" value="<?= $aluno['id'] ?>">
    Nome: <input name="nome" value="<?= $aluno['nome'] ?>">
    E-mail: <input name="email" value="<?= $aluno['email'] ?>">
    Data de nascimento: <input type="date" name="data_nascimento" value="<?= $aluno['data_nascimento'] ?>">
    Telefone: <input type="tel" name="telefone" value="<?= $aluno['telefone'] ?>">
    <button>Salvar alterações</button>
</form>
```

`value` preenche os campos. O campo `hidden` envia o `id` junto com os demais dados, sem apresentá-lo como um campo de digitação.

O processamento do envio usa:

```php
$comando = $pdo->prepare(
    'UPDATE alunos SET nome = ?, email = ?, data_nascimento = ?, telefone = ? WHERE id = ?'
);
$comando->execute([
    $_POST['nome'], $_POST['email'], $_POST['data_nascimento'], $_POST['telefone'], $_POST['id']
]);
```

`SET` define os novos valores das colunas. `WHERE id = ?` escolhe o aluno da alteração. Observe a ordem: nome, e-mail, data de nascimento, telefone e, por último, `id`.

No [update.php do exemplo 1](exemplos/01-crud-minimo/update.php), o bloco `if ($_POST)` fica antes da consulta e do formulário. Após atualizar, o PHP redireciona para `index.php`, como no cadastro. A alteração mantém o mesmo `id`; ela não cria outro aluno.

### Fluxo da alteração

1. O usuário clica em Editar; o navegador envia **GET** com o `id`.
2. O PHP executa **SELECT**, monta o formulário preenchido e o envia ao navegador.
3. O usuário altera os campos; o navegador envia **POST** com `id`, nome, e-mail, data de nascimento e telefone.
4. O PHP executa **UPDATE**, responde com **303**, e o navegador abre a listagem por **GET**.

## 8. Delete: excluir um aluno

Excluir significa remover uma linha da tabela. O PHP precisa receber o `id` do aluno escolhido.

O link de exclusão aparece na listagem ([index.php](exemplos/01-crud-minimo/index.php)) e na tela de detalhes ([show.php](exemplos/01-crud-minimo/show.php)). Nos dois casos, ele envia o `id` para `delete.php`:

```php
<a href="delete.php?id=<?= $aluno['id'] ?>">Excluir</a>
```

O arquivo [delete.php](exemplos/01-crud-minimo/delete.php) contém apenas o processamento:

```php
<?php
require 'conexao.php';

$comando = $pdo->prepare('DELETE FROM alunos WHERE id = ?');
$comando->execute([$_GET['id']]);
header('Location: index.php', true, 303);
exit;
```

O PHP recebe o `id` pela URL, executa a exclusão e redireciona para `index.php`. O arquivo não apresenta HTML: sua resposta é o redirecionamento. A listagem permanece responsável por consultar e apresentar os alunos.

O link faz uma requisição **GET**; `DELETE` é o comando **SQL** executado pelo PHP. Usar o link dessa forma é uma simplificação didática. Em aplicações reais, prefira enviar a exclusão por um formulário com **POST**, pois a operação modifica os dados.

No [exemplo 2](exemplos/02-crud-templates/php/alunos/index.php), um formulário com um campo `hidden` envia o `id` por **POST** para [delete_action.php](exemplos/02-crud-templates/php/alunos/delete_action.php). A action lê `$_POST['id']`, executa o mesmo SQL e redireciona para a listagem.

### Fluxo da exclusão

1. O usuário escolhe Excluir na listagem ou nos detalhes. No exemplo 1, o link envia **GET** para `delete.php`; no exemplo 2, o formulário envia **POST** para `delete_action.php`. Ambos enviam o `id`.
2. O PHP usa PDO para executar **DELETE** com o `id` recebido.
3. O MySQL remove a linha, e o PHP responde ao navegador com um redirecionamento **303**.
4. O navegador faz **GET** para a listagem; o PHP consulta os alunos restantes e devolve o HTML atualizado.

## 9. Organização dos dois exemplos

Esta seção apresenta duas formas de organizar um CRUD: páginas simples com processamento integrado e uma estrutura com templates e actions. Ambas utilizam as colunas `id`, `nome`, `email`, `data_nascimento` e `telefone`, com as mesmas operações SQL.

### Exemplo 1 — CRUD mínimo

[Abrir a pasta do exemplo 1](exemplos/01-crud-minimo/).

Os arquivos ficam na mesma pasta:

| Arquivo | Responsabilidade |
|---|---|
| [index.php](exemplos/01-crud-minimo/index.php) | Listar alunos e oferecer links para cadastrar, ver detalhes, editar e excluir |
| [show.php](exemplos/01-crud-minimo/show.php) | Consultar e apresentar um aluno, com links para editar, excluir e voltar |
| [create.php](exemplos/01-crud-minimo/create.php) | Mostrar o formulário e processar o cadastro no mesmo arquivo |
| [update.php](exemplos/01-crud-minimo/update.php) | Buscar o aluno, mostrar o formulário preenchido e processar a alteração |
| [delete.php](exemplos/01-crud-minimo/delete.php) | Excluir o aluno indicado pelo id e redirecionar para a listagem |
| [conexao.php](exemplos/01-crud-minimo/conexao.php) | Criar a conexão PDO reutilizada pelas páginas |
| [banco.sql](exemplos/01-crud-minimo/banco.sql) | Criar o banco e a tabela |

O HTML simples mantém o foco no percurso dos dados. Cadastro e edição reúnem formulário e processamento na mesma página; a exclusão utiliza um arquivo próprio.

#### Como executar

1. Em `conexao.php`, configure `$dbname`, `$usuario`, `$senha` e `$porta` para o seu MySQL.
2. Abra o CMD na pasta `exemplos/01-crud-minimo` e entre no MySQL:

   ```bat
   mysql -u root -p
   ```

   Crie o banco e saia do console:

   ```sql
   SOURCE banco.sql;
   EXIT;
   ```

   Se já criou o banco com a estrutura da seção 3, não precisa executar `banco.sql` novamente.

3. Nesse mesmo CMD, inicie o servidor PHP:

   ```bat
   php -S localhost:8000
   ```

4. Abra [http://localhost:8000](http://localhost:8000). Clique em **Cadastrar aluno**, preencha os quatro campos e salve. Na listagem, use **Ver detalhes** para abrir a tela do aluno, **Editar** para alterar o registro e **Excluir** para removê-lo. A tela de detalhes também oferece os links de edição e exclusão.

O MySQL deve permanecer em execução durante o uso do exemplo.

### Exemplo 2 — CRUD com templates e actions

[Abrir a pasta do exemplo 2](exemplos/02-crud-templates/).

Este exemplo realiza as mesmas operações do CRUD mínimo, com arquivos separados para apresentação, processamento e elementos comuns das páginas. A home apresenta o exemplo, e o menu contém os links **Home** e **Alunos**. As duas versões usam o mesmo banco: um aluno cadastrado em uma delas também aparece na outra.

Uma **view** apresenta o formulário ou os dados. Uma **action** é o arquivo PHP que recebe uma operação e a executa. Separar esses arquivos permite localizar com facilidade o HTML e o processamento.

| Caminho | Responsabilidade |
|---|---|
| [php/index.php](exemplos/02-crud-templates/php/index.php) | Home com uma breve apresentação do exemplo |
| [php/conexao.php](exemplos/02-crud-templates/php/conexao.php) | Conexão PDO compartilhada |
| [php/templates/cabecalho.php](exemplos/02-crud-templates/php/templates/cabecalho.php) | Início da página e carregamento do Tailwind pelo CDN |
| [php/templates/menu.php](exemplos/02-crud-templates/php/templates/menu.php) | Links Home e Alunos |
| [php/templates/rodape.php](exemplos/02-crud-templates/php/templates/rodape.php) | Rodapé e fechamento da página |
| [php/alunos/index.php](exemplos/02-crud-templates/php/alunos/index.php) | Listagem dos alunos |
| [php/alunos/show.php](exemplos/02-crud-templates/php/alunos/show.php) | Detalhes de um aluno, com edição e exclusão |
| [php/alunos/create_view.php](exemplos/02-crud-templates/php/alunos/create_view.php) | Formulário de cadastro |
| [php/alunos/create_action.php](exemplos/02-crud-templates/php/alunos/create_action.php) | Executar o INSERT e redirecionar |
| [php/alunos/update_view.php](exemplos/02-crud-templates/php/alunos/update_view.php) | Consultar o aluno e apresentar o formulário de edição |
| [php/alunos/update_action.php](exemplos/02-crud-templates/php/alunos/update_action.php) | Executar o UPDATE e redirecionar |
| [php/alunos/delete_action.php](exemplos/02-crud-templates/php/alunos/delete_action.php) | Receber o id por POST, executar o DELETE e redirecionar |
| [sql/banco.sql](exemplos/02-crud-templates/sql/banco.sql) | Script de criação do banco e da tabela |
| [css/](exemplos/02-crud-templates/css/) e [js/](exemplos/02-crud-templates/js/) | Pastas reservadas para estilos e scripts próprios |

As páginas usam `include` para reaproveitar cabeçalho, menu e rodapé. Em uma página dentro de `php/alunos/`, por exemplo:

```php
<?php include '../templates/cabecalho.php'; ?>
<?php include '../templates/menu.php'; ?>

<h1>Alunos</h1>

<?php include '../templates/rodape.php'; ?>
```

`../` sobe uma pasta. Nessa mesma localização, `require '../conexao.php';` inclui a conexão. Na home, em `php/`, os caminhos dos templates começam por `templates/`.

Os links do menu começam com `/`, como `/alunos/index.php`. Essa barra indica a raiz do servidor, que neste exemplo é a pasta `php`. Assim, o mesmo menu funciona na home e nas páginas de alunos.

Para enviar um formulário a outro arquivo, basta indicar a action:

```html
<form action="create_action.php" method="post">
    Nome: <input name="nome">
    E-mail: <input name="email">
    Data de nascimento: <input type="date" name="data_nascimento">
    Telefone: <input type="tel" name="telefone">
    <button>Salvar</button>
</form>
```

As actions fazem o processamento e o redirecionamento. As páginas incluem os templates depois dos comandos PHP que preparam cabeçalhos HTTP.

No cadastro, o percurso é: abrir `create_view.php`, preencher o formulário, enviar os dados por POST para `create_action.php` e voltar à listagem após o INSERT. A edição segue a mesma divisão entre `update_view.php` e `update_action.php`. A listagem e os detalhes contêm pequenos formulários que enviam a exclusão para `delete_action.php`.

O Tailwind via CDN aplica poucas classes de espaçamento, cores e apresentação dos botões. Por exemplo, `p-4` adiciona espaçamento interno e `text-white` deixa o texto branco. O carregamento dos estilos exige internet. As pastas `css` e `js` ficam reservadas; o CRUD não utiliza arquivos próprios nessas pastas. [Tailwind — Play CDN](https://tailwindcss.com/docs/installation/play-cdn).

#### Como executar

1. Em `php/conexao.php`, configure `$dbname`, `$usuario`, `$senha` e `$porta` para o seu MySQL.
2. Se o banco `crud_alunos` já contém a tabela da seção 3, use esse banco. Caso contrário, abra o CMD na pasta `exemplos/02-crud-templates` e entre no MySQL:

   ```bat
   mysql -u root -p
   ```

   Execute o script e saia do console:

   ```sql
   SOURCE sql/banco.sql;
   EXIT;
   ```

3. No CMD, a partir da pasta `exemplos/02-crud-templates`, entre em `php` e inicie o servidor:

   ```bat
   cd php
   php -S localhost:8000
   ```

4. Abra [http://localhost:8000](http://localhost:8000). No menu, clique em **Alunos**. Cadastre um aluno preenchendo os quatro campos, abra seus detalhes, altere os dados e use **Excluir** para removê-lo.

Mantenha o MySQL em execução. Se outro servidor PHP já ocupa a porta `8000`, encerre-o com `Ctrl+C` no terminal em que está em execução.

## 10. Quadro de consulta rápida

| Preciso… | Uso… |
|---|---|
| Abrir o console MySQL | `mysql -u root -p` |
| Selecionar o banco | `USE crud_alunos;` |
| Carregar a conexão no PHP | `require 'conexao.php';` |
| Executar uma consulta SQL fixa | `$pdo->query(...)` |
| Executar SQL com valores do formulário ou da URL | `prepare()` e `execute([...])` |
| Obter uma lista de registros | `fetchAll(PDO::FETCH_ASSOC)` |
| Obter um registro | `fetch(PDO::FETCH_ASSOC)` |
| Apresentar uma lista em HTML | `foreach` |
| Escolher qual aluno alterar ou excluir | `WHERE id = ?` |
| Voltar à listagem após uma operação | `header('Location: index.php', true, 303);` seguido de `exit;` |

Para executar as páginas PHP, abra o CMD na pasta que contém a página inicial e use:

```bat
php -S localhost:8000
```

Abra [http://localhost:8000](http://localhost:8000) no navegador. No exemplo mínimo, inicie o servidor na pasta do exemplo. Na organização com templates, a pasta inicial é `php/`. O MySQL também precisa estar em execução: iniciar o servidor PHP não inicia o banco.

### O que você precisa guardar

- CRUD reúne cadastro, consulta, alteração e exclusão de dados.
- O navegador envia requisições HTTP; o PHP usa PDO para executar SQL no MySQL.
- O `id` identifica o aluno nas consultas, alterações e exclusões.
- `INSERT`, `SELECT`, `UPDATE` e `DELETE` realizam as quatro operações no banco.
- O PHP transforma o resultado da consulta em HTML para o navegador apresentar.
- Separar formulários, actions e templates muda a organização dos arquivos, mas as operações sobre os dados continuam as mesmas.

## Referências

- [PHP — Conexões PDO](https://www.php.net/manual/pt_BR/pdo.connections.php)
- [PHP — Parâmetros da conexão PDO com MySQL](https://www.php.net/manual/pt_BR/ref.pdo-mysql.connection.php)
- [PHP — prepare](https://www.php.net/manual/pt_BR/pdo.prepare.php) e [execute](https://www.php.net/manual/pt_BR/pdostatement.execute.php)
- [PHP — fetch](https://www.php.net/manual/pt_BR/pdostatement.fetch.php) e [fetchAll](https://www.php.net/manual/pt_BR/pdostatement.fetchall.php)
- [MySQL — Comandos do cliente](https://dev.mysql.com/doc/refman/8.4/en/mysql-commands.html)
- [MySQL — Criação de tabelas](https://dev.mysql.com/doc/refman/8.4/en/creating-tables.html)
- [MySQL — INSERT](https://dev.mysql.com/doc/refman/8.4/en/insert.html), [UPDATE](https://dev.mysql.com/doc/refman/8.4/en/update.html) e [DELETE](https://dev.mysql.com/doc/refman/8.4/en/delete.html)
- [Tailwind — Play CDN](https://tailwindcss.com/docs/installation/play-cdn)
