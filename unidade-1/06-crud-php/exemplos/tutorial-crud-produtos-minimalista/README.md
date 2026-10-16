# Tutorial passo a passo: CRUD de produtos com PHP

Este tutorial apresenta a construção de um cadastro de produtos desde a criação da pasta e do banco até a navegação entre as telas. O HTML apresenta os formulários; o PHP recebe os dados e acessa o MySQL usando PDO.

| Operação | O que faz | SQL |
|---|---|---|
| Create | Cadastra um produto | `INSERT` |
| Read | Consulta um produto ou a lista | `SELECT` |
| Update | Altera um produto | `UPDATE` |
| Delete | Exclui um produto | `DELETE` |

É necessário ter PHP com a extensão `pdo_mysql`, MySQL em execução e um editor como o VS Code. A preparação dessas ferramentas está no [guia de ambiente](../../../../apoio/ambiente-web1-windows/).

Todos os arquivos ficam na mesma pasta. Salve-os como UTF-8 no editor. Os arquivos disponíveis aqui contêm a versão final; ao construir o projeto passo a passo, acrescente os redirecionamentos somente no passo 20.

## 1. Criar a pasta do projeto

Abra o **CMD** em um local destinado aos seus projetos e execute:

```bat
mkdir seu_nome
cd seu_nome
code .
```

Substitua `seu_nome` pelo nome da sua pasta. `mkdir` cria a pasta, `cd` entra nela e `code .` abre a pasta atual no VS Code. Crie os próximos arquivos dentro dela.

## 2. Escrever o SQL do banco

Crie o arquivo [banco.sql](banco.sql):

```sql
CREATE DATABASE crud_armazem;
USE crud_armazem;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    descricao VARCHAR(200),
    data_validade DATE,
    quantidade INTEGER,
    valor float
);
```

`CREATE DATABASE` cria o banco. `USE` seleciona esse banco, e `CREATE TABLE` cria a tabela que guarda os produtos.

O `id` identifica cada produto. `AUTO_INCREMENT` gera esse número automaticamente. Nome e descrição são textos, a validade é uma data, a quantidade é inteira e o valor aceita números com parte decimal.

Salvar o arquivo ainda não cria o banco: é necessário executar o SQL no MySQL.

## 3. Criar o banco no MySQL

Abra o **MySQL Command Line Client** e informe a senha. Na configuração usada neste exemplo, a senha é `root`.

Também é possível entrar pelo CMD:

```bat
mysql -u root -p
```

Digite a senha quando ela for solicitada. No prompt `mysql>`, cole o SQL completo do passo 2 e pressione **Enter**. O MySQL apresenta mensagens de sucesso, como `Query OK`.

Para conferir a tabela, execute:

```sql
SHOW TABLES;
DESCRIBE produtos;
```

Use `;` para finalizar os comandos. Mantenha esse console aberto para consultar os dados durante os testes. O banco é criado uma única vez.

## 4. Criar a conexão PDO

Crie o arquivo [conexao.php](conexao.php):

```php
<?php
$dbname = 'crud_armazem';
$usuario = 'root';
$senha = 'root';
$porta = 3306;

$pdo = new PDO(
    "mysql:host=127.0.0.1;port=$porta;dbname=$dbname;charset=utf8mb4",
    $usuario,
    $senha
);
```

As variáveis indicam o banco, o usuário, a senha e a porta do MySQL. Ajuste esses valores se sua instalação usa outra configuração.

`127.0.0.1` indica o próprio computador. `charset=utf8mb4` define a codificação da conexão para trabalhar com textos e acentos. A variável `$pdo` guarda a conexão usada nos outros arquivos.

## 5. Criar o formulário de cadastro

Crie o arquivo [create_produto_form.php](create_produto_form.php):

```html
<form method="post" action="create_produto_action.php">
    Nome: <input name="nome"><br>
    Descrição: <input name="descricao"><br>
    Data de Validade: <input type="date" name="data_validade"><br>
    Quantidade: <input name="quantidade"><br>
    Valor: <input type="number" name="valor" step="0.01"><br>
    <button>Cadastrar</button>
</form>
```

`method="post"` envia os dados no corpo da requisição HTTP. `action` indica o arquivo PHP que recebe o envio. Cada `name` identifica um dado: o campo `name="nome"`, por exemplo, chega ao PHP como `$_POST['nome']`.

`type="date"` apresenta um campo de data. `type="number"` apresenta um campo numérico, e `step="0.01"` permite valores com centavos, como `8.50`. Sem esse `step`, o campo numérico usa passo `1` por padrão.

## 6. Iniciar o servidor PHP

No terminal do VS Code ou em outro CMD, dentro da pasta do projeto, execute:

```bat
php -S localhost:8000
```

O comando inicia o servidor PHP e usa a pasta atual como raiz do site. Mantenha esse terminal aberto. A porta `8000` é a do servidor Web; a porta `3306` configurada antes é a do MySQL.

## 7. Abrir o formulário no navegador

Acesse [http://localhost:8000/create_produto_form.php](http://localhost:8000/create_produto_form.php).

Confira se os cinco campos e o botão aparecem. Neste momento, apenas observe a tela: a action que recebe o cadastro é criada no próximo passo.

Abra os arquivos PHP pelo endereço do servidor, em vez de abri-los com duplo clique. O servidor executa o PHP e envia a resposta ao navegador.

## 8. Criar a action de cadastro

Crie `create_produto_action.php` com este código inicial:

```php
<?php

require 'conexao.php';

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$data_validade = $_POST['data_validade'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];

$comando = $pdo->prepare(
    'INSERT INTO produtos (nome, descricao, data_validade,quantidade, valor)
    VALUES (?, ?, ?, ?, ?)'
);
$comando->execute([$nome, $descricao, $data_validade, $quantidade, $valor]);
```

Uma **action** é o arquivo PHP que recebe os dados e executa a operação. `require` carrega a conexão; `$_POST` contém os campos enviados pelo formulário.

`INSERT INTO` cadastra uma linha na tabela. Cada `?` recebe um valor passado para `execute()`. A ordem precisa corresponder à das colunas: nome, descrição, validade, quantidade e valor. O `id` não é enviado porque o MySQL o gera.

O percurso é: formulário no navegador → requisição POST → action PHP → INSERT no MySQL.

## 9. Cadastrar o primeiro produto

Abra novamente [o formulário de cadastro](http://localhost:8000/create_produto_form.php), preencha todos os campos e clique em **Cadastrar**. Por exemplo:

| Campo | Valor para teste |
|---|---|
| Nome | Arroz |
| Descrição | Pacote de arroz de 1 kg |
| Data de validade | 31/12/2027, escolhida no campo de data |
| Quantidade | 10 |
| Valor | 8.50 |

A action inicial não imprime uma mensagem nem redireciona. Por isso, a resposta aparece como uma página em branco. Confira a gravação diretamente no banco no próximo passo.

## 10. Conferir o cadastro no banco

No console do MySQL, execute:

```sql
USE crud_armazem;
SELECT * FROM produtos;
```

`SELECT` consulta os dados; `*` solicita todas as colunas. A linha do produto aparece com o `id` gerado pelo banco. Anote esse número para usá-lo nas próximas telas.

Em um banco recém-criado, o primeiro produto recebe o `id` igual a `1`. Se o número encontrado for outro, use-o no lugar de `1` nos endereços dos próximos passos.

## 11. Criar a tela de um produto

Crie o arquivo [show_produto.php](show_produto.php):

```php
<?php

require 'conexao.php';

$id = $_GET['id'];

$consulta = $pdo->prepare('SELECT * FROM produtos WHERE id = ?');
$consulta->execute([$id]);

$produto = $consulta->fetch(PDO::FETCH_ASSOC);

?>

Nome: <?= $produto['nome'] ?><br>
Descrição: <?= $produto['descricao'] ?><br>
Data de Validade: <?= $produto['data_validade'] ?><br>
Quantidade: <?= $produto['quantidade'] ?><br>
Valor: <?= $produto['valor'] ?><br>
```

`$_GET['id']` lê o parâmetro enviado na URL. `WHERE id = ?` limita a consulta ao produto escolhido. `fetch(PDO::FETCH_ASSOC)` obtém uma linha como um array associativo, com chaves como `nome` e `valor`.

`<?= ... ?>` imprime um valor dentro do HTML. O PHP consulta o banco no servidor e monta a resposta; o navegador recebe o conteúdo já preenchido.

## 12. Testar a consulta de um produto

Acesse [http://localhost:8000/show_produto.php?id=1](http://localhost:8000/show_produto.php?id=1), usando o id anotado no passo 10.

No endereço, `?` inicia os parâmetros e `id=1` informa qual produto consultar. Confira se os cinco dados apresentados correspondem ao cadastro.

## 13. Criar o formulário de edição

Crie o arquivo [update_produto_form.php](update_produto_form.php):

```php
<?php

require 'conexao.php';

$id = $_GET['id'];

$consulta = $pdo->prepare('SELECT * FROM produtos WHERE id = ?');
$consulta->execute([$id]);

$produto = $consulta->fetch(PDO::FETCH_ASSOC);

?>

<form method="post" action="update_produto_action.php">
    <input name="id" type="hidden" value="<?= $produto['id'] ?>">
    Nome: <input name="nome" value="<?= $produto['nome'] ?>"><br>
    Descrição: <input name="descricao" value="<?= $produto['descricao'] ?>"><br>
    Data de Validade: <input type="date" name="data_validade" value="<?= $produto['data_validade'] ?>"><br>
    Quantidade: <input name="quantidade" value="<?= $produto['quantidade'] ?>"><br>
    Valor: <input type="number" name="valor" step="0.01" value="<?= $produto['valor'] ?>"><br>
    <button>Atualizar</button>
</form>
```

O início do arquivo consulta o produto, como na tela de detalhes. A diferença está na apresentação: `value` coloca os dados nos campos para que possam ser editados.

O campo `hidden` guarda o `id`. Ele não aparece na tela, mas é enviado por POST junto com os outros campos. Assim, a action identifica qual produto alterar.

## 14. Conferir o formulário preenchido

Acesse [http://localhost:8000/update_produto_form.php?id=1](http://localhost:8000/update_produto_form.php?id=1).

Use o id de um produto existente e confira os valores dos campos. Antes de enviar uma alteração, crie a action do próximo passo.

## 15. Criar a action de edição

Crie `update_produto_action.php` com este código inicial:

```php
<?php

require 'conexao.php';

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$data_validade = $_POST['data_validade'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];
$id = $_POST['id'];

$comando = $pdo->prepare(
    'UPDATE produtos SET nome = ?, descricao = ?, data_validade = ?, quantidade = ?, valor = ?
     WHERE id = ?'
);
$comando->execute([ $nome, $descricao, $data_validade, $quantidade, $valor, $id ]);

echo "Dados atualizados!! <br>";
```

`UPDATE` altera uma linha existente. `SET` indica quais colunas recebem os novos valores. O último `?` pertence a `WHERE id = ?`; por isso, `$id` é o último item passado para `execute()`.

O `WHERE` é essencial: sem ele, o comando altera todos os produtos da tabela. A edição mantém o mesmo `id`, em vez de criar um novo produto.

## 16. Testar a edição

Abra [o formulário de edição](http://localhost:8000/update_produto_form.php?id=1), altere a quantidade e o valor e clique em **Atualizar**.

A action apresenta a mensagem `Dados atualizados!!`. Volte à tela de detalhes para conferir a alteração. Também é possível executar `SELECT * FROM produtos;` no MySQL.

Neste fluxo, o navegador primeiro envia **GET** para buscar o formulário preenchido e depois envia **POST** com os novos dados para a action.

## 17. Criar a action de exclusão

Crie `delete_produto_action.php` com este código inicial:

```php
<?php

require 'conexao.php';

$id = $_GET['id'];

$consulta = $pdo->prepare('DELETE FROM produtos WHERE id = ?');
$consulta->execute([$id]);

echo "Produto deletado!"

?>
```

`DELETE FROM` remove uma linha. O PHP lê o `id` pela URL e o utiliza no `WHERE` para excluir somente o produto escolhido.

Aqui, GET é o método HTTP da requisição; DELETE é o comando SQL executado no banco. São partes diferentes do percurso.

## 18. Testar a exclusão

Acesse [http://localhost:8000/delete_produto_action.php?id=1](http://localhost:8000/delete_produto_action.php?id=1), usando o id do produto de teste.

A action apresenta `Produto deletado!`. Execute `SELECT * FROM produtos;` no MySQL e confira que a linha foi removida. Se havia somente esse produto, a consulta retorna uma tabela sem registros.

As quatro operações já estão funcionando. A próxima tela reúne os produtos e os links para acessar essas operações.

## 19. Criar a listagem com os links

Crie o arquivo [index_produto.php](index_produto.php):

```php
<?php
require 'conexao.php';

$consulta = $pdo->prepare('SELECT * FROM produtos');
$consulta->execute([]);

$produtos = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>

<h1> Listagem de Produtos </h1>

<a href="/create_produto_form.php"> Cadastrar Produto</a><br><br>

<?php
    foreach($produtos as $produto){
?>
    <?= $produto['id'] ?> -
    <?= $produto['nome'] ?> -
    R$<?= $produto['valor'] ?> -
    <a href="/show_produto.php?id=<?= $produto['id'] ?>"> Ver</a> -
    <a href="/update_produto_form.php?id=<?= $produto['id'] ?>"> Editar</a> -
    <a href="/delete_produto_action.php?id=<?= $produto['id'] ?>"> Deletar</a> -

    <br>

<?php
    }
?>
```

Sem `WHERE`, o SELECT consulta todos os produtos. `execute([])` usa um array vazio porque essa consulta não recebe parâmetros. `fetchAll(PDO::FETCH_ASSOC)` obtém a lista, e `foreach` apresenta um produto por vez.

Os links recebem o id da própria linha: ao clicar em **Editar**, por exemplo, o navegador abre o formulário do produto escolhido.

Acesse [http://localhost:8000/index_produto.php](http://localhost:8000/index_produto.php). Se a lista está vazia, clique em **Cadastrar Produto**, cadastre outro produto e abra a listagem novamente. Os ids continuam sendo gerados pelo MySQL; não é necessário voltar ao número `1`.

A barra inicial de `/create_produto_form.php` indica a raiz do servidor. Por isso, o comando `php -S localhost:8000` precisa ser executado na pasta que contém todos os arquivos deste projeto.

## 20. Voltar automaticamente à listagem

Depois de cadastrar, editar ou excluir, o navegador pode voltar à listagem por um redirecionamento:

```php
header('Location: /index_produto.php');
exit;
```

`header()` envia o endereço de destino na resposta HTTP. O navegador faz outra requisição para abrir a listagem atualizada. `exit` encerra a execução da action.

**O redirecionamento precisa ser enviado antes de qualquer texto ou HTML.** Na atualização e na exclusão, substitua os `echo` das mensagens pelo redirecionamento. Não mantenha essas mensagens antes de `header()`.

Os três arquivos completos ficam assim:

### create_produto_action.php

```php
<?php

require 'conexao.php';

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$data_validade = $_POST['data_validade'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];

$comando = $pdo->prepare(
    'INSERT INTO produtos (nome, descricao, data_validade,quantidade, valor)
    VALUES (?, ?, ?, ?, ?)'
);
$comando->execute([$nome, $descricao, $data_validade, $quantidade, $valor]);

header('Location: /index_produto.php');
exit;
```

### update_produto_action.php

```php
<?php

require 'conexao.php';

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$data_validade = $_POST['data_validade'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];
$id = $_POST['id'];

$comando = $pdo->prepare(
    'UPDATE produtos SET nome = ?, descricao = ?, data_validade = ?, quantidade = ?, valor = ?
     WHERE id = ?'
);
$comando->execute([ $nome, $descricao, $data_validade, $quantidade, $valor, $id ]);

header('Location: /index_produto.php');
exit;
```

### delete_produto_action.php

```php
<?php

require 'conexao.php';

$id = $_GET['id'];

$consulta = $pdo->prepare('DELETE FROM produtos WHERE id = ?');
$consulta->execute([$id]);

header('Location: /index_produto.php');
exit;

?>
```

## 21. Testar o fluxo completo

Comece pela [listagem de produtos](http://localhost:8000/index_produto.php):

1. Clique em **Cadastrar Produto**, preencha os cinco campos e cadastre. A listagem abre automaticamente.
2. Clique em **Ver** para consultar o produto. Use o botão de voltar do navegador para retornar à lista.
3. Clique em **Editar**, altere os dados e envie. A listagem abre com os dados atualizados.
4. Clique em **Deletar**. A listagem abre novamente, sem o produto excluído.

Mantenha o MySQL e o servidor PHP em execução. Para encerrar o servidor PHP ao terminar, pressione `Ctrl+C` no terminal dele.

## Arquivos do projeto concluído

| Arquivo | Responsabilidade |
|---|---|
| [banco.sql](banco.sql) | Criar o banco e a tabela |
| [conexao.php](conexao.php) | Abrir a conexão PDO |
| [create_produto_form.php](create_produto_form.php) | Apresentar o formulário de cadastro |
| [create_produto_action.php](create_produto_action.php) | Inserir o produto e redirecionar |
| [show_produto.php](show_produto.php) | Consultar e exibir um produto |
| [update_produto_form.php](update_produto_form.php) | Consultar o produto e preencher o formulário de edição |
| [update_produto_action.php](update_produto_action.php) | Atualizar o produto e redirecionar |
| [delete_produto_action.php](delete_produto_action.php) | Excluir o produto e redirecionar |
| [index_produto.php](index_produto.php) | Listar os produtos e oferecer os links das operações |

Para aprofundar os conceitos, consulte a [apostila de CRUD com PHP](../../README.md).
