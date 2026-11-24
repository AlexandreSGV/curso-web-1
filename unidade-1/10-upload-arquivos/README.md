# PHP: upload, armazenamento e recuperação de arquivos

Muitos sistemas Web recebem arquivos dos usuários. Um perfil pode receber uma foto, uma turma pode reunir imagens de uma atividade e um formulário de inscrição pode receber um documento em PDF. Depois do envio, o sistema precisa guardar o arquivo e saber onde buscá-lo quando alguém quiser abrir a foto ou baixar o documento.

Nesta aula, o [sistema escolar da Aula 09](../09-relacionamentos-n-n/) ganha dois recursos. Alunos e professores podem ter uma foto de perfil, e cada turma pode ter uma galeria com várias fotos.

## 1. O que fica no banco de dados?

O MySQL pode armazenar os **bytes do arquivo**, ou seja, o conteúdo inteiro da foto ou do documento, em uma coluna do tipo **BLOB**. Isso pode funcionar para arquivos pequenos, em um sistema com pouco volume. À medida que os arquivos crescem em tamanho e quantidade, surgem alguns custos. [MySQL — tipos BLOB e TEXT](https://dev.mysql.com/doc/refman/8.4/en/blob.html)

- **Leitura e gravação.** Uma consulta que inclui o BLOB precisa buscar e transferir todo o conteúdo. Isso consome disco, memória e tráfego entre o MySQL e a aplicação. Arquivos grandes também podem atingir os limites de tamanho das mensagens do MySQL.
- **Cópias de segurança.** O banco cresce com os arquivos. Fazer backup, restaurar ou manter cópias do banco em outros servidores passa a exigir mais espaço e tempo.
- **Entrega ao navegador.** Para exibir uma imagem armazenada como BLOB, a aplicação precisa ler os bytes no banco e entregá-los em uma resposta HTTP. Uma galeria pode repetir essa operação para cada foto aberta.

Para fotos de perfil e galerias, a solução prática é guardar o **arquivo** em um armazenamento próprio e gravar no banco o **caminho** e os dados associados. Por exemplo, o MySQL guarda `storage/alunos/aluno-01.jpg` no cadastro da aluna Ana. O arquivo `aluno-01.jpg` fica nessa pasta. A página usa o caminho para mostrar a foto. [MySQL — recomendações de desempenho para BLOB](https://dev.mysql.com/doc/refman/8.4/en/optimize-blob.html)

## 2. Onde os arquivos podem ficar?

| Opção | Como funciona | O que considerar |
| --- | --- | --- |
| Disco da máquina da aplicação | O PHP grava em uma pasta do mesmo computador em que roda. | É simples para começar. Os arquivos usam o espaço do mesmo disco da aplicação. |
| Disco dedicado | A aplicação usa outro disco ou volume, disponível como uma unidade ou pasta do servidor. | A capacidade para arquivos pode crescer separadamente. A equipe administra o disco e os backups. |
| Servidor de arquivos dedicado | Outra máquina guarda os arquivos e a aplicação acessa uma pasta compartilhada pela rede. | Vários servidores da aplicação podem usar os mesmos arquivos. O acesso depende da rede e do servidor de arquivos. |
| Serviço de armazenamento em nuvem | A aplicação envia os arquivos a um serviço como o Amazon S3. Cada arquivo é encontrado por uma chave dentro de um contêiner chamado *bucket*. | O serviço oferece capacidade sob demanda. Armazenamento, requisições e transferência de dados podem ter custos. |

O exemplo desta aula usa uma pasta local chamada `storage/`. O banco e a pasta devem ser incluídos no backup para recuperar tanto os cadastros quanto as fotos. [Web 2 — opções de armazenamento](https://github.com/AlexandreSGV/curso-web-2/tree/main/unidade-1/12-storage) · [Amazon S3 — objetos e chaves](https://docs.aws.amazon.com/AmazonS3/latest/userguide/UsingObjects.html)

## 3. Como o PHP recebe e guarda o arquivo?

**Upload** é o envio de um arquivo do navegador para o servidor. Um formulário usa `method="post"`, `enctype="multipart/form-data"` para enviar texto e arquivo na mesma requisição, e um campo `type="file"` para escolher o arquivo. [PHP — envio de arquivos com POST](https://www.php.net/manual/pt_BR/features.file-upload.post-method.php)

```html
<form method="post" action="criar_action.php" enctype="multipart/form-data">
    <p><label>Nome: <input name="nome" required></label></p>
    <p><label>Foto de perfil: <input type="file" name="foto" accept="image/jpeg"></label></p>
    <button>Salvar</button>
</form>
```

Na ação, o PHP encontra o nome da pessoa em `$_POST['nome']` e os dados do arquivo em `$_FILES['foto']`. A chave `foto` vem do atributo `name` do campo. O PHP guarda o arquivo em uma pasta temporária durante a requisição. A entrada `tmp_name` aponta para esse arquivo. A ação passa esse local temporário e o nome da pasta de destino a `salvar_imagem()`.

```php
$foto = salvar_imagem($_FILES['foto']['tmp_name'] ?? '', 'alunos');
```

No [arquivo de funções](exemplos/php/funcoes.php), `salvar_imagem()` faz o mesmo trabalho nos dois exemplos.

```php
function salvar_imagem($temporario, $pasta) {
    if ($temporario === '') {
        return null;
    }

    $dataHora = date('Ymd_His');
    $sufixo = bin2hex(random_bytes(8));
    $nome = $dataHora . '_' . $sufixo . '.jpg';
    $caminho = 'storage/' . $pasta . '/' . $nome;

    return move_uploaded_file($temporario, __DIR__ . '/../' . $caminho) ? $caminho : null;
}
```

O nome combina a data e a hora do envio com um sufixo aleatório, como `20261124_154230_9ae4c010d728e62f.jpg`. O sufixo diferencia fotos enviadas no mesmo segundo, mesmo quando os arquivos têm o mesmo nome no computador.

`move_uploaded_file()` move a foto do local temporário para o destino. `__DIR__` indica a pasta do arquivo PHP. Como a função fica em `php/funcoes.php`, `../` volta à raiz do projeto, onde está a pasta `storage/`. A ação usa o caminho devolvido pela função para preencher a coluna do MySQL. [PHP — move_uploaded_file](https://www.php.net/manual/pt_BR/function.move-uploaded-file.php)

## 4. Como o navegador recupera o arquivo?

Quando alguém abre uma página de detalhes, o PHP busca no banco o caminho da imagem e coloca esse caminho no `src` da tag `<img>`. O navegador faz então uma requisição **GET** pela URL da foto.

| Onde o caminho aparece | Exemplo |
| --- | --- |
| No MySQL, como caminho relativo à pasta do projeto | `storage/alunos/aluno-01.jpg` |
| No HTML, como endereço a partir da raiz do site | `<img src="/storage/alunos/aluno-01.jpg" alt="Foto de perfil">` |
| No navegador, como URL completa | `http://localhost:8000/storage/alunos/aluno-01.jpg` |

No exemplo, o servidor entrega a imagem a partir da pasta `storage/`. Para um documento, a página pode usar o endereço em um link, como `<a href="/storage/documentos/declaracao.pdf">Abrir declaração</a>`.

## 5. Exemplo 1 — Foto de perfil

Cada aluno ou professor pode ter uma foto. Por isso, basta acrescentar uma coluna `foto_caminho` à própria tabela do cadastro.

| Cadastro | Coluna | Pasta |
| --- | --- | --- |
| Aluno | `alunos.foto_caminho` | `storage/alunos/` |
| Professor | `professores.foto_caminho` | `storage/professor/` |

O campo de foto é opcional. Ao cadastrar sem foto, a coluna fica com `NULL`, e a tela de detalhes mostra a imagem padrão. O operador `??` escolhe o caminho da foto quando ele existe e usa a imagem padrão quando o valor é nulo.

```php
<img src="/<?= $registro['foto_caminho'] ?? 'img/perfil-padrao.png' ?>"
     alt="Foto de perfil do aluno" width="120">
```

Na edição, deixar o campo vazio mantém a foto atual. Enviar outra foto atualiza o caminho e remove o arquivo anterior. Excluir o cadastro também remove sua foto.

Confira o fluxo no [formulário de aluno](exemplos/php/aluno/criar_form.php), na [ação de cadastro](exemplos/php/aluno/criar_action.php) e nos [detalhes do aluno](exemplos/php/aluno/detalhes.php). O cadastro de [professores](exemplos/php/professor/) segue o mesmo fluxo.

## 6. Exemplo 2 — Galeria de fotos da turma

Uma turma pode ter várias fotos, e cada foto pertence a uma turma. É um relacionamento **1–N**. A tabela `imagens_turma` guarda um registro por foto, com `id`, `turma_id`, `titulo`, `descricao`, `tag` e `caminho`. A chave estrangeira `turma_id` indica a turma, e os arquivos ficam em `storage/turmas/`. A *tag* é uma palavra curta para identificar o assunto da imagem, como `projeto`.

Para colocar uma foto na turma de Web 1, abra **Turmas → Web 1 → Detalhes → Galeria de fotos**. O formulário da galeria envia o ID da turma junto com o arquivo e os campos de texto. A [ação de cadastro](exemplos/php/imagem_turma/criar_action.php) move a foto e insere seu registro.

A [galeria](exemplos/php/imagem_turma/listar.php) consulta só as fotos da turma aberta usando `WHERE turma_id = ?`. Mostra os títulos e usa as próprias imagens em tamanho menor para fazer as miniaturas. Clicar em uma delas abre outra página com a foto ampliada, o título, a descrição, a tag e as opções **Editar foto** e **Excluir foto**.

A edição abre um formulário próprio. Dá para alterar os dados e manter a foto, ou enviar outra no mesmo formulário. Ao excluir, o PHP apaga o registro no MySQL com `DELETE` e o arquivo em disco com `unlink()`.

## 7. Praticar

Siga o [guia do exemplo completo](exemplos/) para rodar o sistema. A carga inicial traz retratos ilustrados nos perfis e três fotos em cada galeria. Experimente cadastrar um aluno sem foto, colocar uma foto no perfil e adicionar uma imagem a uma turma. Confira no [SQL de criação das tabelas](exemplos/config/banco.sql) a diferença entre guardar um caminho no próprio cadastro e usar uma tabela com uma linha para cada imagem.
