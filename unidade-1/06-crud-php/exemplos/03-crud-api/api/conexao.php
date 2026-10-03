<?php
$dbname = 'crud_alunos';
$usuario = 'root';
$senha = 'SUA_SENHA';
$porta = 3306;

$pdo = new PDO(
    "mysql:host=127.0.0.1;port=$porta;dbname=$dbname;charset=utf8mb4",
    $usuario,
    $senha
);
