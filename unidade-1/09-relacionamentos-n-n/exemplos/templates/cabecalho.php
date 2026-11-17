<!doctype html>
<html lang="pt-BR">
<head>
    <title><?= h($titulo ?? 'Sistema escolar') ?></title>
</head>
<body>
<header>
    <nav aria-label="Menu principal">
        <a href="/">Home</a>
        <?php if ($usuarioLogado): ?>
            | <a href="/aluno/listar.php">Alunos</a>
            | <a href="/professor/listar.php">Professores</a>
            | <a href="/turma/listar.php">Turmas</a>
            | <a href="/usuario/listar.php">Usuários</a>
            | <a href="/matricula/listar.php">Matrículas</a>
            <form method="post" action="/login/logout.php" style="display: inline">
                <?php campo_token(); ?>
                — <?= h($usuarioLogado['nome']) ?>
                <button>Sair</button>
            </form>
        <?php else: ?>
            | <a href="/login/form.php">Entrar</a>
        <?php endif; ?>
    </nav>
</header>
<hr>
<main>
