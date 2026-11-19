<?php
$pdo = new PDO(
    'mysql:host=127.0.0.1;port=3306;dbname=escola_nn;charset=utf8mb4',
    'root',
    'root',
    [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
);
