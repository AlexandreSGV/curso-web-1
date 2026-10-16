CREATE DATABASE crud_armazem;
USE crud_armazem;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    descricao VARCHAR(200),
    data_validade DATE,
    quantidade INTEGER,
    valor float
);
