# Problemas comuns de ambiente

Comece pelo sintoma que aparece na tela. Faça apenas a primeira ação indicada e teste novamente; uma mesma mensagem pode ter causas diferentes.

| Sintoma | Causa provável | Primeira ação |
|---|---|---|
| arquivo, `artisan` ou `index.php` não encontrado | terminal aberto na pasta errada | Execute `pwd` e liste os arquivos com `dir` no PowerShell ou `ls` no Ubuntu. Entre na pasta correta antes de repetir o comando. |
| comando não reconhecido ou `command not found` | programa ausente ou pasta fora do `PATH` | Feche e abra o terminal. No Windows, use `where.exe NOME`; no Ubuntu, use `command -v NOME`. Depois consulte o guia de ambiente da disciplina. |
| porta 8000 ocupada | outro servidor ainda está em execução | Volte ao terminal do servidor anterior e pressione `Ctrl+C`. Se necessário, use temporariamente a porta 8001. |
| PHP não inicia ou uma extensão está ausente | versão, `php.ini` ou pacote PHP incorreto | Execute `php -v` e `php -m`. Em Web 1, confira o `php.ini`; em Web 2, confira os pacotes indicados no guia do WSL. |
| MySQL não conecta | serviço parado, usuário, senha, host ou porta incorretos | Confirme que o serviço está ativo e compare as credenciais com a configuração local do projeto. Consulte também [MySQL no terminal](../mysql-terminal/). |
| Ubuntu/WSL não abre ou não aparece | distribuição não instalada ou WSL não iniciado | No PowerShell, execute `wsl -l -v`. Depois abra **Ubuntu 24.04** pelo menu Iniciar. |
| `Permission denied` no WSL | arquivo pertence a outro usuário ou comando foi executado com `sudo` indevidamente | Execute `pwd` e `ls -la`. Não use `chmod 777` nem continue executando Composer ou npm com `sudo`; peça orientação mostrando o proprietário do arquivo. |
| classe PHP, pacote ou módulo JavaScript não encontrado | dependências ainda não instaladas | Dentro da pasta correta do projeto, execute `composer install` para PHP e `npm install` para JavaScript. Não envie `vendor/` nem `node_modules/` ao GitHub. |
| Laravel informa que `.env` não existe | arquivo local de configuração ainda não foi criado | Dentro do projeto, execute `cp .env.example .env`, configure somente os dados locais e não publique o `.env`. |
| Laravel informa chave ausente ou `No application encryption key` | `APP_KEY` ainda não foi gerada | Depois de criar o `.env`, execute `php artisan key:generate`. |
| página 404 | endereço, rota, arquivo ou pasta do servidor incorretos | Confira a URL e o terminal que iniciou o servidor. Em PHP, confirme a presença de `index.php`; em Laravel, execute `php artisan route:list`. |
| página 500 | erro da aplicação, dependência ou configuração | Leia a primeira mensagem de erro no terminal. Em Laravel local, confira também o log mais recente em `storage/logs/`, sem publicar credenciais. |
| remoto Git incorreto ou autenticação falhou | URL do remoto, sessão ou permissão no GitHub | Consulte o [tutorial de Git, GitHub e entrega](../git-github-entrega/). Não compartilhe senha, token nem código de autenticação. |

## Comandos para conferir a porta alternativa

PHP no Windows:

```powershell
php -S localhost:8001
```

Laravel no Ubuntu/WSL:

```bash
php artisan serve --port=8001
```

Nos dois casos, acesse [http://localhost:8001](http://localhost:8001).

## Ao pedir ajuda

Copie estas informações:

1. o comando exato que você executou;
2. a mensagem completa do erro;
3. o resultado de `pwd` e da listagem de arquivos;
4. qual terminal está usando: PowerShell ou Ubuntu/WSL;
5. a URL acessada e o resultado esperado;
6. as versões relacionadas ao erro, como `php -v`, `composer --version`, `node -v` ou `mysql --version`.

Não envie o conteúdo do `.env`, senhas, tokens, códigos de autenticação ou outras credenciais.

## Referências oficiais

- [Solução de problemas do PHP](https://www.php.net/manual/en/install.problems.php)
- [Erros comuns do MySQL](https://dev.mysql.com/doc/refman/8.4/en/common-errors.html)
- [Solução de problemas do WSL](https://learn.microsoft.com/windows/wsl/troubleshooting)
- [Instalação de dependências com Composer](https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies)
- [Instalação do Laravel](https://laravel.com/docs/13.x/installation)
- [Solução de problemas de autenticação no GitHub](https://docs.github.com/en/authentication/troubleshooting-authentication-issues)
