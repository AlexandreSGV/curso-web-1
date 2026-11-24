<?php
session_start(['use_strict_mode' => true, 'cookie_httponly' => true, 'cookie_samesite' => 'Lax']);
require __DIR__ . '/../funcoes.php';
if (isset($_SESSION['usuario_id'])) {
    header('Location: /', true, 303);
    exit;
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
    <p><label>Usuário: <input name="login" autocomplete="username" required></label></p>
    <p><label>Senha: <input type="password" name="senha" autocomplete="current-password" required></label></p>
    <button>Entrar</button>
</form>
<p>Ainda não tem conta? <a href="/php/usuario/criar_form.php">Cadastre um usuário</a>.</p>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
