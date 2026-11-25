# Exemplo completo — Fotos no sistema escolar

Este projeto continua o [sistema escolar da Aula 09](../../09-relacionamentos-n-n/exemplos/). O exemplo reúne login, cadastros, matrículas, fotos de perfil e galerias de turma.

## 1. Preparar o banco

Com o MySQL em execução, abra o CMD na pasta `exemplos`, onde ficam o `index.php` e a pasta `config/`. Entre no console do MySQL.

```bat
mysql -u root -p --default-character-set=utf8mb4
```

No prompt `mysql>`, execute os comandos de criação e população do banco `escola_upload`.

```sql
SOURCE config/banco.sql;
SOURCE config/popular_banco.sql;
EXIT;
```

Em um banco novo, a carga cria 40 alunos e 3 professores com retratos ilustrados, 5 turmas com 3 fotos cada e 6 matrículas. Os arquivos de demonstração já estão em [storage/](storage/).

A conexão usa o usuário `root` e a senha `root` como valores iniciais. Se a instalação usar outros valores, ajuste [config/conexao.php](config/conexao.php).

## 2. Abrir o sistema

Inicie o servidor PHP no CMD, ainda na pasta `exemplos`.

```bat
php -S localhost:8000
```

Abra [http://localhost:8000/](http://localhost:8000/). Use **Criar conta** para cadastrar o usuário do sistema e depois entre com essa conta. Separe algumas imagens no formato **JPG** para os testes.

## 3. Testar os dois casos

1. Em **Alunos**, veja o retrato de Ana Souza. Cadastre outro aluno deixando o campo de foto vazio e observe a imagem padrão. Edite esse cadastro, envie uma foto e localize o arquivo em [storage/alunos/](storage/alunos/). Veja a data, a hora e o sufixo aleatório no nome gerado.
2. Faça o mesmo em **Professores** e localize a foto em [storage/professor/](storage/professor/). Edite apenas o nome e veja que a foto continua aparecendo.
3. Em **Turmas → Web 1 → Detalhes**, clique em **Galeria de fotos** e confira as três miniaturas. Adicione uma foto com título, descrição e tag. O arquivo aparece em [storage/turmas/](storage/turmas/).
4. Clique na miniatura da foto que você adicionou. Use **Editar foto** para mudar o título ou trocar a imagem. Depois, use **Excluir foto** e confira a galeria e a pasta das fotos.

| Arquivo ou pasta | O que observar |
| --- | --- |
| [config/banco.sql](config/banco.sql) | Os campos `foto_caminho` e a chave estrangeira de `imagens_turma`. |
| [config/popular_banco.sql](config/popular_banco.sql) | Os caminhos dos retratos e os registros das fotos de cada turma. |
| [php/funcoes.php](php/funcoes.php) | Como `salvar_imagem()` gera um nome, move o arquivo e devolve seu caminho. |
| [php/aluno/](php/aluno/) e [php/professor/](php/professor/) | O campo opcional e a escolha da foto na página de detalhes. |
| [php/imagem_turma/](php/imagem_turma/) | A listagem por turma e as telas de detalhes e edição de cada foto. |

## Origem das imagens

Os retratos são ilustrações de Pablo Stanley no estilo Open Peeps, obtidas pelo DiceBear. [Open Peeps no DiceBear](https://www.dicebear.com/styles/open-peeps/)

As fotos temáticas são do Pexels.

- **Web 1** · [Código e interface](https://www.pexels.com/photo/opened-program-for-working-online-on-laptop-3888149/) · [Desenvolvendo uma página](https://www.pexels.com/photo/close-up-of-programmer-typing-code-on-laptop-36496927/) · [Área de desenvolvimento](https://www.pexels.com/photo/modern-workspace-with-laptop-and-code-display-34804016/)
- **Banco de Dados** · [Armazenamento em disco](https://www.pexels.com/photo/close-up-of-a-computer-drive-7370679/) · [Servidores de dados](https://www.pexels.com/photo/network-servers-on-an-enclosure-6466141/) · [Dados em gráficos](https://www.pexels.com/photo/a-notebook-beside-a-laptop-with-graphs-6120209/)
- **Lógica de Programação** · [Planejamento no quadro](https://www.pexels.com/photo/woman-writing-on-whiteboard-3861943/) · [Anotações e código](https://www.pexels.com/photo/a-person-writing-on-the-sticky-note-on-the-computer-screen-7504859/) · [Instruções no editor](https://www.pexels.com/photo/programming-code-on-computer-screen-5223887/)
- **Redes de Computadores** · [Switch em uso](https://www.pexels.com/photo/ethernet-cables-plugged-in-network-switch-2881224/) · [Cabo Ethernet](https://www.pexels.com/photo/ethernet-cable-connected-to-system-4818711/) · [Portas e cabeamento](https://www.pexels.com/photo/cables-connected-to-ethernet-ports-2881232/)
- **Projeto Integrador** · [Ideias no quadro](https://www.pexels.com/photo/men-looking-at-the-drawing-on-the-whiteboard-7964038/) · [Trabalho em equipe](https://www.pexels.com/photo/students-collaborating-in-a-classroom-setting-35362880/) · [Apresentação do projeto](https://www.pexels.com/photo/young-student-making-presentation-to-classmates-and-teacher-5940831/)

[Voltar à apostila](../README.md).
