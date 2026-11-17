<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$id = (int) $_POST['id'];
try {
    $comando = $pdo->prepare('DELETE FROM professores WHERE id = ?');
    $comando->execute([$id]);
} catch (PDOException $erro) {
    if ($erro->getCode() !== '23000') {
        throw $erro;
    }
    ir('/professor/detalhes.php?id=' . $id . '&em_uso=1');
}
ir('/professor/listar.php');
