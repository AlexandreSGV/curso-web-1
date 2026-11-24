USE escola_upload;

INSERT IGNORE INTO professores (id, nome) VALUES
    (1, 'Helena Costa'), (2, 'Paulo Lima'), (3, 'Marina Rocha');

INSERT IGNORE INTO turmas (id, nome, professor_id) VALUES
    (1, 'Web 1', 1),
    (2, 'Banco de Dados', 1),
    (3, 'Lógica de Programação', 2),
    (4, 'Redes de Computadores', 2),
    (5, 'Projeto Integrador', 3);

INSERT IGNORE INTO alunos (id, nome) VALUES
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

INSERT IGNORE INTO matriculas (aluno_id, turma_id) VALUES
    (1, 1), (1, 2), (2, 1), (3, 3), (4, 4), (5, 5);

UPDATE alunos
SET foto_caminho = CONCAT('storage/alunos/aluno-', LPAD(id, 2, '0'), '.jpg')
WHERE id BETWEEN 1 AND 40 AND foto_caminho IS NULL;

UPDATE professores
SET foto_caminho = CONCAT('storage/professor/professor-', LPAD(id, 2, '0'), '.jpg')
WHERE id BETWEEN 1 AND 3 AND foto_caminho IS NULL;

INSERT INTO imagens_turma (turma_id, titulo, descricao, tag, caminho)
SELECT foto.turma_id, foto.titulo, foto.descricao, foto.tag, foto.caminho
FROM (
    VALUES
        ROW(1, 'Código e interface',
            'Uma aplicação Web e seu código abertos na tela.', 'interface', 'storage/turmas/web-01.jpg'),
        ROW(1, 'Desenvolvendo uma página',
            'Um ambiente de trabalho com notebook e monitor para programar.', 'frontend', 'storage/turmas/web-02.jpg'),
        ROW(1, 'Área de desenvolvimento',
            'Telas com um editor e ferramentas para acompanhar o desenvolvimento.', 'editor', 'storage/turmas/web-03.jpg'),
        ROW(2, 'Armazenamento em disco',
            'Um disco rígido aberto mostra o meio físico usado para guardar dados.', 'armazenamento', 'storage/turmas/banco-01.jpg'),
        ROW(2, 'Servidores de dados',
            'Equipamentos instalados em um rack de centro de dados.', 'servidor', 'storage/turmas/banco-02.jpg'),
        ROW(2, 'Dados em gráficos',
            'Um painel apresenta informações para consulta e análise.', 'consulta', 'storage/turmas/banco-03.jpg'),
        ROW(3, 'Planejamento no quadro',
            'Um esquema no quadro ajuda a organizar etapas antes de programar.', 'planejamento', 'storage/turmas/logica-01.jpg'),
        ROW(3, 'Anotações e código',
            'Anotações ao lado do computador ajudam a lembrar o próximo passo.', 'algoritmo', 'storage/turmas/logica-02.jpg'),
        ROW(3, 'Instruções no editor',
            'Um editor usa cores para distinguir partes do código.', 'codigo', 'storage/turmas/logica-03.jpg'),
        ROW(4, 'Switch em uso',
            'Cabos conectados a um equipamento que liga dispositivos da rede.', 'switch', 'storage/turmas/redes-01.jpg'),
        ROW(4, 'Cabo Ethernet',
            'Uma conexão por cabo usada na montagem e manutenção de redes.', 'ethernet', 'storage/turmas/redes-02.jpg'),
        ROW(4, 'Portas e cabeamento',
            'Vários cabos organizados nas portas de um equipamento de rede.', 'cabeamento', 'storage/turmas/redes-03.jpg'),
        ROW(5, 'Ideias no quadro',
            'Estudantes organizam ideias em conjunto para planejar o trabalho.', 'planejamento', 'storage/turmas/projeto-01.jpg'),
        ROW(5, 'Trabalho em equipe',
            'Estudantes colaboram durante uma atividade em sala.', 'equipe', 'storage/turmas/projeto-02.jpg'),
        ROW(5, 'Apresentação do projeto',
            'Uma estudante apresenta seu trabalho a colegas e a um professor.', 'apresentacao', 'storage/turmas/projeto-03.jpg')
) AS foto (turma_id, titulo, descricao, tag, caminho)
WHERE NOT EXISTS (
    SELECT 1 FROM imagens_turma WHERE caminho = foto.caminho
);
