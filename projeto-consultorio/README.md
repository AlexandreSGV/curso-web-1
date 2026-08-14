# Projeto Consultório

Esta é a base acumulativa de Web 1. As próximas apostilas acrescentarão conteúdo
à mesma pasta, sem criar uma nova cópia do projeto a cada assunto.

> **Material de preparação:** não é esperado que você compreenda todo o código
> agora. Acompanhe somente as partes indicadas pelo professor. PHP, POST, MySQL,
> PDO e CRUD serão explicados nas apostilas correspondentes.

Neste estágio, o sistema faz somente duas operações com pacientes:

- cadastrar;
- listar.

Editar, excluir, autenticar usuários e cadastrar consultas ainda não fazem parte
da base.

## Fluxo preparado

```text
formulário → POST → validação mínima → PDO → MySQL → redirecionamento → listagem
```

## Estrutura

```text
projeto-consultorio/
├── README.md
├── banco/
│   └── estrutura.sql
├── config/
│   ├── .gitignore
│   └── banco.exemplo.php
└── public/
    ├── index.php
    └── pacientes/
        ├── index.php
        ├── novo.php
        └── salvar.php
```

`public` é a pasta aberta pelo servidor. `banco` guarda o SQL fornecido e
`config` recebe a configuração local de cada computador.

## 1. Crie o banco e a tabela

O arquivo [`banco/estrutura.sql`](banco/estrutura.sql) cria o banco
`consultorio` e a tabela `pacientes`.

Entre no MySQL:

```powershell
mysql -u root -p
```

No prompt `mysql>`, execute o arquivo. Troque o caminho pelo local real do
projeto e use barras `/`:

```sql
SOURCE C:/caminho/curso-web-1/projeto-consultorio/banco/estrutura.sql;
SHOW TABLES FROM consultorio;
DESCRIBE consultorio.pacientes;
```

O resultado deve mostrar a tabela `pacientes` e suas colunas. Para rever esse
procedimento, consulte o [guia de MySQL no terminal](../apoio/compartilhado/mysql-terminal/).

## 2. Crie a configuração local

Na pasta `config`:

1. faça uma cópia de `banco.exemplo.php`;
2. renomeie a cópia para `banco.php`;
3. abra `banco.php` e informe seu usuário e sua senha do MySQL;
4. mantenha o nome do banco como `consultorio`.

O arquivo local `banco.php` é ignorado pelo Git. Não coloque senha em
`banco.exemplo.php`, no README ou em qualquer arquivo versionado.

Quando o computador usa o usuário `root`, a parte editada fica semelhante a:

```php
$usuario = 'root';
$senha = 'a senha criada na instalação';
```

Esse trecho é apenas uma orientação: escreva a senha somente na cópia local
`banco.php`.

## 3. Inicie o servidor

Abra `projeto-consultorio` no Visual Studio Code. No terminal dessa pasta,
execute:

```powershell
php -S localhost:8000 -t public
```

Acesse [http://localhost:8000](http://localhost:8000). A página inicial deve
mostrar links para cadastrar e listar pacientes.

Para encerrar o servidor, volte ao terminal e pressione `Ctrl+C`.

## 4. Confira o fluxo

1. Abra **Cadastrar paciente**.
2. Preencha nome, e-mail, telefone e data de nascimento.
3. Clique em **Cadastrar**.
4. Confira a mensagem de sucesso e o paciente na listagem.
5. Volte ao formulário e tente enviá-lo com um campo vazio.

O navegador marca os campos obrigatórios. Mesmo assim, `salvar.php` também
confere os valores, porque dados enviados ao servidor nunca devem ser aceitos
somente pela validação do navegador.

## Medidas usadas nesta base

- `banco.php` fica fora do versionamento para não publicar credenciais;
- o `INSERT` usa parâmetros de um prepared statement, em vez de juntar os
  valores recebidos diretamente ao SQL;
- os dados vindos do banco passam por `htmlspecialchars` antes de aparecer na
  listagem;
- mensagens de falha não exibem senha nem detalhes internos da conexão.

Essas medidas serão explicadas nas apostilas futuras. Elas não transformam este
exemplo didático em um sistema pronto para uso real.

## Problemas comuns

### A aplicação pede `config/banco.php`

Crie a cópia local descrita na etapa 2 e confira o nome do arquivo.

### Aparece “Não foi possível conectar ao banco”

Confira se o serviço MySQL está em execução e revise host, porta, banco, usuário
e senha em `config/banco.php`. Não publique esse arquivo ao pedir ajuda.

### Aparece “could not find driver”

Confirme se `extension=pdo_mysql` está habilitada no `php.ini`. Consulte o
[guia de ambiente do Windows](../apoio/ambiente-web1-windows/).

### O MySQL informa que o banco não existe

Execute `banco/estrutura.sql` e confirme com `SHOW DATABASES;` e
`SHOW TABLES FROM consultorio;`.

### A página mostra 404

Confirme que o terminal está em `projeto-consultorio` e que o servidor foi
iniciado com `-t public`.

## Referências oficiais

- [Conexão PDO com MySQL](https://www.php.net/manual/pt_BR/ref.pdo-mysql.connection.php)
- [Prepared statements com PDO](https://www.php.net/manual/pt_BR/pdo.prepare.php)
- [Criação de tabelas no MySQL 8.4](https://dev.mysql.com/doc/refman/8.4/en/create-table.html)
