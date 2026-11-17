<?php
require __DIR__ . '/inicio.php';
$titulo = 'Home';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1>Boas-vindas ao sistema escolar</h1>
<?php if ($usuarioLogado): ?>
    <p>Use o menu para acessar os cadastros e matricular alunos nas turmas.</p>
<?php else: ?>
    <p><a href="/login/form.php">Entre</a> para acessar os cadastros e as matrículas.</p>
<?php endif; ?>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
