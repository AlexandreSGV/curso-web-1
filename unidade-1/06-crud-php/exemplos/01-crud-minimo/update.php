<?php
require 'conexao.php';

if ($_POST) {
    $comando = $pdo->prepare(
        'UPDATE alunos SET nome = ?, email = ?, data_nascimento = ?, telefone = ? WHERE id = ?'
    );
    $comando->execute([
        $_POST['nome'], $_POST['email'], $_POST['data_nascimento'], $_POST['telefone'], $_POST['id']
    ]);
    header('Location: index.php', true, 303);
    exit;
}

$consulta = $pdo->prepare('SELECT * FROM alunos WHERE id = ?');
$consulta->execute([$_GET['id']]);
$aluno = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<h1>Editar aluno</h1>
<form method="post">
    <input type="hidden" name="id" value="<?= $aluno['id'] ?>">
    Nome: <input name="nome" value="<?= $aluno['nome'] ?>"><br>
    E-mail: <input name="email" value="<?= $aluno['email'] ?>"><br>
    Data de nascimento: <input type="date" name="data_nascimento" value="<?= $aluno['data_nascimento'] ?>"><br>
    Telefone: <input type="tel" name="telefone" value="<?= $aluno['telefone'] ?>"><br>
    <button>Salvar alterações</button>
</form>
<a href="index.php">Voltar à listagem</a>
