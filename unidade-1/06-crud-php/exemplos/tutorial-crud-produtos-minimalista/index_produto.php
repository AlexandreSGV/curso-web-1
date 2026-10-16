<?php
require 'conexao.php';

$consulta = $pdo->prepare('SELECT * FROM produtos');
$consulta->execute([]);

$produtos = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>

<h1> Listagem de Produtos </h1>

<a href="/create_produto_form.php"> Cadastrar Produto</a><br><br>

<?php
    foreach($produtos as $produto){
?>
    <?= $produto['id'] ?> -
    <?= $produto['nome'] ?> -
    R$<?= $produto['valor'] ?> -
    <a href="/show_produto.php?id=<?= $produto['id'] ?>"> Ver</a> -
    <a href="/update_produto_form.php?id=<?= $produto['id'] ?>"> Editar</a> -
    <a href="/delete_produto_action.php?id=<?= $produto['id'] ?>"> Deletar</a> -

    <br>

<?php
    }
?>
