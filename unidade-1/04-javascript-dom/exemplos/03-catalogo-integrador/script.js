const formulario = document.querySelector("#formulario-busca");
const campoBusca = document.querySelector("#busca");
const botaoBuscar = document.querySelector("#botao-buscar");
const botaoRestaurar = document.querySelector("#botao-restaurar");
const contador = document.querySelector("#contador");
const mensagem = document.querySelector("#mensagem");
const lista = document.querySelector("#livros");
const painelJSON = document.querySelector("#json-busca");
let ultimaBuscaJSON = "";

campoBusca.addEventListener("input", atualizarContador);
formulario.addEventListener("submit", buscarLivros);
botaoRestaurar.addEventListener("click", restaurarBusca);

function atualizarContador() {
  contador.textContent = `${campoBusca.value.length} caracteres digitados.`;
}

function buscarLivros(evento) {
  evento.preventDefault();
  if (botaoBuscar.disabled) {
    return;
  }

  const busca = campoBusca.value.trim();
  lista.textContent = "";
  mensagem.classList.remove("erro");

  if (busca.length < 2 || busca.length > 60) {
    mensagem.textContent = "Digite de 2 a 60 caracteres, sem contar os espaços nas pontas.";
    mensagem.classList.add("erro");
    campoBusca.focus();
    return;
  }

  // Serializar não envia nada: este texto fica só na memória da página.
  ultimaBuscaJSON = JSON.stringify({ busca: busca });
  painelJSON.textContent = ultimaBuscaJSON;
  botaoRestaurar.disabled = false;
  botaoBuscar.disabled = true;
  mensagem.textContent = `Buscando por "${busca}"...`;

  fetch(`api/livros.php?busca=${encodeURIComponent(busca)}`)
    .then(lerResposta)
    .then(mostrarLivros)
    .catch(mostrarErro);
}

function lerResposta(resposta) {
  if (!resposta.ok) {
    throw new Error(`A API respondeu com HTTP ${resposta.status}.`);
  }
  return resposta.json();
}

function mostrarLivros(livros) {
  if (!Array.isArray(livros)) {
    throw new Error("A API não devolveu uma lista de livros.");
  }

  for (const livro of livros) {
    const item = document.createElement("li");
    const titulo = document.createElement("h3");
    const detalhes = document.createElement("p");
    titulo.textContent = livro.titulo;
    detalhes.textContent = `${livro.autor} · ${livro.ano}`;
    item.append(titulo, detalhes);
    lista.append(item);
  }

  if (livros.length === 0) {
    mensagem.textContent = "Nenhum livro encontrado. Experimente outro título ou autor.";
  } else {
    mensagem.textContent = `Livros encontrados: ${livros.length}.`;
  }
  botaoBuscar.disabled = false;
}

function mostrarErro(erro) {
  lista.textContent = "";
  mensagem.textContent = "Não foi possível buscar. Confira se o servidor PHP está iniciado e tente novamente.";
  mensagem.classList.add("erro");
  botaoBuscar.disabled = false;
  console.error(erro.message);
}

function restaurarBusca() {
  if (ultimaBuscaJSON === "") {
    return;
  }

  // Desserialização: o texto volta a ser um objeto acessível por propriedades.
  const criterio = JSON.parse(ultimaBuscaJSON);
  campoBusca.value = criterio.busca;
  atualizarContador();
  campoBusca.focus();
}
