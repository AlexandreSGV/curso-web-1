USE escola_upload;

INSERT INTO professores (id, nome) VALUES
    (1, 'Helena Costa'), (2, 'Paulo Lima'), (3, 'Marina Rocha');

INSERT INTO turmas (id, nome, professor_id) VALUES
    (1, 'Web 1', 1),
    (2, 'Banco de Dados', 1),
    (3, 'Lógica de Programação', 2),
    (4, 'Redes de Computadores', 2),
    (5, 'Projeto Integrador', 3);

INSERT INTO alunos (id, nome) VALUES
    (1, 'Ana Souza'), (2, 'Bruno Lima'), (3, 'Carla Mendes'), (4, 'Diego Santos'),
    (5, 'Érica Oliveira'), (6, 'Felipe Costa'), (7, 'Gabriela Araújo'), (8, 'João Pereira'),
    (9, 'Isabela Ramos'), (10, 'Lucas Melo'), (11, 'Maria Freitas'), (12, 'Miguel Gomes'),
    (13, 'Natália Silva'), (14, 'Otávio Barros'), (15, 'Paula Alves'), (16, 'Pedro Rocha'),
    (17, 'Rafaela Dias'), (18, 'Renato Martins'), (19, 'Sofia Torres'), (20, 'Tiago Ribeiro'),
    (21, 'Alice Nunes'), (22, 'André Castro'), (23, 'Beatriz Campos'), (24, 'Caio Lopes'),
    (25, 'Daniela Lima'), (26, 'Eduardo Correia'), (27, 'Fernanda Reis'), (28, 'Gustavo Pinto'),
    (29, 'Heloísa Brito'), (30, 'Igor Monteiro'), (31, 'Júlia Maciel'), (32, 'Lara Neves'),
    (33, 'Leonardo Duarte'), (34, 'Lívia Andrade'), (35, 'Marcelo Prado'), (36, 'Nina Moraes'),
    (37, 'Ricardo Lopes'), (38, 'Samuel Teixeira'), (39, 'Valentina Luz'), (40, 'Vinícius Matos');

INSERT INTO matriculas (aluno_id, turma_id) VALUES
    (1, 1), (1, 2), (2, 1), (3, 3), (4, 4), (5, 5);
