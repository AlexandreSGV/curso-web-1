<?php
require __DIR__ . '/../verificar_login.php';
exigir_post();

$foto = salvar_imagem($_FILES['foto']['tmp_name'] ?? '', 'alunos');
$comando = $pdo->prepare('INSERT INTO alunos (nome, foto_caminho) VALUES (?, ?)');
$comando->execute([$_POST['nome'], $foto]);
header('Location: /php/aluno/listar.php', true, 303);
exit;
