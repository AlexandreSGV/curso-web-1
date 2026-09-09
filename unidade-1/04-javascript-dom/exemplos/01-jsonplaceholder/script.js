const formularioConsulta = document.querySelector("#formulario-consulta");
const campoUsuario = document.querySelector("#usuario");
const botaoConsultar = document.querySelector("#botao-consultar");
const mensagemConsulta = document.querySelector("#mensagem-consulta");
const lista = document.querySelector("#publicacoes");

const formularioPublicacao = document.querySelector("#formulario-publicacao");
const campoTitulo = document.querySelector("#titulo");
const campoTexto = document.querySelector("#texto");
const botaoEnviar = document.querySelector("#botao-enviar");
const mensagemEnvio = document.querySelector("#mensagem-envio");
const jsonEnviado = document.querySelector("#json-enviado");
const jsonRecebido = document.querySelector("#json-recebido");

formularioConsulta.addEventListener("submit", consultarPublicacoes);
formularioPublicacao.addEventListener("submit", enviarPublicacao);

function consultarPublicacoes(evento) {
  evento.preventDefault();
  if (botaoConsultar.disabled) {
    return;
  }

  const usuario = Number(campoUsuario.value);
  lista.textContent = "";
  mensagemConsulta.classList.remove("erro");

  if (!Number.isInteger(usuario) || usuario < 1) {
    mensagemConsulta.textContent = "Informe um número inteiro maior que zero.";
    mensagemConsulta.classList.add("erro");
    return;
  }

  botaoConsultar.disabled = true;
  mensagemConsulta.textContent = "Carregando publicações...";

  // Padrão de consulta: pedir, ler JSON, apresentar ou informar falha.
  fetch(`https://jsonplaceholder.typicode.com/posts?userId=${usuario}`)
    .then(lerResposta)
    .then(mostrarPublicacoes)
    .catch(mostrarErroConsulta);
}

function lerResposta(resposta) {
  if (!resposta.ok) {
    throw new Error(`A API respondeu com HTTP ${resposta.status}.`);
  }
  return resposta.json();
}

function mostrarPublicacoes(publicacoes) {
  if (!Array.isArray(publicacoes)) {
    throw new Error("A API não devolveu a lista esperada.");
  }

  for (const publicacao of publicacoes) {
    const item = document.createElement("li");
    const titulo = document.createElement("h3");
    const texto = document.createElement("p");
    titulo.textContent = publicacao.title;
    texto.textContent = publicacao.body;
    item.append(titulo, texto);
    lista.append(item);
  }

  if (publicacoes.length === 0) {
    mensagemConsulta.textContent = "Nenhuma publicação para esse usuário.";
  } else {
    mensagemConsulta.textContent = `Publicações encontradas: ${publicacoes.length}.`;
  }
  botaoConsultar.disabled = false;
}

function mostrarErroConsulta(erro) {
  lista.textContent = "";
  mensagemConsulta.textContent = "Não foi possível consultar. Verifique a conexão e tente novamente.";
  mensagemConsulta.classList.add("erro");
  botaoConsultar.disabled = false;
  console.error(erro.message);
}

function enviarPublicacao(evento) {
  evento.preventDefault();
  if (botaoEnviar.disabled) {
    return;
  }

  const titulo = campoTitulo.value.trim();
  const texto = campoTexto.value.trim();
  mensagemEnvio.classList.remove("erro");
  jsonEnviado.textContent = "Nenhum envio realizado.";
  jsonRecebido.textContent = "Nenhuma resposta recebida.";

  // O HTML valida primeiro; o JS também verifica o texto sem espaços nas pontas.
  if (titulo.length < 3 || titulo.length > 100 || texto.length < 10 || texto.length > 500) {
    mensagemEnvio.textContent = "Informe um título de 3 a 100 caracteres e um texto de 10 a 500 caracteres.";
    mensagemEnvio.classList.add("erro");
    return;
  }

  const publicacao = { title: titulo, body: texto, userId: 1 };
  const textoJSON = JSON.stringify(publicacao);
  jsonEnviado.textContent = textoJSON;
  botaoEnviar.disabled = true;
  mensagemEnvio.textContent = "Enviando publicação fictícia...";

  fetch("https://jsonplaceholder.typicode.com/posts", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: textoJSON
  })
    .then(lerResposta)
    .then(mostrarEnvio)
    .catch(mostrarErroEnvio);
}

function mostrarEnvio(publicacao) {
  // Apenas formata o objeto para exibição; não faz outra requisição.
  jsonRecebido.textContent = JSON.stringify(publicacao, null, 2);
  mensagemEnvio.textContent = `Simulação concluída. ID devolvido: ${publicacao.id}. Nada foi salvo permanentemente.`;
  botaoEnviar.disabled = false;
}

function mostrarErroEnvio(erro) {
  mensagemEnvio.textContent = "Falha no envio. Verifique a conexão e tente novamente.";
  mensagemEnvio.classList.add("erro");
  botaoEnviar.disabled = false;
  console.error(erro.message);
}
