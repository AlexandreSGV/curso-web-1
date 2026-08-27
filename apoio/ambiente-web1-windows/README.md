# Preparação do ambiente de Web 1 no Windows

Este guia prepara o Windows para criar e executar páginas PHP com MySQL. Use o **Prompt de Comando (CMD)**, inclusive no terminal do Visual Studio Code.

Se o computador do laboratório já estiver configurado, não reinstale os programas. Vá direto para a [verificação final](#verificação-final).

Para consultar os comandos durante as aulas, use a [folha de comandos do CMD](../comandos-windows/).

## Abrir o CMD no Visual Studio Code

No VS Code, pressione `Ctrl+Shift+P`, procure `Terminal: Select Default Profile` e selecione **Command Prompt**. Feche o terminal atual e escolha **Terminal > New Terminal**. O novo terminal deve mostrar um caminho terminado pelo sinal `>`.

## O que será instalado

- **PHP 8.5:** executa os programas PHP;
- **Visual Studio Code:** permite editar os arquivos;
- **MySQL 8.4 LTS:** armazena os dados das aplicações;
- **Composer:** instala bibliotecas PHP usadas posteriormente.

Não é necessário instalar Apache, XAMPP, WampServer ou MySQL Workbench.

## 1. PHP 8.5

### Instalação

1. Baixe o [PHP 8.5.9 x64 NTS](https://downloads.php.net/~windows/releases/archives/php-8.5.9-nts-Win32-vs17-x64.zip).
2. Crie a pasta `C:\php`.
3. Extraia todo o conteúdo do arquivo ZIP nessa pasta.
4. Confirme que o arquivo `php.exe` está diretamente em `C:\php`.

### Configuração do `php.ini`

Na pasta `C:\php`:

1. copie o arquivo `php.ini-development`;
2. renomeie a cópia para `php.ini`;
3. abra o novo arquivo e procure as linhas abaixo;
4. remova o `;` do início de cada uma delas:

```ini
extension_dir = "ext"
extension=mbstring
extension=openssl
extension=pdo_mysql
```

Procure também `date.timezone` e deixe a linha assim:

```ini
date.timezone = America/Fortaleza
```

Salve o arquivo.

### Configuração do PATH

O `PATH` permite executar o PHP em qualquer pasta do terminal.

1. No menu Iniciar, pesquise **Editar as variáveis de ambiente do sistema**.
2. Abra a opção encontrada e clique em **Variáveis de Ambiente**.
3. Em **Variáveis do sistema**, selecione **Path** e clique em **Editar**.
4. Clique em **Novo** e adicione `C:\php`.
5. Confirme as janelas com **OK**.
6. Feche os terminais abertos e abra um novo terminal.

## 2. Visual Studio Code

1. Abra a página oficial de [instalação do VS Code no Windows](https://code.visualstudio.com/docs/setup/windows).
2. Baixe o **User Setup** para Windows.
3. Execute o instalador e mantenha as opções padrão.
4. Ao terminar, abra o Visual Studio Code.

## 3. MySQL 8.4 LTS

### Instalação e configuração

1. Abra a página do [MySQL Community Server](https://dev.mysql.com/downloads/mysql/).
2. Selecione **MySQL 8.4 LTS**, **Microsoft Windows** e **MSI Installer**.
3. Execute o instalador.
4. Ao final, abra o **MySQL Configurator** e use estas opções:
   - tipo de configuração: **Development**;
   - conexão TCP/IP pela porta `3306`;
   - serviço do Windows com início automático.
5. Crie uma senha para o usuário `root` e guarde-a. Não coloque essa senha no GitHub.
6. Na última tela, clique em **Execute** para aplicar a configuração.

### Configuração do PATH

Adicione também ao **Path das variáveis do sistema** a pasta `bin` do MySQL:

```text
C:\Program Files\MySQL\MySQL Server 8.4\bin
```

Se a instalação estiver em outra pasta, adicione a pasta que contém `mysql.exe`. Depois, feche os terminais abertos e abra um novo terminal.

## 4. Composer

1. Baixe o instalador oficial [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe).
2. Execute o instalador.
3. Quando ele solicitar o caminho do PHP, selecione `C:\php\php.exe`.
4. Conclua a instalação e abra um novo terminal.

## Verificação final

Abra um novo CMD e execute:

```bat
php -v
mysql --version
composer --version
```

Os resultados devem indicar PHP 8.5, MySQL 8.4 e uma versão do Composer, sem a mensagem “não é reconhecido”.

## Criar e executar uma página PHP mínima

1. Crie uma pasta chamada `teste-php` em um local fácil de encontrar.
2. No Visual Studio Code, escolha **File > Open Folder** e abra essa pasta.
3. Crie nela um arquivo chamado `index.php` com o conteúdo:

```php
<?php

echo '<h1>Ambiente de Web 1 funcionando</h1>';
echo '<p>Versão do PHP: ' . PHP_VERSION . '</p>';
```

4. Salve o arquivo.
5. No VS Code, escolha **Terminal > New Terminal**. O terminal deve mostrar o caminho da pasta `teste-php`.
6. Execute:

```bat
php -S localhost:8000
```

7. Mantenha o terminal aberto e acesse [http://localhost:8000](http://localhost:8000) no navegador.

O navegador deve mostrar **Ambiente de Web 1 funcionando** e a versão do PHP. Para encerrar o servidor, volte ao terminal e pressione `Ctrl+C`.

> Esse servidor deve ser usado somente para desenvolvimento local.

## Problemas comuns

### O comando não é reconhecido

Feche e abra o terminal depois de alterar o `PATH`. Para localizar os programas, execute:

```bat
where php
where mysql
where composer
```

Cada comando deve mostrar o caminho do executável. Se o PHP encontrado não estiver em `C:\php`, existe outro PHP antes dele no `PATH`; peça orientação antes de apagar ou alterar instalações existentes.

### O PHP ou o MySQL informa que falta uma DLL

Instale ou repare o [Microsoft Visual C++ Redistributable x64](https://aka.ms/vs/17/release/vc_redist.x64.exe) e tente novamente. Não baixe DLLs de sites desconhecidos.

### O PHP informa erro em uma extensão

Confirme se o arquivo se chama `C:\php\php.ini` e se o `;` foi removido das extensões indicadas neste guia.

### O navegador mostra erro 404

Confirme se o arquivo se chama `index.php` e se a pasta aberta no VS Code é a mesma mostrada pelo terminal.

### A porta 8000 está ocupada

Encerre outro servidor com `Ctrl+C` ou execute:

```bat
php -S localhost:8001
```

Nesse caso, acesse [http://localhost:8001](http://localhost:8001).

### O MySQL não conecta

Abra **Serviços** no menu Iniciar e confirme se o serviço MySQL está em execução. Verifique também a senha do usuário `root` e a porta `3306`.

## Referências oficiais

- [PHP para Windows](https://www.php.net/downloads.php?os=windows)
- [Servidor embutido do PHP](https://www.php.net/manual/en/features.commandline.webserver.php)
- [Visual Studio Code no Windows](https://code.visualstudio.com/docs/setup/windows)
- [MySQL 8.4 no Windows](https://dev.mysql.com/doc/refman/8.4/en/windows-installation.html)
- [Composer no Windows](https://getcomposer.org/doc/00-intro.md#installation-windows)
