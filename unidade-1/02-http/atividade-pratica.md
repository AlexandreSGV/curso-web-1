# Prática: servidor local, HTTP e Git

Esta atividade complementa a [apostila de HTTP](README.md). Você confirmará o ambiente de Web 1 e acompanhará uma página desde o navegador até o servidor local.

Ao final, você deverá conseguir:

- iniciar e encerrar o servidor do PHP;
- explicar a diferença entre navegador e servidor;
- identificar as partes principais de uma URL local;
- observar uma requisição `GET` e as respostas `200` e `404`;
- localizar o tutorial usado para preparar seu repositório da disciplina.

## Antes de começar

Se algum programa ainda não estiver funcionando, consulte:

- [preparação do ambiente de Web 1 no Windows](../../apoio/ambiente-web1-windows/);
- [comandos básicos do Windows](../../apoio/comandos-windows/);
- [tutorial de Git, GitHub e entrega](../../apoio/compartilhado/git-github-entrega/).

Abra um terminal novo e confirme o PHP:

```powershell
php -v
```

O resultado esperado é uma versão do PHP 8.5. Se o comando não for reconhecido, volte ao guia de ambiente antes de continuar.

## Revise o fluxo básico

O navegador atua como cliente: envia uma requisição HTTP. O servidor local do PHP recebe o pedido e devolve uma resposta.

Nesta atividade, você observará:

- `GET`, usado para solicitar um recurso;
- `200 OK`, quando o recurso é enviado com sucesso;
- `404 Not Found`, quando o recurso não existe.

Consulte a [apostila](README.md) se precisar revisar URLs, métodos, códigos de status ou cabeçalhos.

## Entenda o endereço local

Usaremos este endereço:

```text
http://localhost:8000/?origem=aula
```

| Parte | Significado |
|---|---|
| `http` | Protocolo usado na comunicação |
| `localhost` | O próprio computador |
| `8000` | Porta em que o servidor aguarda pedidos |
| `/` | Caminho do recurso solicitado |
| `?origem=aula` | Parâmetro enviado na URL |

Uma **porta** ajuda o computador a direcionar a comunicação ao programa correto. Nesta atividade, o servidor PHP usará a porta `8000`.

## Execute o exemplo

O exemplo está na pasta [`exemplo`](exemplo/). Não é necessário compreender o código PHP neste momento; ele apenas acrescenta um cabeçalho para facilitar a observação da resposta.

### 1. Abra a pasta correta

No Visual Studio Code, escolha **File > Open Folder** e abra a pasta `exemplo` deste assunto.

Escolha **Terminal > New Terminal** e execute:

```powershell
dir
```

O arquivo `index.php` deve aparecer. Isso confirma que o terminal está na pasta correta.

### 2. Inicie o servidor

Execute:

```powershell
php -S localhost:8000
```

Mantenha o terminal aberto. Ele deve informar que o servidor está atendendo em `localhost:8000`.

### 3. Abra a página

Acesse no navegador:

[http://localhost:8000](http://localhost:8000)

Você deverá ver o título **Servidor local funcionando**.

### Checkpoint 1

- o terminal continua executando o servidor;
- o navegador mostra a página do exemplo;
- o endereço começa com `http://localhost:8000`.

## Observe a requisição e a resposta

As ferramentas do desenvolvedor mostram a comunicação que normalmente fica escondida.

1. Com a página aberta, pressione `F12`.
2. Abra a aba **Network** ou **Rede**.
3. Atualize a página com `Ctrl+R`.
4. Clique na linha referente a `localhost` ou `index.php`.
5. Na seção **Headers** ou **Cabeçalhos**, localize:
   - **Request URL**: `http://localhost:8000/`;
   - **Request Method**: `GET`;
   - **Status Code**: `200 OK`;
   - na resposta, `X-Aula-Web1: servidor-local`.

### Checkpoint 2

Você encontrou uma requisição `GET`, uma resposta `200` e o cabeçalho `X-Aula-Web1`.

## Faça mais duas requisições

Volte à página e use os dois links do exemplo.

### GET com parâmetro

Clique em **Fazer outra requisição GET**. O endereço passa a terminar com:

```text
?origem=aula
```

Na aba **Network**, a nova requisição deve continuar com o método `GET` e o status `200`.

### Recurso inexistente

Clique em **Solicitar uma página que não existe**. O servidor procurará o arquivo, não o encontrará e responderá com `404 Not Found`.

Volte para a página inicial pelo botão **Voltar** do navegador.

### Checkpoint 3

Você observou que URLs diferentes geram novas requisições e que o código de status informa o resultado de cada pedido.

## Encerre o servidor

Volte ao terminal em que o servidor está executando e pressione:

```text
Ctrl+C
```

Atualize o navegador. A página não deverá mais responder, pois o servidor foi encerrado.

## Problemas iniciais

### `php` não é reconhecido

Abra um terminal novo. Se o erro continuar, consulte a [preparação do ambiente](../../apoio/ambiente-web1-windows/).

### A página inicial mostra 404

Execute `dir` no terminal. O arquivo `index.php` precisa aparecer antes de iniciar o servidor. Caso não apareça, encerre o servidor com `Ctrl+C` e abra o terminal na pasta `exemplo`.

### A porta 8000 já está em uso

Use outra porta:

```powershell
php -S localhost:8001
```

Depois, acesse [http://localhost:8001](http://localhost:8001).

### A aba Network está vazia

Mantenha a aba aberta e atualize a página com `Ctrl+R`. Se houver filtros ativos, selecione **All** ou **Doc**.

## Prepare o repositório da disciplina

O procedimento de Git não será repetido aqui. Siga a **Parte 1** do [tutorial de Git, GitHub e entrega](../../apoio/compartilhado/git-github-entrega/).

Ao concluir essa preparação, seu repositório privado deve estar criado, o professor deve ter sido adicionado como colaborador e o primeiro commit deve aparecer no GitHub.

## Síntese

- O navegador atua como cliente e envia uma requisição HTTP.
- O servidor recebe a requisição e devolve uma resposta.
- `localhost` representa o próprio computador e `8000` é a porta usada no exemplo.
- `GET` solicita um recurso.
- `200` indica sucesso e `404` indica que o recurso não foi encontrado.
- `Ctrl+C` encerra o servidor local.

## Referências

- [Servidor embutido do PHP](https://www.php.net/manual/en/features.commandline.webserver.php)
- [Painel Network do Chrome DevTools](https://developer.chrome.com/docs/devtools/network/)
