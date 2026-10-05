# Exemplo — CRUD de alunos com API NestJS

O NestJS recebe requisições HTTP, executa SQL no MySQL e responde em JSON. O navegador apresenta o cadastro com o mesmo HTML e JavaScript do [exemplo 3 com API PHP](../../06-crud-php/exemplos/03-crud-api/).

As duas interfaces oferecem cadastro, listagem, detalhes, edição e exclusão:

- [Front-end mínimo](public/frontend-minimo/index.html): HTML simples, sem CSS.
- [Front-end com Tailwind](public/frontend-tailwind/index.html): os mesmos campos e operações, com estilos.

Os dois HTMLs foram reaproveitados integralmente. No [app.js](public/js/app.js), a mudança é o endereço da API: `../api/alunos`. Os métodos HTTP, o parâmetro `?id=` e os formatos de dados são preservados.

Leia também a [apostila](../README.md).

## Arquivos

| Caminho | Responsabilidade |
|---|---|
| [src/main.ts](src/main.ts) | Iniciar o servidor e disponibilizar a pasta `public/` |
| [src/app.module.ts](src/app.module.ts) | Registrar controller e service |
| [src/alunos.controller.ts](src/alunos.controller.ts) | Receber as operações HTTP e encaminhá-las ao service |
| [src/alunos.service.ts](src/alunos.service.ts) | Executar SQL e devolver os resultados |
| [src/conexao.ts](src/conexao.ts) | Configurar a conexão com o MySQL |
| [src/aluno.ts](src/aluno.ts) | Descrever os quatro campos recebidos |
| [public/js/app.js](public/js/app.js) | Tratar eventos, enviar requisições e preencher a interface |
| [public/frontend-minimo/index.html](public/frontend-minimo/index.html) | Interface mínima |
| [public/frontend-tailwind/index.html](public/frontend-tailwind/index.html) | Interface com Tailwind |
| [sql/banco.sql](sql/banco.sql) | Criar o mesmo banco e a mesma tabela do exemplo PHP |
| [sql/popular.sql](sql/popular.sql) | Acrescentar oito alunos fictícios |
| [package.json](package.json) | Dependências e comandos de execução |
| [package-lock.json](package-lock.json) | Registrar as versões das dependências |
| [tsconfig.json](tsconfig.json) | Configurar a compilação de TypeScript para JavaScript |

## Como executar no Windows

É necessário ter **Node.js 22 ou superior**, npm e MySQL. A instalação do MySQL é a mesma do [guia de ambiente de Web 1](../../../apoio/ambiente-web1-windows/).

### 1. Conferir Node.js e npm

Instale uma versão **LTS** compatível pelo [site do Node.js](https://nodejs.org/en/download). O instalador inclui o npm. Depois da instalação, abra um novo CMD e confira:

```bat
node -v
npm -v
```

O Node executa o back-end; o npm instala suas dependências. A primeira instalação dos pacotes exige internet.

### 2. Instalar as dependências

No CMD, a partir da pasta principal do repositório, entre na pasta do projeto:

```bat
cd unidade-1\07-crud-nestjs-api\exemplos
npm install
```

Os comandos seguintes também são executados nessa pasta. Não é necessário instalar o Nest CLI globalmente: o projeto já contém a configuração e os pacotes necessários.

### 3. Configurar a conexão

Em [src/conexao.ts](src/conexao.ts), ajuste os valores para o seu MySQL:

```typescript
host: '127.0.0.1',
port: 3306,
user: 'root',
password: 'SUA_SENHA',
database: 'crud_alunos',
```

Substitua a senha somente na sua cópia local. A porta acima pertence ao **MySQL**.

Mantenha `dateStrings: ['DATE']`: essa opção devolve o nascimento como `AAAA-MM-DD`, formato utilizado pelo campo de data da interface.

### 4. Preparar o banco

**Se o banco dos exemplos PHP já existe, aproveite-o e passe à etapa 5.** Os registros atuais também aparecem nesta versão.

Para criar o banco, no CMD da pasta do projeto, entre no MySQL:

```bat
mysql -u root -p
```

Se o MySQL usa outra porta, informe-a ao entrar; por exemplo, `mysql -h 127.0.0.1 -P 3307 -u root -p`.

No console MySQL, execute:

```sql
SOURCE sql/banco.sql;
```

Para acrescentar os alunos fictícios, execute também:

```sql
SOURCE sql/popular.sql;
```

Este script contém os mesmos dados de teste do CRUD em PHP. Execute apenas uma cópia dele: cada execução acrescenta novamente oito alunos, sem apagar os existentes.

Saia do console:

```sql
EXIT;
```

### 5. Iniciar o servidor

No CMD da pasta do projeto, execute:

```bat
npm start
```

O comando compila os arquivos TypeScript de `src/` para JavaScript em `dist/` e inicia o servidor na porta **3000**.

Mantenha o terminal aberto e acesse:

| Conteúdo | Endereço |
|---|---|
| Front-end mínimo | [http://localhost:3000/frontend-minimo/](http://localhost:3000/frontend-minimo/) |
| Front-end com Tailwind | [http://localhost:3000/frontend-tailwind/](http://localhost:3000/frontend-tailwind/) |
| Lista em JSON | [http://localhost:3000/api/alunos](http://localhost:3000/api/alunos) |

Abra as interfaces por esses endereços. O servidor Nest entrega o HTML, o JavaScript e a API; não é necessário iniciar outro servidor para as páginas.

O MySQL deve permanecer em execução. O Tailwind é carregado pela internet; a interface mínima e a API funcionam localmente depois da instalação das dependências.

`Ctrl+C` encerra o servidor. Após alterar um arquivo `.ts`, encerre e execute `npm start` novamente para recompilar. Para somente conferir a compilação, use `npm run build`.

## Experimentar o CRUD

1. Preencha nome, e-mail, data de nascimento e telefone. Clique em **Salvar**.
2. Use **Ver detalhes** para consultar um aluno.
3. Clique em **Editar**, altere um campo e salve.
4. Use **Limpar / cancelar edição** para voltar ao cadastro.
5. Clique em **Excluir** e confirme a remoção.
6. Abra a outra interface e clique em **Atualizar lista** para consultar os mesmos registros.

Em **F12 → Rede/Network → Fetch/XHR**, observe o método HTTP, o corpo JSON, o status e a resposta.

## Contrato da API

Todas as operações usam `/api/alunos`. O método HTTP escolhe a operação; o parâmetro `id` identifica o aluno.

| Operação | Método e endereço | Corpo enviado | Resposta de sucesso |
|---|---|---|---|
| Listar | `GET /api/alunos` | Nenhum | `200` e um array de alunos |
| Consultar um | `GET /api/alunos?id=1` | Nenhum | `200` e um objeto aluno |
| Cadastrar | `POST /api/alunos` | JSON com os quatro campos | `201`, id gerado e mensagem |
| Alterar | `PUT /api/alunos?id=1` | JSON com os quatro campos | `200` e mensagem |
| Excluir | `DELETE /api/alunos?id=1` | Nenhum | `200` e mensagem |

Substitua `1` pelo id de um aluno existente. O corpo enviado no cadastro e na edição tem este formato:

```json
{
    "nome": "Ana Souza",
    "email": "ana.souza@example.com",
    "data_nascimento": "2005-03-12",
    "telefone": "(11) 90000-0001"
}
```

A consulta de um id inexistente responde com `404` e `{"mensagem":"Aluno não encontrado."}`. O formulário pede os quatro campos com `required`; o back-end mantém as operações diretas, sem validações detalhadas dos campos.

`DadosAluno` descreve os campos durante a escrita e a compilação; esse tipo não valida automaticamente os dados recebidos por HTTP. Outros métodos HTTP seguem o roteamento padrão do Nest.

## Comparar com a versão PHP

Execute o exemplo PHP na porta **8000** e este projeto na porta **3000**, com as duas conexões apontando para o mesmo MySQL e para `crud_alunos`.

1. Cadastre um aluno pela interface PHP.
2. Atualize a lista na interface NestJS e confira o registro.
3. Edite o aluno pela interface NestJS.
4. Atualize a lista na interface PHP e confira a alteração.

Os dois projetos acessam os mesmos registros. Uma alteração ou exclusão feita em uma versão também aparece na outra após uma nova consulta.

| Parte | API PHP | API NestJS |
|---|---|---|
| Interface | Os dois HTMLs e `app.js` | Os mesmos HTMLs; somente o endereço em `app.js` muda |
| Requisições | `alunos.php` verifica o método HTTP | O controller usa decoradores de método |
| Acesso ao banco | PDO executa SQL parametrizado | O service usa `mysql2` e SQL parametrizado |
| Dados | Banco `crud_alunos`, tabela `alunos` | O mesmo banco e a mesma tabela |
| Respostas | PHP produz JSON | Nest converte objetos e arrays em JSON |

No service, `RowDataPacket[]` indica um resultado com linhas de consulta, e `ResultSetHeader` indica o resultado do INSERT, que contém `insertId`. São tipos fornecidos pela biblioteca `mysql2`.

## Erros comuns

| Situação | O que conferir |
|---|---|
| `node` ou `npm` não reconhecido | Instalação do Node.js e abertura de um novo CMD |
| Pacotes não encontrados | Execução de `npm install` na pasta do projeto |
| Porta HTTP ocupada | Encerrar o processo que usa a porta 3000 |
| Falha ao consultar ou cadastrar | MySQL em execução e valores em `src/conexao.ts` |
| Banco ou tabela não encontrado | Criação de `crud_alunos` e da tabela `alunos` |
| Data não preenchida ao editar | Manter `dateStrings: ['DATE']` na conexão |

Se a API responder com `500`, confira a mensagem no terminal do Nest para identificar a falha de conexão ou de SQL.
