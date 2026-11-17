<?php
$host = getenv('DB_HOST') ?: '127.0.0.1';
$porta = getenv('DB_PORT') ?: '3306';
$banco = 'escola_nn';
$usuario = getenv('DB_USER') ?: 'root';
$senha = getenv('DB_PASSWORD');
$senha = $senha === false ? 'root' : $senha;

$pdo = new PDO(
    "mysql:host=$host;port=$porta;dbname=$banco;charset=utf8mb4",
    $usuario,
    $senha,
    [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
);
