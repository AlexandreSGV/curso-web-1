<?php

require 'conexao.php';

$id = $_GET['id'];

$consulta = $pdo->prepare('SELECT * FROM produtos WHERE id = ?');
$consulta->execute([$id]);

$produto = $consulta->fetch(PDO::FETCH_ASSOC);

?>

<form method="post" action="update_produto_action.php">
    <input name="id" type="hidden" value="<?= $produto['id'] ?>">
    Nome: <input name="nome" value="<?= $produto['nome'] ?>"><br>
    Descrição: <input name="descricao" value="<?= $produto['descricao'] ?>"><br>
    Data de Validade: <input type="date" name="data_validade" value="<?= $produto['data_validade'] ?>"><br>
    Quantidade: <input name="quantidade" value="<?= $produto['quantidade'] ?>"><br>
    Valor: <input type="number" name="valor" step="0.01" value="<?= $produto['valor'] ?>"><br>
    <button>Atualizar</button>
</form>
