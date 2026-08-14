# MySQL no terminal

Use esta folha para entrar no MySQL, localizar bancos e tabelas e executar um arquivo SQL. Ela não substitui as aulas de banco de dados.

> Execute os exemplos somente no banco local de desenvolvimento. Nunca escreva a senha junto do comando nem publique credenciais no GitHub.

## Abrir o cliente

### Web 1 - Windows

Abra o PowerShell e execute:

```powershell
mysql -u root -p
```

### Web 2 - Ubuntu no WSL

Se necessário, inicie o serviço:

```bash
sudo service mysql start
```

Depois entre com o usuário criado para a biblioteca:

```bash
mysql -u biblioteca -p
```

Nos dois casos, digite a senha quando aparecer `Enter password:`. A senha não será mostrada na tela. Quando a conexão funcionar, o prompt mudará para:

```text
mysql>
```

Se o projeto usar outro usuário, substitua `root` ou `biblioteca` pelo nome configurado para ele.

## Localizar e selecionar um banco

Liste os bancos que seu usuário pode acessar:

```sql
SHOW DATABASES;
```

Selecione o banco do projeto:

```sql
USE consultorio;
```

Para a aplicação de Web 2, use:

```sql
USE biblioteca;
```

O resultado esperado é `Database changed`. Para confirmar o banco atual:

```sql
SELECT DATABASE();
```

## Criar um banco de desenvolvimento

Faça isso apenas quando o material da atividade solicitar e usando um usuário que tenha permissão:

```sql
CREATE DATABASE web_desenvolvimento CHARACTER SET utf8mb4;
USE web_desenvolvimento;
```

O nome é apenas um exemplo. Use o nome indicado no projeto e confira se o banco selecionado é o correto antes de executar outros comandos.

## Consultar tabelas

Liste as tabelas do banco selecionado:

```sql
SHOW TABLES;
```

Veja as colunas de uma tabela:

```sql
DESCRIBE pacientes;
```

Em Web 2, um exemplo seria:

```sql
DESCRIBE books;
```

Se aparecer `Empty set`, o banco não tem tabelas. Se aparecer `Table ... doesn't exist`, confira o nome com `SHOW TABLES;`.

## Executar um arquivo `.sql`

Primeiro, entre no cliente MySQL e selecione o banco correto com `USE`. Depois use `SOURCE` com o caminho completo do arquivo.

Exemplo no Windows:

```sql
SOURCE C:/projetos/consultorio/banco/estrutura.sql;
```

Exemplo no Ubuntu/WSL:

```sql
SOURCE /home/aluno/projetos/projeto-biblioteca/estrutura.sql;
```

Troque os caminhos pelos locais reais. No Windows, use barras `/` no comando. Ao terminar, execute `SHOW TABLES;` para conferir o resultado.

> Leia o arquivo antes de executá-lo. Comandos como `DROP DATABASE`, `DROP TABLE` e `TRUNCATE` apagam estruturas ou dados e não fazem parte da sequência deste guia.

## Sair do cliente

```sql
EXIT;
```

O terminal normal voltará a aparecer.

## Erros frequentes

| Sintoma | Causa provável | Primeira ação |
|---|---|---|
| `mysql` não é reconhecido | cliente ausente ou fora do `PATH` | Consulte o guia de ambiente da sua disciplina. |
| `ERROR 2002` ou `ERROR 2003` | serviço parado, host ou porta incorretos | Inicie o serviço e confirme que o projeto usa o servidor local e a porta `3306`. |
| `ERROR 1045 (Access denied)` | usuário, senha ou origem da conexão incorretos | Confira o usuário configurado e digite novamente a senha; não redefina credenciais sem orientação. |
| `ERROR 1049 (Unknown database)` | o banco informado não existe | Execute `SHOW DATABASES;` e confira a grafia do nome. |
| acesso negado ao criar ou usar um banco | o usuário não possui a permissão necessária | Use o banco fornecido para o projeto ou peça ao professor a permissão adequada. |
| `Table ... doesn't exist` | tabela ausente ou banco errado selecionado | Execute `SELECT DATABASE();` e `SHOW TABLES;`. |

Para um diagnóstico mais amplo, consulte [Problemas comuns de ambiente](../problemas-comuns/).

## Referências oficiais

- [Cliente de linha de comando do MySQL](https://dev.mysql.com/doc/refman/8.4/en/mysql.html)
- [Criar e usar um banco](https://dev.mysql.com/doc/refman/8.4/en/database-use.html)
- [Consultar bancos e tabelas](https://dev.mysql.com/doc/refman/8.4/en/getting-information.html)
- [Comandos do cliente, incluindo `source`](https://dev.mysql.com/doc/refman/8.4/en/mysql-commands.html)
- [Erros comuns de conexão](https://dev.mysql.com/doc/refman/8.4/en/common-errors.html)
- [MySQL no Ubuntu](https://ubuntu.com/server/docs/install-and-configure-a-mysql-server)
