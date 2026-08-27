# Comandos básicos do CMD para Web 1

Esta folha reúne os comandos básicos usados no **Prompt de Comando do Windows (CMD)**. Ela não substitui o tutorial de Git.

## Abrir o CMD no Visual Studio Code

No VS Code, escolha **Terminal > New Terminal**.

Se outro shell for aberto:

1. pressione `Ctrl+Shift+P`;
2. procure `Terminal: Select Default Profile`;
3. selecione **Command Prompt**;
4. feche o terminal atual e abra um novo terminal.

O início da linha deve ser semelhante a:

```text
C:\Users\Aluno\projetos>
```

## Descobrir em qual pasta você está

```bat
cd
```

Quando usado sem outro argumento, `cd` mostra o caminho da pasta atual.

## Listar arquivos e pastas

```bat
dir
```

Antes de iniciar um servidor, confira se o arquivo `index.php` aparece na lista.

## Entrar em uma pasta

```bat
cd teste-php
```

Se o nome tiver espaços, use aspas:

```bat
cd "Meu projeto"
```

## Voltar para a pasta acima

```bat
cd ..
```

## Mudar de unidade e pasta

Para entrar diretamente em uma pasta de outra unidade, use `cd /d`:

```bat
cd /d D:\projetos
```

A opção `/d` muda ao mesmo tempo a unidade e a pasta atual.

## Criar uma pasta

```bat
mkdir teste-php
```

Depois, entre nela com `cd teste-php`.

## Criar um arquivo vazio

Para criar o arquivo somente se ele ainda não existir, use:

```bat
if not exist index.php type nul > index.php
```

A condição `if not exist` evita apagar o conteúdo de um arquivo que já existe. Depois, abra o arquivo no VS Code e adicione o código necessário.

## Renomear arquivos e pastas

Para renomear um arquivo:

```bat
ren pagina.html index.html
```

Para renomear uma pasta:

```bat
ren projeto-antigo projeto-web
```

O primeiro nome identifica o item atual e o segundo indica o novo nome.

## Copiar arquivos e pastas

Para criar uma cópia de um arquivo:

```bat
copy index.php index-copia.php
```

Para copiar uma pasta com todos os arquivos e subpastas:

```bat
xcopy projeto-web projeto-web-copia /E /I
```

A opção `/E` inclui as subpastas, mesmo que estejam vazias. A opção `/I` informa que o destino deve ser tratado como uma pasta.

## Mover arquivos e pastas

Para mover um arquivo para uma pasta:

```bat
move index.php paginas
```

Para mover uma pasta para dentro de outra:

```bat
move projeto-web projetos
```

Nos exemplos, as pastas de destino `paginas` e `projetos` precisam existir. Caso necessário, crie-as antes com `mkdir`.

## Excluir arquivos e pastas

Para excluir um arquivo:

```bat
del index-copia.php
```

Para excluir uma pasta vazia:

```bat
rmdir pasta-vazia
```

Para excluir uma pasta que contém arquivos ou outras pastas:

```bat
rmdir /S projeto-web-copia
```

A opção `/S` inclui todo o conteúdo da pasta. O CMD solicitará uma confirmação antes da exclusão.

> **Atenção:** itens excluídos pelo CMD não são enviados para a Lixeira. Antes de usar `del` ou `rmdir`, confira a pasta atual com `cd` e os itens existentes com `dir`.

## Abrir a pasta atual no VS Code

```bat
code .
```

O ponto representa a pasta atual. Se o comando não funcionar, abra o VS Code e use **File > Open Folder**.

## Limpar a tela do terminal

```bat
cls
```

Esse comando limpa apenas a tela; ele não apaga arquivos.

## Verificar o PHP

```bat
php -v
```

O resultado deve mostrar a versão instalada do PHP.

## Iniciar o servidor local

Entre primeiro na pasta que contém `index.php` e execute:

```bat
php -S localhost:8000
```

Mantenha o terminal aberto e acesse [http://localhost:8000](http://localhost:8000).

## Interromper um comando ou servidor

Pressione:

```text
Ctrl+C
```

Use esse atalho no terminal em que o servidor está em execução.

## Se um comando não for reconhecido

Para procurar o executável do PHP no `PATH`, use:

```bat
where php
```

Se nenhum caminho aparecer, consulte o [guia de preparação do ambiente](../ambiente-web1-windows/). Se aparecer um caminho inesperado, peça orientação antes de alterar instalações existentes.

## Consultar a ajuda de um comando

Use `/?` depois do nome do comando. Por exemplo:

```bat
dir /?
```

O CMD mostrará a descrição e as opções disponíveis.

## Sequência mais usada

```bat
cd teste-php
dir
code .
php -S localhost:8000
```

Resultado esperado: o VS Code abre a pasta, o terminal inicia o servidor e a página fica disponível em [http://localhost:8000](http://localhost:8000). Para encerrar, pressione `Ctrl+C`.

## Referências oficiais

- [Comandos do Windows](https://learn.microsoft.com/windows-server/administration/windows-commands/windows-commands)
- [Comando `xcopy`](https://learn.microsoft.com/windows-server/administration/windows-commands/xcopy)
- [Comando `rmdir`](https://learn.microsoft.com/windows-server/administration/windows-commands/rmdir)
- [Servidor embutido do PHP](https://www.php.net/manual/en/features.commandline.webserver.php)
- [Abrir uma pasta no VS Code pelo terminal](https://code.visualstudio.com/docs/setup/windows)
