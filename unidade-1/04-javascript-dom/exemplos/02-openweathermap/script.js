const formulario = document.querySelector("#formulario-tempo");
const campoCidade = document.querySelector("#cidade");
const campoChave = document.querySelector("#chave");
const coordenadas = document.querySelector("#coordenadas");
const botao = document.querySelector("#botao-consultar");
const mensagem = document.querySelector("#mensagem");
const resultado = document.querySelector("#resultado");

// Pontos aproximados. Evitam uma segunda API só para descobrir as coordenadas.
const cidades = {
  recife: { latitude: -8.05, longitude: -34.90 },
  "sao-paulo": { latitude: -23.55, longitude: -46.63 },
  curitiba: { latitude: -25.43, longitude: -49.27 }
};

campoCidade.addEventListener("change", mostrarCoordenadas);
formulario.addEventListener("submit", consultarTempo);

function mostrarCoordenadas(evento) {
  const cidade = cidades[evento.target.value];
  if (cidade) {
    coordenadas.textContent = `Latitude: ${cidade.latitude}; longitude: ${cidade.longitude}.`;
  } else {
    coordenadas.textContent = "Selecione uma cidade.";
  }
}

function consultarTempo(evento) {
  evento.preventDefault();
  if (botao.disabled) {
    return;
  }

  const cidade = cidades[campoCidade.value];
  const chave = campoChave.value.trim();
  resultado.hidden = true;
  mensagem.classList.remove("erro");

  if (!cidade || chave === "") {
    mensagem.textContent = "Selecione a cidade e informe sua chave de teste.";
    mensagem.classList.add("erro");
    return;
  }

  botao.disabled = true;
  mensagem.textContent = "Consultando o tempo...";
  const url = "https://api.openweathermap.org/data/2.5/weather"
    + `?lat=${cidade.latitude}&lon=${cidade.longitude}`
    + `&units=metric&lang=pt_br&appid=${encodeURIComponent(chave)}`;

  fetch(url)
    .then(lerResposta)
    .then(mostrarTempo)
    .catch(mostrarErro);
}

function lerResposta(resposta) {
  if (resposta.status === 401 || resposta.status === 403) {
    throw new Error("Acesso recusado. Confira a chave, sua ativação e a permissão para Current Weather Data.");
  }
  if (resposta.status === 429) {
    throw new Error("Limite de consultas atingido. Consulte os limites da sua conta antes de tentar novamente.");
  }
  if (!resposta.ok) {
    throw new Error(`Falha na consulta: HTTP ${resposta.status}.`);
  }
  return resposta.json();
}

function mostrarTempo(dados) {
  if (!dados.main || !Array.isArray(dados.weather) || dados.weather.length === 0) {
    throw new Error("A API não devolveu os dados meteorológicos esperados.");
  }

  document.querySelector("#local").textContent = dados.name;
  document.querySelector("#descricao").textContent = dados.weather[0].description;
  document.querySelector("#temperatura").textContent = `${dados.main.temp} °C`;
  document.querySelector("#umidade").textContent = `${dados.main.humidity}%`;
  resultado.hidden = false;
  mensagem.textContent = "Consulta concluída para as coordenadas selecionadas.";
  botao.disabled = false;
}

function mostrarErro(erro) {
  resultado.hidden = true;
  mensagem.textContent = erro.message;
  if (erro.name === "TypeError") {
    mensagem.textContent = "Não foi possível conectar. Confira a rede e tente novamente.";
  } else if (erro.name === "SyntaxError") {
    mensagem.textContent = "A resposta recebida não está em JSON válido.";
  }
  mensagem.classList.add("erro");
  botao.disabled = false;
  // Não imprimimos a URL: ela contém a chave informada pelo aluno.
}
