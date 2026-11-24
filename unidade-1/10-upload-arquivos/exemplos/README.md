# Exemplo completo — Fotos no sistema escolar

Este projeto continua o [sistema escolar da Aula 09](../../09-relacionamentos-n-n/exemplos/). O exemplo reúne login, cadastros, matrículas, fotos de perfil e galerias de turma.

## 1. Preparar o banco

Com o MySQL em execução, abra o CMD na pasta `exemplos`, onde ficam o `index.php` e a pasta `config/`. Entre no console do MySQL.

```bat
mysql -u root -p --default-character-set=utf8mb4
```

No prompt `mysql>`, execute estes comandos uma vez para criar e popular o banco `escola_upload`.

```sql
SOURCE config/banco.sql;
SOURCE config/popular_banco.sql;
EXIT;
```

O banco é próprio desta aula e começa com os alunos, professores, turmas e matrículas de demonstração. A conexão usa o usuário `root` e a senha `root` como valores iniciais. Se a instalação usar outros valores, ajuste [config/conexao.php](config/conexao.php).

## 2. Abrir o sistema

Inicie o servidor PHP no CMD, ainda na pasta `exemplos`.

```bat
php -S localhost:8000
```

Abra [http://localhost:8000/](http://localhost:8000/). Use **Criar conta** para cadastrar o usuário do sistema e depois entre com essa conta. Separe algumas imagens no formato **JPG** para os testes.

## 3. Testar os dois casos

1. Em **Alunos**, cadastre um aluno deixando o campo de foto vazio. Abra **Detalhes** e confira a imagem padrão. Edite o cadastro, envie uma foto e abra os detalhes novamente. Localize a foto em [storage/alunos/](storage/alunos/).
2. Faça o mesmo em **Professores** e localize a foto em [storage/professor/](storage/professor/). Edite apenas o nome e veja que a foto continua aparecendo.
3. Em **Turmas → Web 1 → Detalhes**, clique em **Galeria de fotos**. Adicione duas fotos, uma por vez, com título, descrição e tag. As duas miniaturas aparecem na galeria, e os arquivos ficam em [storage/turmas/](storage/turmas/).
4. Clique em uma miniatura para abrir a foto ampliada. Use **Editar foto** para mudar o título ou trocar a imagem. Depois, use **Excluir foto** e confira a galeria e a pasta das fotos.

| Arquivo ou pasta | O que observar |
| --- | --- |
| [config/banco.sql](config/banco.sql) | Os campos `foto_caminho` e a chave estrangeira de `imagens_turma`. |
| [php/funcoes.php](php/funcoes.php) | Como `salvar_imagem()` gera um nome, move o arquivo e devolve seu caminho. |
| [php/aluno/](php/aluno/) e [php/professor/](php/professor/) | O campo opcional e a escolha da foto na página de detalhes. |
| [php/imagem_turma/](php/imagem_turma/) | A listagem por turma e as telas de detalhes e edição de cada foto. |

[Voltar à apostila](../README.md).
