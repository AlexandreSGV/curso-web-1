# Comandos do Windows para Web 1

Esta folha reúne os comandos básicos usados no **PowerShell**. Ela não substitui o tutorial de Git.

## Descobrir em qual pasta você está

```powershell
pwd
```

O resultado deve mostrar o caminho da pasta atual.

## Listar arquivos e pastas

```powershell
dir
```

Antes de iniciar um servidor, confira se o arquivo `index.php` aparece na lista.

## Entrar em uma pasta

```powershell
cd teste-php
```

Se o nome tiver espaços, use aspas:

```powershell
cd "Meu projeto"
```

## Voltar para a pasta acima

```powershell
cd ..
```

## Criar uma pasta

```powershell
mkdir teste-php
```

Depois, entre nela com `cd teste-php`.

## Abrir a pasta atual no VS Code

```powershell
code .
```

O ponto representa a pasta atual. Se o comando não funcionar, abra o VS Code e use **File > Open Folder**.

## Limpar a tela do terminal

```powershell
cls
```

Esse comando limpa apenas a tela; ele não apaga arquivos.

## Verificar o PHP

```powershell
php -v
```

O resultado deve mostrar a versão instalada do PHP.

## Iniciar o servidor local

Entre primeiro na pasta que contém `index.php` e execute:

```powershell
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

```powershell
where.exe php
```

Se nenhum caminho aparecer, consulte o [guia de preparação do ambiente](../ambiente-web1-windows/). Se aparecer um caminho inesperado, peça orientação antes de alterar instalações existentes.

## Sequência mais usada

```powershell
cd teste-php
dir
code .
php -S localhost:8000
```

Resultado esperado: o VS Code abre a pasta, o terminal inicia o servidor e a página fica disponível em [http://localhost:8000](http://localhost:8000). Para encerrar, pressione `Ctrl+C`.

## Referências oficiais

- [Comandos de gerenciamento do PowerShell](https://learn.microsoft.com/powershell/module/microsoft.powershell.management/)
- [Servidor embutido do PHP](https://www.php.net/manual/en/features.commandline.webserver.php)
- [Abrir uma pasta no VS Code pelo terminal](https://code.visualstudio.com/docs/setup/windows)
