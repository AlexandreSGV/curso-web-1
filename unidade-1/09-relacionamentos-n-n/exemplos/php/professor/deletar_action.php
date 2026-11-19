<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$id = (int) $_POST['id'];
try {
    $comando = $pdo->prepare('DELETE FROM professores WHERE id = ?');
    $comando->execute([$id]);
} catch (PDOException $erro) {
    if ($erro->getCode() !== '23000') {
        throw $erro;
    }
    header('Location: /php/professor/detalhes.php?id=' . $id . '&em_uso=1', true, 303);
    exit;
}
header('Location: /php/professor/listar.php', true, 303);
exit;
