# Ambiente, HTTP e Git: primeira prática

Neste assunto, você confirmará o ambiente de Web 1 e acompanhará uma página desde o navegador até o servidor local.

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

## O caminho de uma página na Web

Quando você abre uma página, dois programas participam da comunicação:

- o **cliente** é o programa que faz o pedido; neste exemplo, o navegador;
- o **servidor** recebe o pedido e envia uma resposta; neste exemplo, o servidor local do PHP.

O fluxo básico é:

```text
navegador  -- requisição HTTP -->  servidor
navegador  <-- resposta HTTP ----  servidor
```

O navegador interpreta o conteúdo recebido e apresenta a página. Esse mesmo fluxo acontece em sites públicos, mas nosso primeiro servidor funcionará somente no seu computador.

> **Contexto em uma frase:** a Web tornou comum acessar documentos ligados por hyperlinks usando endereços e o protocolo HTTP. Para programar, o mais importante agora é compreender o fluxo entre cliente e servidor.

## Entenda o endereço local

Usaremos este endereço:

```text
http://localhost:8000/?origem=aula
```

| Parte | Significado |
|---|---|
| `http` | protocolo usado na comunicação |
| `localhost` | o próprio computador |
| `8000` | porta em que o servidor está aguardando pedidos |
| `/` | caminho do recurso solicitado |
| `?origem=aula` | parâmetro enviado na URL |

Uma **porta** ajuda o computador a direcionar a comunicação ao programa correto. Neste assunto, o servidor PHP usará a porta `8000`.

## HTTP essencial

HTTP organiza a troca de mensagens entre cliente e servidor:

1. o navegador envia uma **requisição** (*request*);
2. o servidor processa o pedido;
3. o servidor devolve uma **resposta** (*response*).

Cada requisição possui um método. Neste exemplo, o navegador usará:

- `GET`: solicita a representação de um recurso, como uma página;
- `POST`: envia dados para processamento, como em um formulário. Ele será praticado em outro assunto.

A resposta contém um código de status. Hoje, observe estes dois:

| Código | Significado neste exemplo |
|---:|---|
| `200 OK` | o servidor encontrou e enviou o recurso |
| `404 Not Found` | o servidor não encontrou o recurso solicitado |

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
- [Semântica do HTTP - RFC 9110](https://www.rfc-editor.org/rfc/rfc9110.html)
