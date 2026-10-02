CREATE DATABASE crud_alunos;
USE crud_alunos;

CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(150),
    data_nascimento DATE,
    telefone VARCHAR(20)
);
