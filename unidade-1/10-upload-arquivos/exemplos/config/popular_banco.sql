USE escola_upload;

INSERT IGNORE INTO professores (id, nome, foto_caminho) VALUES
    (1, 'Helena Costa', 'storage/professor/professor-01.jpg'),
    (2, 'Paulo Lima', 'storage/professor/professor-02.jpg'),
    (3, 'Marina Rocha', 'storage/professor/professor-03.jpg');

INSERT IGNORE INTO turmas (id, nome, professor_id) VALUES
    (1, 'Web 1', 1),
    (2, 'Banco de Dados', 1),
    (3, 'Lógica de Programação', 2),
    (4, 'Redes de Computadores', 2),
    (5, 'Projeto Integrador', 3);

INSERT IGNORE INTO alunos (id, nome, foto_caminho) VALUES
    (1, 'Ana Souza', 'storage/alunos/aluno-01.jpg'),
    (2, 'Bruno Lima', 'storage/alunos/aluno-02.jpg'),
    (3, 'Carla Mendes', 'storage/alunos/aluno-03.jpg'),
    (4, 'Diego Santos', 'storage/alunos/aluno-04.jpg'),
    (5, 'Érica Oliveira', 'storage/alunos/aluno-05.jpg'),
    (6, 'Felipe Costa', 'storage/alunos/aluno-06.jpg'),
    (7, 'Gabriela Araújo', 'storage/alunos/aluno-07.jpg'),
    (8, 'João Pereira', 'storage/alunos/aluno-08.jpg'),
    (9, 'Isabela Ramos', 'storage/alunos/aluno-09.jpg'),
    (10, 'Lucas Melo', 'storage/alunos/aluno-10.jpg'),
    (11, 'Maria Freitas', 'storage/alunos/aluno-11.jpg'),
    (12, 'Miguel Gomes', 'storage/alunos/aluno-12.jpg'),
    (13, 'Natália Silva', 'storage/alunos/aluno-13.jpg'),
    (14, 'Otávio Barros', 'storage/alunos/aluno-14.jpg'),
    (15, 'Paula Alves', 'storage/alunos/aluno-15.jpg'),
    (16, 'Pedro Rocha', 'storage/alunos/aluno-16.jpg'),
    (17, 'Rafaela Dias', 'storage/alunos/aluno-17.jpg'),
    (18, 'Renato Martins', 'storage/alunos/aluno-18.jpg'),
    (19, 'Sofia Torres', 'storage/alunos/aluno-19.jpg'),
    (20, 'Tiago Ribeiro', 'storage/alunos/aluno-20.jpg'),
    (21, 'Alice Nunes', 'storage/alunos/aluno-21.jpg'),
    (22, 'André Castro', 'storage/alunos/aluno-22.jpg'),
    (23, 'Beatriz Campos', 'storage/alunos/aluno-23.jpg'),
    (24, 'Caio Lopes', 'storage/alunos/aluno-24.jpg'),
    (25, 'Daniela Lima', 'storage/alunos/aluno-25.jpg'),
    (26, 'Eduardo Correia', 'storage/alunos/aluno-26.jpg'),
    (27, 'Fernanda Reis', 'storage/alunos/aluno-27.jpg'),
    (28, 'Gustavo Pinto', 'storage/alunos/aluno-28.jpg'),
    (29, 'Heloísa Brito', 'storage/alunos/aluno-29.jpg'),
    (30, 'Igor Monteiro', 'storage/alunos/aluno-30.jpg'),
    (31, 'Júlia Maciel', 'storage/alunos/aluno-31.jpg'),
    (32, 'Lara Neves', 'storage/alunos/aluno-32.jpg'),
    (33, 'Leonardo Duarte', 'storage/alunos/aluno-33.jpg'),
    (34, 'Lívia Andrade', 'storage/alunos/aluno-34.jpg'),
    (35, 'Marcelo Prado', 'storage/alunos/aluno-35.jpg'),
    (36, 'Nina Moraes', 'storage/alunos/aluno-36.jpg'),
    (37, 'Ricardo Lopes', 'storage/alunos/aluno-37.jpg'),
    (38, 'Samuel Teixeira', 'storage/alunos/aluno-38.jpg'),
    (39, 'Valentina Luz', 'storage/alunos/aluno-39.jpg'),
    (40, 'Vinícius Matos', 'storage/alunos/aluno-40.jpg');

INSERT IGNORE INTO matriculas (aluno_id, turma_id) VALUES
    (1, 1), (1, 2), (2, 1), (3, 3), (4, 4), (5, 5);

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
