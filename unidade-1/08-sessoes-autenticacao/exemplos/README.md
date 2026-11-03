# Construção guiada: autenticação no CRUD de produtos

Este guia acrescenta cadastro de usuários, login, painel e logout ao [CRUD mínimo de produtos](../../06-crud-php/exemplos/tutorial-crud-produtos-minimalista/). As páginas e as actions do CRUD passam a exigir um usuário autenticado.

Crie os arquivos na sua cópia do projeto, a partir dos códigos de cada passo. Todos ficam na mesma pasta dos produtos e de `conexao.php`.

## 1. Preparar o projeto existente

Conclua o tutorial de produtos antes de acrescentar o login. O projeto utiliza o banco `crud_armazem`, a tabela `produtos` e a conexão PDO guardada em `$pdo`.

No CMD, entre na pasta do seu projeto e abra o editor:

```bat
cd seu_nome
code .
```

Substitua `seu_nome` pelo caminho da sua pasta. Confira as configurações de banco, usuário, senha e porta em `conexao.php`. Mantenha esse arquivo como no projeto anterior.

## 2. Criar a tabela de usuários

Crie `banco_usuarios.sql`:

```sql
USE crud_armazem;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    senha VARCHAR(255)
);
```

O banco já existe; este SQL acrescenta apenas a tabela `usuarios`. O e-mail identifica a conta no login. `UNIQUE` impede que duas contas usem o mesmo e-mail. A coluna `senha` guarda o hash produzido pelo PHP.

Abra o CMD na pasta do projeto e entre no MySQL:

```bat
mysql -u root -p
```

Informe a senha do seu MySQL. No console, execute o arquivo uma vez:

```sql
SOURCE banco_usuarios.sql;
EXIT;
```

## 3. Criar o formulário de cadastro da conta

Crie `cadastro_usuario_form.php`:

```html
<h1>Cadastrar usuário</h1>
<form method="post" action="cadastro_usuario_action.php">
    Nome: <input name="nome" required><br>
    E-mail: <input type="email" name="email" required><br>
    Senha: <input type="password" name="senha" required><br>
    <button>Cadastrar</button>
</form>
<a href="login_form.php">Já tenho uma conta</a>
```

O formulário envia os três campos por POST. O campo de senha oculta a digitação na tela, mas o tratamento do valor é feito no servidor.

## 4. Gravar a conta com o hash da senha

Crie `cadastro_usuario_action.php`:

```php
<?php
require 'conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$comando = $pdo->prepare(
    'INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)'
);
$comando->execute([$nome, $email, $senha]);

header('Location: login_form.php');
exit;
```

O fluxo é o mesmo de um cadastro de produto. A diferença é a chamada a `password_hash()` antes do INSERT. Depois da gravação, o navegador abre o formulário de login; a conta ainda não está autenticada.

## 5. Criar o formulário de login

Crie `login_form.php`:

```html
<h1>Entrar</h1>
<form method="post" action="login_action.php">
    E-mail: <input type="email" name="email" required><br>
    Senha: <input type="password" name="senha" required><br>
    <button>Entrar</button>
</form>
<a href="cadastro_usuario_form.php">Criar uma conta</a>
```

O formulário pede as credenciais. O `id` da conta é obtido pelo PHP a partir da consulta no banco, depois da verificação da senha.

## 6. Consultar a conta e autenticar

Crie `login_action.php`:

```php
<?php
session_start();
require 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$consulta = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
$consulta->execute([$email]);
$usuario = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$usuario || !password_verify($senha, $usuario['senha'])) {
    http_response_code(401);
    exit('E-mail ou senha incorretos.');
}

session_regenerate_id(true);
$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];

header('Location: painel.php');
exit;
```

Há uma verificação central: a conta precisa existir e a senha precisa corresponder ao hash. O operador `||` significa **ou**. Se a consulta não encontra a conta, a primeira condição já é verdadeira e a segunda não é executada.

Quando há falha, o PHP responde com status 401 e encerra a execução. Quando há sucesso, troca o identificador da sessão, guarda o id e o nome e redireciona para o painel.

## 7. Criar a verificação compartilhada

Crie `verificar_login.php`:

```php
<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login_form.php');
    exit;
}
```

Esse arquivo retoma a sessão e verifica a identificação. Sem `usuario_id`, o navegador volta ao login. A instrução `exit` impede a continuação do arquivo que incluiu a verificação.

## 8. Criar o painel protegido

Crie `painel.php`:

```php
<?php
require 'verificar_login.php';
?>

<h1>Painel</h1>
<p>Olá, <?= $_SESSION['usuario_nome'] ?>.</p>
<a href="index_produto.php">Abrir o cadastro de produtos</a>

<form method="post" action="logout.php">
    <button>Sair</button>
</form>
```

O `require` fica antes do HTML. Ele já inicia a sessão; não é necessário chamar `session_start()` novamente no painel.

O nome apresentado vem da conta consultada no login e guardada na sessão. O link abre a listagem de produtos. O botão Sair envia uma requisição POST para o arquivo do próximo passo.

## 9. Encerrar a sessão

Crie `logout.php`:

```php
<?php
session_start();

$_SESSION = [];
session_destroy();

header('Location: login_form.php');
exit;
```

O logout limpa a identificação e redireciona para o login. A conta e os produtos permanecem no MySQL.

## 10. Aplicar a proteção ao CRUD

Inclua esta linha no início de cada arquivo PHP do CRUD que exige login, dentro do bloco `<?php` e antes de qualquer outra instrução ou HTML:

```php
require 'verificar_login.php';
```

| Arquivo existente | O que passa a exigir login |
|---|---|
| `index_produto.php` | Consultar a listagem |
| `show_produto.php` | Consultar um produto |
| `create_produto_form.php` | Abrir o formulário de cadastro |
| `create_produto_action.php` | Inserir um produto |
| `update_produto_form.php` | Abrir o formulário preenchido |
| `update_produto_action.php` | Gravar a alteração |
| `delete_produto_action.php` | Excluir um produto |

Nos arquivos com conexão, o início fica assim, seguido pelo código que já existe:

```php
<?php
require 'verificar_login.php';
require 'conexao.php';
```

O formulário de cadastro de produtos, que antes continha somente HTML, começa assim:

```php
<?php
require 'verificar_login.php';
?>

<form method="post" action="create_produto_action.php">
```

Mantenha os campos e o restante do formulário após essa abertura. O novo bloco apenas verifica o login antes de apresentar a página.

Adicione estes elementos ao HTML de `index_produto.php`, depois do processamento PHP e antes da listagem:

```html
<a href="painel.php">Voltar ao painel</a>
<form method="post" action="logout.php">
    <button>Sair</button>
</form>
```

Cadastro de conta e login continuam acessíveis sem autenticação. A conexão e o arquivo de verificação são reutilizados pelos arquivos que precisam deles; não acrescente a verificação de login dentro de `conexao.php`.

## 11. Executar e testar

Com o MySQL em execução, abra o CMD na pasta do projeto e inicie o servidor:

```bat
php -S localhost:8000
```

Use estes endereços:

| Tela | Endereço |
|---|---|
| Criar uma conta | [http://localhost:8000/cadastro_usuario_form.php](http://localhost:8000/cadastro_usuario_form.php) |
| Login | [http://localhost:8000/login_form.php](http://localhost:8000/login_form.php) |
| Painel protegido | [http://localhost:8000/painel.php](http://localhost:8000/painel.php) |
| Produtos | [http://localhost:8000/index_produto.php](http://localhost:8000/index_produto.php) |

Faça os testes na ordem:

1. Antes de entrar, tente abrir `painel.php` e `index_produto.php`. Ambos redirecionam para o login.
2. Cadastre uma conta fictícia e escolha uma senha de teste. Use outro e-mail para cada nova conta.
3. Confira no MySQL com `SELECT id, nome, email, senha FROM usuarios;`: a coluna `senha` contém um hash, não a senha digitada.
4. Informe uma senha incorreta no login. A resposta apresenta a mensagem de falha. Volte pelo navegador e tente novamente com a senha correta.
5. Após entrar, confira o nome no painel e abra os produtos. Cadastre, consulte, edite e exclua um produto.
6. Abra outra aba no mesmo perfil do navegador e acesse o painel: a sessão normalmente é compartilhada.
7. Em uma janela anônima separada, tente abrir a listagem e `create_produto_action.php`. O acesso direto à action também redireciona para o login, antes de acessar os campos ou executar o INSERT.
8. Na janela autenticada, clique em Sair. Tente abrir novamente o painel e a listagem pelos endereços: o login é solicitado.
9. Confira no MySQL que a conta e os produtos não excluídos continuam cadastrados.

## Arquivos acrescentados durante o guia

| Arquivo criado pelo aluno | Responsabilidade |
|---|---|
| `banco_usuarios.sql` | Acrescentar a tabela de usuários |
| `cadastro_usuario_form.php` | Solicitar os dados da conta |
| `cadastro_usuario_action.php` | Gravar a conta e o hash |
| `login_form.php` | Solicitar e-mail e senha |
| `login_action.php` | Verificar as credenciais e identificar o usuário na sessão |
| `verificar_login.php` | Restringir o acesso |
| `painel.php` | Apresentar o usuário autenticado e o acesso ao CRUD |
| `logout.php` | Encerrar a identificação |

Os arquivos do CRUD de produtos recebem a inclusão da verificação; suas operações de cadastro, consulta, alteração e exclusão continuam as mesmas.

[Voltar à apostila de sessões e autenticação](../README.md).
