# Guia prático: matrículas de alunos em turmas

Crie os arquivos pelos trechos abaixo. Todos ficam na mesma pasta de `conexao.php`. O projeto usa PHP puro, PDO e MySQL.

## 1. Reaproveitar o login

Continue na sua cópia do [projeto da aula 08](../../08-sessoes-autenticacao/exemplos/README.md). Mantenha a conexão, a tabela `usuarios` e o fluxo de cadastro, login e logout. Em `painel.php`, mantenha a verificação de login no início e acrescente estes links no HTML:

```html
<ul>
    <li><a href="pessoas.php?tipo=professores">Professores</a></li>
    <li><a href="pessoas.php?tipo=alunos">Alunos</a></li>
    <li><a href="turmas.php">Turmas</a></li>
    <li><a href="matricula_ids.php">Matrícula por IDs</a></li>
    <li><a href="matricula_selects.php">Matrícula por listas</a></li>
</ul>
```

Crie `escola.php`:

```php
<?php
require 'verificar_login.php';
require 'conexao.php';

function h($texto) {
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}
```

Todas as novas páginas e ações incluem esse arquivo. Sem login, a verificação redireciona e encerra a execução antes da conexão. As páginas de entrar e criar conta continuam públicas. A função `h()` apresenta nomes como texto no HTML, inclusive em campos preenchidos.

## 2. Criar as tabelas

Crie `banco_escola.sql`:

```sql
USE crud_armazem;

CREATE TABLE professores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE turmas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    professor_id INT NOT NULL,
    FOREIGN KEY (professor_id) REFERENCES professores(id)
);

CREATE TABLE matriculas (
    aluno_id INT NOT NULL,
    turma_id INT NOT NULL,
    PRIMARY KEY (aluno_id, turma_id),
    FOREIGN KEY (aluno_id) REFERENCES alunos(id) ON DELETE CASCADE,
    FOREIGN KEY (turma_id) REFERENCES turmas(id) ON DELETE CASCADE
);
```

No CMD, na pasta do projeto, execute `mysql -u root -p` e informe sua senha. No console do MySQL, execute uma vez:

```sql
SOURCE banco_escola.sql;
EXIT;
```

Para excluir um professor que ainda tem turmas, primeiro atribua essas turmas a outro professor. Ao excluir um aluno ou uma turma, `ON DELETE CASCADE` remove as matrículas que apontam para aquele registro. A exclusão da turma, por exemplo, não exclui os alunos.

## 3. Cadastrar professores e alunos

Crie `pessoas.php`. O mesmo arquivo atende os dois cadastros porque ambos têm apenas ID e nome.

```php
<?php
require 'escola.php';

$tabela = ($_GET['tipo'] ?? '') === 'professores' ? 'professores' : 'alunos';
$titulo = $tabela === 'professores' ? 'Professores' : 'Alunos';
$url = 'pessoas.php?tipo=' . $tabela;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir'])) {
        $comando = $pdo->prepare("DELETE FROM $tabela WHERE id = ?");
        $comando->execute([$_POST['excluir']]);
    } elseif ($_POST['id'] !== '') {
        $comando = $pdo->prepare("UPDATE $tabela SET nome = ? WHERE id = ?");
        $comando->execute([$_POST['nome'], $_POST['id']]);
    } else {
        $comando = $pdo->prepare("INSERT INTO $tabela (nome) VALUES (?)");
        $comando->execute([$_POST['nome']]);
    }
    header('Location: ' . $url, true, 303);
    exit;
}

$edicao = ['id' => '', 'nome' => ''];
if (isset($_GET['editar'])) {
    $consulta = $pdo->prepare("SELECT id, nome FROM $tabela WHERE id = ?");
    $consulta->execute([$_GET['editar']]);
    $edicao = $consulta->fetch(PDO::FETCH_ASSOC) ?: $edicao;
}
$pessoas = $pdo->query("SELECT id, nome FROM $tabela ORDER BY nome, id");
?>

<h1><?= $titulo ?></h1>
<p><a href="painel.php">Voltar ao painel</a></p>

<form method="post" action="<?= $url ?>">
    <input type="hidden" name="id" value="<?= $edicao['id'] ?>">
    Nome: <input name="nome" value="<?= h($edicao['nome']) ?>" required>
    <button><?= $edicao['id'] === '' ? 'Cadastrar' : 'Atualizar' ?></button>
    <a href="<?= $url ?>">Novo cadastro</a>
</form>

<ul>
    <?php foreach ($pessoas as $pessoa): ?>
        <li>
            <?= $pessoa['id'] ?> — <?= h($pessoa['nome']) ?>
            <a href="<?= $url ?>&amp;editar=<?= $pessoa['id'] ?>">Editar</a>
            <form method="post" action="<?= $url ?>">
                <button name="excluir" value="<?= $pessoa['id'] ?>">Excluir</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
```

O PHP escolhe entre dois nomes fixos de tabela; o valor recebido na URL não entra diretamente no SQL. Nome e ID são passados separadamente para os `?`.

**Editar** abre a página por GET e preenche o formulário. No POST, um ID vazio indica cadastro e um ID preenchido indica edição. O botão **Excluir** envia o ID no campo `excluir`.

## 4. Cadastrar turmas e escolher um professor

Crie `turmas.php`:

```php
<?php
require 'escola.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir'])) {
        $comando = $pdo->prepare('DELETE FROM turmas WHERE id = ?');
        $comando->execute([$_POST['excluir']]);
    } elseif ($_POST['id'] !== '') {
        $comando = $pdo->prepare('UPDATE turmas SET nome = ?, professor_id = ? WHERE id = ?');
        $comando->execute([$_POST['nome'], $_POST['professor_id'], $_POST['id']]);
    } else {
        $comando = $pdo->prepare('INSERT INTO turmas (nome, professor_id) VALUES (?, ?)');
        $comando->execute([$_POST['nome'], $_POST['professor_id']]);
    }
    header('Location: turmas.php', true, 303);
    exit;
}

$edicao = ['id' => '', 'nome' => '', 'professor_id' => ''];
if (isset($_GET['editar'])) {
    $consulta = $pdo->prepare('SELECT * FROM turmas WHERE id = ?');
    $consulta->execute([$_GET['editar']]);
    $edicao = $consulta->fetch(PDO::FETCH_ASSOC) ?: $edicao;
}
$professores = $pdo->query('SELECT id, nome FROM professores ORDER BY nome, id');
$turmas = $pdo->query(
    'SELECT t.id, t.nome, p.nome AS professor
     FROM turmas AS t JOIN professores AS p ON p.id = t.professor_id
     ORDER BY t.nome, t.id'
);
?>

<h1>Turmas</h1>
<p><a href="painel.php">Voltar ao painel</a></p>

<form method="post" action="turmas.php">
    <input type="hidden" name="id" value="<?= $edicao['id'] ?>">
    Nome: <input name="nome" value="<?= h($edicao['nome']) ?>" required>
    Professor:
    <select name="professor_id" required>
        <option value="">Escolha um professor</option>
        <?php foreach ($professores as $professor): ?>
            <option value="<?= $professor['id'] ?>"
                <?= $professor['id'] == $edicao['professor_id'] ? 'selected' : '' ?>>
                <?= h($professor['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button><?= $edicao['id'] === '' ? 'Cadastrar' : 'Atualizar' ?></button>
    <a href="turmas.php">Nova turma</a>
</form>

<ul>
    <?php foreach ($turmas as $turma): ?>
        <li>
            <?= $turma['id'] ?> — <?= h($turma['nome']) ?> (<?= h($turma['professor']) ?>)
            <a href="turma.php?id=<?= $turma['id'] ?>">Ver detalhes</a>
            <a href="turmas.php?editar=<?= $turma['id'] ?>">Editar</a>
            <form method="post" action="turmas.php">
                <button name="excluir" value="<?= $turma['id'] ?>">Excluir</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
```

Cadastre um professor antes de criar uma turma. O `select` mostra o nome e envia o ID. `selected` mantém o professor atual selecionado ao editar. A coluna `turmas.professor_id` guarda o vínculo 1–N.

## 5. Matricular por IDs

Crie `matricula_ids.php`:

```php
<?php require 'escola.php'; ?>

<h1>Matrícula por IDs</h1>
<p><a href="painel.php">Voltar ao painel</a></p>
<form method="post" action="matricular.php">
    ID do aluno: <input type="number" name="aluno_id" min="1" required><br>
    ID da turma: <input type="number" name="turma_id" min="1" required><br>
    <button>Matricular</button>
</form>
```

Use os números que aparecem nas listagens. Esta tela deixa visível o par de IDs que forma a matrícula. Se um ID não existe, a chave estrangeira rejeita a gravação.

## 6. Matricular por listas

Crie `matricula_selects.php`:

```php
<?php
require 'escola.php';
$alunos = $pdo->query('SELECT id, nome FROM alunos ORDER BY nome, id');
$turmas = $pdo->query('SELECT id, nome FROM turmas ORDER BY nome, id');
?>

<h1>Matrícula por listas</h1>
<p><a href="painel.php">Voltar ao painel</a></p>
<form method="post" action="matricular.php">
    Aluno:
    <select name="aluno_id" required>
        <option value="">Escolha um aluno</option>
        <?php foreach ($alunos as $aluno): ?>
            <option value="<?= $aluno['id'] ?>"><?= h($aluno['nome']) ?></option>
        <?php endforeach; ?>
    </select>
    Turma:
    <select name="turma_id" required>
        <option value="">Escolha uma turma</option>
        <?php foreach ($turmas as $turma): ?>
            <option value="<?= $turma['id'] ?>"><?= h($turma['nome']) ?></option>
        <?php endforeach; ?>
    </select>
    <button>Matricular</button>
</form>
```

O usuário escolhe pelos nomes. O navegador envia o `value` de cada opção: os mesmos dois IDs que chegavam pela tela anterior.

## 7. Matricular pelos detalhes da turma

Crie `turma.php`:

```php
<?php
require 'escola.php';

$turmaId = (int) ($_GET['id'] ?? 0);
$consulta = $pdo->prepare(
    'SELECT t.nome, p.nome AS professor
     FROM turmas AS t JOIN professores AS p ON p.id = t.professor_id
     WHERE t.id = ?'
);
$consulta->execute([$turmaId]);
$turma = $consulta->fetch(PDO::FETCH_ASSOC);
if (!$turma) {
    http_response_code(404);
    exit('Turma não encontrada.');
}

$matriculados = $pdo->prepare(
    'SELECT a.id, a.nome
     FROM matriculas AS m JOIN alunos AS a ON a.id = m.aluno_id
     WHERE m.turma_id = ? ORDER BY a.nome, a.id'
);
$matriculados->execute([$turmaId]);
$alunos = $pdo->query('SELECT id, nome FROM alunos ORDER BY nome, id');
?>

<h1><?= h($turma['nome']) ?></h1>
<p>Professor: <?= h($turma['professor']) ?></p>
<p><a href="turmas.php">Voltar às turmas</a></p>

<h2>Matricular aluno</h2>
<form method="post" action="matricular.php">
    <input type="hidden" name="turma_id" value="<?= $turmaId ?>">
    <select name="aluno_id" required aria-label="Aluno">
        <option value="">Escolha um aluno</option>
        <?php foreach ($alunos as $aluno): ?>
            <option value="<?= $aluno['id'] ?>"><?= h($aluno['nome']) ?></option>
        <?php endforeach; ?>
    </select>
    <button>Matricular</button>
</form>

<h2>Alunos matriculados</h2>
<ul>
    <?php foreach ($matriculados as $aluno): ?>
        <li>
            <form method="post" action="desmatricular.php">
                <?= h($aluno['nome']) ?>
                <input type="hidden" name="aluno_id" value="<?= $aluno['id'] ?>">
                <input type="hidden" name="turma_id" value="<?= $turmaId ?>">
                <button>Desmatricular</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
```

O endereço da página já identifica a turma, por exemplo, `turma.php?id=1`. O formulário envia esse ID em um campo oculto. Em cada linha da lista, **Desmatricular** envia o ID daquele aluno e o da turma aberta.

## 8. Gravar e remover a matrícula

Crie `matricular.php`. Os três formulários enviam para este arquivo:

```php
<?php
require 'escola.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit;
}

$turmaId = (int) $_POST['turma_id'];
$comando = $pdo->prepare(
    'INSERT INTO matriculas (aluno_id, turma_id) VALUES (?, ?)
     ON DUPLICATE KEY UPDATE aluno_id = aluno_id'
);
$comando->execute([$_POST['aluno_id'], $turmaId]);

header('Location: turma.php?id=' . $turmaId, true, 303);
exit;
```

Crie `desmatricular.php`:

```php
<?php
require 'escola.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit;
}

$turmaId = (int) $_POST['turma_id'];
$comando = $pdo->prepare('DELETE FROM matriculas WHERE aluno_id = ? AND turma_id = ?');
$comando->execute([$_POST['aluno_id'], $turmaId]);

header('Location: turma.php?id=' . $turmaId, true, 303);
exit;
```

As duas ações alteram dados por POST e redirecionam com status `303`. O navegador abre os detalhes por GET e mostra a lista atualizada. Recarregar essa página não reenvia o formulário.

## 9. Executar e testar

Com o MySQL em execução, abra o CMD na pasta do projeto e execute:

```bat
php -S localhost:8000
```

1. Sem entrar, abra [a lista de turmas](http://localhost:8000/turmas.php). A página leva você ao login. Entre em [login_form.php](http://localhost:8000/login_form.php) com uma conta de teste.
2. No painel, cadastre a professora **Helena**, os alunos **Ana** e **Bruno** e as turmas **Web 1** e **Banco de Dados**. Atribua as duas turmas a Helena.
3. Em **Matrícula por IDs**, matricule Ana em Web 1.
4. Em **Matrícula por listas**, selecione Ana e Banco de Dados.
5. Em **Turmas → Ver detalhes**, abra Web 1 e matricule Bruno. A lista deve mostrar Ana e Bruno.
6. Repita a matrícula de Bruno em Web 1. Ele continua aparecendo uma única vez.
7. Em Web 1, desmatricule Ana. Confira que Bruno permanece, que Ana continua em Banco de Dados e que seu cadastro ainda aparece em **Alunos**.
8. Volte ao painel, clique em **Sair** e tente abrir os detalhes novamente. A página volta a pedir login.

[Voltar à apostila](../README.md).
