<?php
require __DIR__ . '/../inicio.php';
exigir_login();
$professores = $pdo->query('SELECT id, nome FROM professores ORDER BY nome, id');
$titulo = 'Cadastrar turma';
include __DIR__ . '/../../templates/cabecalho.php';
?>
<h1>Cadastrar turma</h1>
<form method="post" action="criar_action.php">
    <?php campo_token(); ?>
    <p><label>Nome: <input name="nome" maxlength="100" required></label></p>
    <p><label>Professor:
        <select name="professor_id" required>
            <option value="">Escolha um professor</option>
            <?php foreach ($professores as $professor): ?>
                <option value="<?= $professor['id'] ?>"><?= h($professor['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </label></p>
    <button>Salvar</button>
    <a href="listar.php">Voltar à lista</a>
</form>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>
