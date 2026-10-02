<?php
require 'conexao.php';

if ($_POST) {
    $comando = $pdo->prepare(
        'INSERT INTO alunos (nome, email, data_nascimento, telefone) VALUES (?, ?, ?, ?)'
    );
    $comando->execute([$_POST['nome'], $_POST['email'], $_POST['data_nascimento'], $_POST['telefone']]);
    header('Location: index.php', true, 303);
    exit;
}
?>

<h1>Cadastrar aluno</h1>
<form method="post">
    Nome: <input name="nome"><br>
    E-mail: <input name="email"><br>
    Data de nascimento: <input type="date" name="data_nascimento"><br>
    Telefone: <input type="tel" name="telefone"><br>
    <button>Salvar</button>
</form>
<a href="index.php">Voltar à listagem</a>
