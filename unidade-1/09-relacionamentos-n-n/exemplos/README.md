# Exemplo completo: sistema escolar

O projeto reúne os cadastros de alunos, professores, turmas e usuários, além de login, logout e matrículas. Usa PHP puro, PDO e MySQL. Todos os arquivos já estão nesta pasta.

## 1. Preparar o banco

No CMD, entre na pasta `exemplos` desta aula. Com o MySQL em execução, abra seu console:

```bat
mysql -u root -p --default-character-set=utf8mb4
```

Informe a senha do MySQL. No prompt `mysql>`, execute:

```sql
SOURCE config/banco.sql;
SOURCE config/popular_banco.sql;
EXIT;
```

O primeiro script cria o banco `escola_nn` e suas tabelas. O segundo insere **40 alunos, 5 turmas, 3 professores, 1 usuário de teste e 6 matrículas**. Execute os scripts uma vez em um banco novo. Esse banco é independente do banco da aula anterior.

Se o MySQL usa outro usuário, senha ou porta, ajuste [config/conexao.php](config/conexao.php). A configuração inicial usa `127.0.0.1`, porta `3306`, usuário `root` e senha `root`. A senha do banco é diferente da senha para entrar no sistema.

## 2. Abrir o sistema

No CMD, ainda na pasta `exemplos`:

```bat
php -S localhost:8000
```

Abra [http://localhost:8000/](http://localhost:8000/). A home dá as boas-vindas e oferece o botão **Entrar**. Use a conta local de demonstração:

| Campo | Valor |
|---|---|
| Usuário | `admin` |
| Senha | `admin123` |

Após o login, o menu apresenta **Home**, **Alunos**, **Professores**, **Turmas**, **Usuários** e **Matrículas**, além do nome da conta e do botão **Sair**. A home e o formulário de login podem ser abertos sem entrar; as páginas e ações dos cadastros e das matrículas exigem uma sessão autenticada.

O nome `admin` identifica a conta inicial. O exemplo não distingue perfis de acesso: as contas cadastradas têm acesso às mesmas telas.

## 3. Entender a organização

| Pasta ou arquivo | O que contém |
|---|---|
| [config/](config/) | Conexão PDO e scripts SQL de criação e população |
| [index.php](index.php) | Home do sistema, na raiz do exemplo |
| [css/](css/), [js/](js/) e [img/](img/) | Pastas para estilos, scripts e imagens |
| [php/templates/](php/templates/) | Cabeçalho com menu e rodapé compartilhados |
| [php/verificar_login.php](php/verificar_login.php) | Abre a sessão e redireciona para o login quando não há um usuário autenticado |
| [php/funcoes.php](php/funcoes.php) | Funções reutilizadas no HTML e no processamento dos formulários |
| [php/login/](php/login/) | Formulário de login e ações de entrada e saída |
| [php/aluno/](php/aluno/), [php/professor/](php/professor/), [php/turma/](php/turma/) e [php/usuario/](php/usuario/) | Um cadastro completo em cada pasta |
| [php/matricula/](php/matricula/) | Listagem, dois formulários e ações para matricular e desmatricular |

Inicie o servidor na raiz do exemplo, onde está o `index.php`. O endereço de [php/aluno/listar.php](php/aluno/listar.php), por exemplo, é `/php/aluno/listar.php`.

As páginas e ações protegidas começam com este `require`, antes de qualquer saída HTML:

```php
require __DIR__ . '/../verificar_login.php';
```

O arquivo verifica a sessão. Se o usuário não estiver autenticado, envia o redirecionamento e encerra a requisição. A home e o formulário de login podem ser abertos sem esse `require`.

Os quatro cadastros seguem o mesmo padrão. Para começar a leitura, acompanhe os arquivos do cadastro de alunos:

| Arquivo | O que faz |
|---|---|
| [listar.php](php/aluno/listar.php) | Lista os registros e oferece atalhos para cadastrar, ver detalhes, editar e excluir |
| [criar_form.php](php/aluno/criar_form.php) | Mostra o formulário vazio |
| [criar_action.php](php/aluno/criar_action.php) | Recebe o POST e insere o registro |
| [detalhes.php](php/aluno/detalhes.php) | Mostra um registro e oferece edição, exclusão e volta à lista |
| [editar_form.php](php/aluno/editar_form.php) | Busca o registro e preenche o formulário |
| [editar_action.php](php/aluno/editar_action.php) | Recebe o POST e grava a alteração |
| [deletar_action.php](php/aluno/deletar_action.php) | Recebe o ID por POST e exclui o registro |

O botão **Excluir** envia um formulário POST. A página usa `include` para montar o cabeçalho e o rodapé.

## 4. Experimentar os relacionamentos

1. Abra **Turmas → Web 1 → Detalhes**. Confira que Helena Costa é a professora e que Ana Souza e Bruno Lima já estão matriculados. No cadastro de turmas, Helena também aparece em **Banco de Dados**.
2. Em **Matrículas → Matricular por IDs**, envie o aluno `6` e a turma `1`. Felipe Costa aparece nos detalhes de **Web 1**.
3. Em **Matrículas → Matricular por listas**, selecione Felipe Costa e **Banco de Dados**. Agora Felipe aparece nas duas turmas.
4. Nos detalhes de **Web 1**, selecione outro aluno no formulário da própria turma e clique em **Matricular**. Os três formulários usam o mesmo [criar_action.php](php/matricula/criar_action.php).
5. Em **Web 1**, use **Desmatricular** ao lado de Felipe. Confira que ele ainda está em **Banco de Dados** e no cadastro de alunos.
6. Clique em **Sair** e tente abrir `/php/turma/listar.php` diretamente. O sistema solicita o login.

Para praticar o CRUD, crie um aluno, veja os detalhes, altere o nome e exclua o registro. Na tela **Usuários**, o mesmo fluxo permite criar outra conta. Deixar a senha em branco na edição mantém a senha atual. Para excluir uma conta que está em uso, entre com outra conta.

[Voltar à apostila](../README.md).
