<?php

require 'conexao.php';

$id = $_GET['id'];

$consulta = $pdo->prepare('DELETE FROM produtos WHERE id = ?');
$consulta->execute([$id]);

header('Location: /index_produto.php');
exit;

?>
