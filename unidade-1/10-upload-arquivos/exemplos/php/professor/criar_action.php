<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$foto = salvar_imagem($_FILES['foto']['tmp_name'] ?? '', 'professor');
$comando = $pdo->prepare('INSERT INTO professores (nome, foto_caminho) VALUES (?, ?)');
$comando->execute([$_POST['nome'], $foto]);
header('Location: /php/professor/listar.php', true, 303);
exit;
