<?php
session_start(['use_strict_mode' => true, 'cookie_httponly' => true, 'cookie_samesite' => 'Lax']);
require __DIR__ . '/../funcoes.php';

$usuarioLogado = null;
if (isset($_SESSION['usuario_id'])) {
    require __DIR__ . '/../../config/conexao.php';
    $usuarioLogado = usuario_logado($pdo);
}
$titulo = 'Cadastrar usuário';
include __DIR__ . '/../templates/cabecalho.php';
?>
<h1>Cadastrar usuário</h1>
<form method="post" action="criar_action.php">
    <p><label>Nome: <input name="nome" maxlength="100" required></label></p>
    <p><label>Usuário: <input name="login" maxlength="60" required></label></p>
    <p><label>Senha: <input type="password" name="senha" autocomplete="new-password" required></label></p>
    <button>Salvar</button>
    <a href="/">Voltar à home</a>
</form>
<?php include __DIR__ . '/../templates/rodape.php'; ?>
