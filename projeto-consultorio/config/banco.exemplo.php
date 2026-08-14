<?php

$host = '127.0.0.1';
$porta = '3306';
$banco = 'consultorio';
$usuario = 'SEU_USUARIO';
$senha = 'SUA_SENHA';

$dsn = "mysql:host=$host;port=$porta;dbname=$banco;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $usuario, $senha, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $erro) {
    http_response_code(500);
    exit('Não foi possível conectar ao banco. Confira config/banco.php.');
}
