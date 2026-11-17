<?php
if (!isset($titulo)) {
    http_response_code(404);
    exit;
}
?>
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
            | <a href="/php/aluno/listar.php">Alunos</a>
            | <a href="/php/professor/listar.php">Professores</a>
            | <a href="/php/turma/listar.php">Turmas</a>
            | <a href="/php/usuario/listar.php">Usuários</a>
            | <a href="/php/matricula/listar.php">Matrículas</a>
            <form method="post" action="/php/login/logout.php" style="display: inline">
                <?php campo_token(); ?>
                — <?= h($usuarioLogado['nome']) ?>
                <button>Sair</button>
            </form>
        <?php else: ?>
            | <a href="/php/login/form.php">Entrar</a>
        <?php endif; ?>
    </nav>
</header>
<hr>
<main>
