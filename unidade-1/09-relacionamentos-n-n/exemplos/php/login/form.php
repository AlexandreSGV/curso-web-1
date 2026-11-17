<?php
session_start(['use_strict_mode' => true, 'cookie_httponly' => true, 'cookie_samesite' => 'Lax']);
require __DIR__ . '/../funcoes.php';
if (isset($_SESSION['usuario_id'])) {
    ir('/');
}
$usuarioLogado = null;
$titulo = 'Entrar';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1>Entrar</h1>
<?php if (isset($_GET['erro'])): ?>
    <p>Usuário ou senha incorretos.</p>
<?php endif; ?>
<form method="post" action="login_action.php">
    <?php campo_token(); ?>
    <p><label>Usuário: <input name="login" autocomplete="username" required></label></p>
    <p><label>Senha: <input type="password" name="senha" autocomplete="current-password" required></label></p>
    <button>Entrar</button>
</form>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
