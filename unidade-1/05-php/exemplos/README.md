# Exemplos de PHP

[Voltar à apostila](../)

Na raiz do repositório, execute:

```bash
cd unidade-1/05-php/exemplos
php -S localhost:8000
```

Mantenha o terminal aberto e acesse os exemplos pelo navegador:

| Exemplo e código | Endereço para executar |
|---|---|
| [01 — Comandos básicos](01-comandos-basicos/) | [Abrir a demonstração](http://localhost:8000/01-comandos-basicos/index.php) |
| [02 — Calculadora GET](02-calculadora-get/) | [Abrir o formulário GET](http://localhost:8000/02-calculadora-get/index.html) |
| [03 — Calculadora POST](03-calculadora-post/) | [Abrir o formulário POST](http://localhost:8000/03-calculadora-post/index.html) |
| [04 — Resposta JSON](04-resposta-json/) | [Consultar a soma em JSON](http://localhost:8000/04-resposta-json/index.php?a=10&b=5) |
| [05 — Redirecionamento](05-redirecionamento/) | [Abrir o formulário de boas-vindas](http://localhost:8000/05-redirecionamento/index.html) |

Os links do GitHub mostram os arquivos. Para executá-los, use a cópia local e os endereços `localhost` acima. `Ctrl+C` encerra o servidor. Não abra arquivos PHP por `file:///`.

Use PHP 8 com as configurações padrão do [guia de ambiente](../../../apoio/ambiente-web1-windows/). A consulta do exemplo 01 usa `file_get_contents()` e precisa de internet, `allow_url_fopen` habilitado (padrão do PHP) e suporte a HTTPS pela extensão OpenSSL indicada no guia. Os outros exemplos executam sem consultar serviços externos.

Nas calculadoras, envie os dois números pelo formulário ou pela URL indicada. No exemplo de redirecionamento, comece pelo formulário e preencha um nome. Para observar uma resposta com status `400`, abra o arquivo [erro.php do exemplo 04](04-resposta-json/erro.php).

Mantenha a estrutura de pastas: os exemplos HTML usam o [styles.css](styles.css) compartilhado. Ele cuida apenas da apresentação. Salve arquivos PHP em UTF-8 sem BOM.

Para observar os status, abra **Rede/Network** nas ferramentas de desenvolvimento antes de enviar o formulário ou recarregar a página. No redirecionamento, ative **Preservar registro/Preserve log** para ver o POST com `303` e o GET seguinte com `200`.
