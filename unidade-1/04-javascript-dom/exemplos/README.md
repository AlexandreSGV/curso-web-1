# Exemplos de JavaScript no navegador

Siga os assuntos da [apostila](../README.md) e execute o exemplo correspondente. Cada pasta contém uma página completa, JavaScript, CSS e orientações de estudo.

| Exemplo | Assuntos principais | Como executar |
|---|---|---|
| [04 — Monte seu lanche](04-monte-seu-lanche/) | Sintaxe, funções, conversões, condições e validação de formulário | Abrir `index.html` no navegador |
| [05 — Lista de missões](05-lista-de-missoes/) | Criar, alterar e remover elementos; classes e laços | Abrir `index.html` no navegador |
| [06 — Adivinhe o número](06-jogo-adivinhacao/) | Eventos, estado, condições e atualização da página | Abrir `index.html` no navegador |
| [07 — Ficha de personagem](07-ficha-personagem-json/) | Objetos, validação, serialização e desserialização de JSON | Abrir `index.html` no navegador |
| [01 — JSONPlaceholder](01-jsonplaceholder/) | Consultas GET e envio simulado de JSON com POST | Servidor local e internet |
| [02 — OpenWeatherMap](02-openweathermap/) | Parâmetros, chave de API e leitura de objetos | Servidor local, internet e chave própria |
| [03 — Catálogo integrador](03-catalogo-integrador/) | Formulário, eventos, DOM, JSON e uma API PHP | Servidor PHP local |

## Executar tudo com um servidor local

Com PHP CLI instalado, abra o terminal nesta pasta `exemplos` e execute:

```bat
php -S localhost:8000
```

Acesse `http://localhost:8000/` seguido do nome da pasta, por exemplo [http://localhost:8000/04-monte-seu-lanche/](http://localhost:8000/04-monte-seu-lanche/). O catálogo usa PHP; os outros seis exemplos não contêm código de servidor. Use `Ctrl+C` para encerrar.

Os links no GitHub mostram os arquivos. Para interagir, baixe ou atualize o repositório e abra as páginas localmente. Os exemplos 04 a 07 funcionam diretamente pelo arquivo e não fazem requisições externas.
