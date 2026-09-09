const formulario = document.querySelector("#formulario-ficha");
const campoNome = document.querySelector("#nome");
const campoClasse = document.querySelector("#classe");
const campoNivel = document.querySelector("#nivel");
const campoJSON = document.querySelector("#texto-json");
const botaoImportar = document.querySelector("#botao-importar");
const mensagem = document.querySelector("#mensagem");
const cartao = document.querySelector("#cartao");

formulario.addEventListener("submit", gerarFicha);
botaoImportar.addEventListener("click", importarFicha);

function fichaValida(ficha) {
  // JSON válido pode ser null, um número ou uma lista, não apenas um objeto.
  if (ficha === null || typeof ficha !== "object" || Array.isArray(ficha)) {
    return false;
  }
  if (typeof ficha.nome !== "string" || ficha.nome.trim().length < 2 || ficha.nome.trim().length > 30) {
    return false;
  }
  if (ficha.classe !== "Explorador" && ficha.classe !== "Criador" && ficha.classe !== "Guardião") {
    return false;
  }
  if (!Number.isInteger(ficha.nivel) || ficha.nivel < 1 || ficha.nivel > 20) {
    return false;
  }
  return true;
}

function mostrarFicha(ficha) {
  document.querySelector("#nome-personagem").textContent = ficha.nome;
  document.querySelector("#detalhes-personagem").textContent = `${ficha.classe} · Nível ${ficha.nivel}`;
  cartao.hidden = false;
  mensagem.classList.remove("erro");
}

function gerarFicha(evento) {
  evento.preventDefault();
  const ficha = {
    nome: campoNome.value.trim(),
    classe: campoClasse.value,
    nivel: Number(campoNivel.value)
  };

  if (!fichaValida(ficha)) {
    cartao.hidden = true;
    mensagem.textContent = "Confira o nome, a classe e o nível de 1 a 20.";
    mensagem.classList.add("erro");
    return;
  }

  // null e 2 apenas organizam o texto com recuo de dois espaços.
  campoJSON.value = JSON.stringify(ficha, null, 2);
  mostrarFicha(ficha);
  mensagem.textContent = "Ficha gerada. Os dados também estão disponíveis como texto JSON.";
}

function importarFicha() {
  cartao.hidden = true;
  // Se JSON.parse encontrar um erro, catch mostra uma mensagem na página.
  try {
    const dados = JSON.parse(campoJSON.value);
    if (!fichaValida(dados)) {
      mensagem.textContent = "O JSON é válido, mas a ficha precisa de nome com 2 a 30 caracteres, classe permitida e nível inteiro de 1 a 20.";
      mensagem.classList.add("erro");
      return;
    }

    // Aproveitamos somente as três propriedades que pertencem à ficha.
    const ficha = { nome: dados.nome.trim(), classe: dados.classe, nivel: dados.nivel };
    campoNome.value = ficha.nome;
    campoClasse.value = ficha.classe;
    campoNivel.value = ficha.nivel;
    mostrarFicha(ficha);
    mensagem.textContent = "JSON importado. O formulário e o cartão mostram os dados recuperados.";
  } catch (erro) {
    mensagem.textContent = "Texto JSON inválido. Confira aspas, vírgulas e chaves.";
    mensagem.classList.add("erro");
  }
}
