# OpenWeatherMap: tempo atual

Exemplo de `change`, `submit`, parâmetros de URL e acesso a propriedades de objetos e arrays recebidos de uma API.

## Preparação

1. Acesse sua conta na [OpenWeatherMap](https://home.openweathermap.org/).
2. Obtenha uma chave habilitada para **Current Weather Data**, endpoint `/data/2.5/weather`.
3. Confira a ativação, as permissões, os limites e as condições de uso da sua conta. Este exemplo não usa One Call.
4. Informe a chave somente no campo da página. Não a coloque em `script.js`, no README ou em um commit.

O repositório não fornece chave nem cria conta ou assinatura. A documentação dos parâmetros está em [Current Weather Data](https://old.openweathermap.org/current).

## Executar

Na pasta `unidade-1/04-javascript-dom/exemplos`, com PHP CLI instalado:

```bat
php -S localhost:8000
```

Abra [http://localhost:8000/02-openweathermap/](http://localhost:8000/02-openweathermap/). Um servidor estático local também serve este exemplo. É necessário acesso à internet e uma chave válida.

## Como funciona

- [index.html](index.html) apresenta um `select` de cidades e o campo da chave.
- [script.js](script.js) usa coordenadas aproximadas de três cidades, sem solicitar a localização do usuário nem consultar outra API de geocodificação.
- `units=metric` solicita temperatura em Celsius; `lang=pt_br` solicita descrições em português.
- A resposta alimenta os campos de local, descrição, temperatura e umidade.
- [styles.css](styles.css) define a apresentação e a classe de erro.

## Conferência

Selecione uma cidade, informe a chave e consulte. Depois troque a cidade e repita. Durante o pedido, o botão fica desabilitado; após sucesso ou falha, ele é liberado. O resultado anterior é ocultado ao iniciar outra consulta.

Erros de acesso (`401`/`403`) pedem revisão da chave e de suas permissões; `429` indica limite de consultas. Falhas de rede e JSON inválido também geram mensagens. Não faça consultas repetidas para provocar limites.

**Atenção:** `type="password"` oculta os caracteres visualmente, mas não protege a chave de quem inspeciona a página e a rede. Ela é enviada ao provedor em `appid` e não é gravada em `localStorage` nem em arquivos por este exemplo. Não compartilhe capturas de requisições contendo a chave. Em uma aplicação que precise protegê-la, faça a chamada por um servidor controlado por você.

[Voltar à apostila](../../README.md)
