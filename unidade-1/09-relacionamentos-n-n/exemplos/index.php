<?php
session_start(['use_strict_mode' => true, 'cookie_httponly' => true, 'cookie_samesite' => 'Lax']);
require __DIR__ . '/php/funcoes.php';

$usuarioLogado = null;
if (isset($_SESSION['usuario_id'])) {
    require __DIR__ . '/config/conexao.php';
    $usuarioLogado = usuario_logado($pdo);
}
$titulo = 'Home';
include __DIR__ . '/php/templates/cabecalho.php';
?>
<h1>Boas-vindas ao sistema escolar</h1>
<?php if ($usuarioLogado): ?>
    <p>Use o menu para acessar os cadastros e matricular alunos nas turmas.</p>
<?php else: ?>
    <p><a href="/php/usuario/criar_form.php">Crie sua conta</a> ou <a href="/php/login/form.php">entre</a> para acessar os cadastros e as matrículas.</p>
<?php endif; ?>
<?php include __DIR__ . '/php/templates/rodape.php'; ?>
