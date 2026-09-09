const formulario = document.querySelector("#formulario-missao");
const campoMissao = document.querySelector("#missao");
const lista = document.querySelector("#missoes");
const mensagem = document.querySelector("#mensagem");
const progresso = document.querySelector("#progresso");

formulario.addEventListener("submit", adicionarMissao);

const iniciais = ["Executar este exemplo", "Modificar uma cor no CSS"];
for (const texto of iniciais) {
  criarMissao(texto);
}
atualizarProgresso();

function adicionarMissao(evento) {
  evento.preventDefault();
  const texto = campoMissao.value.trim();
  mensagem.classList.remove("erro");

  if (texto.length < 3 || texto.length > 80) {
    mensagem.textContent = "Escreva uma missão com 3 a 80 caracteres, sem contar espaços nas pontas.";
    mensagem.classList.add("erro");
    return;
  }

  criarMissao(texto);
  campoMissao.value = "";
  campoMissao.focus();
  mensagem.textContent = "Nova missão adicionada.";
  atualizarProgresso();
}

function criarMissao(texto) {
  const item = document.createElement("li");
  const nome = document.createElement("span");
  nome.classList.add("nome-missao");
  nome.textContent = texto;

  const botaoConcluir = document.createElement("button");
  botaoConcluir.type = "button";
  botaoConcluir.textContent = "Concluir";
  botaoConcluir.setAttribute("aria-pressed", "false");
  botaoConcluir.addEventListener("click", alternarConclusao);

  const botaoRemover = document.createElement("button");
  botaoRemover.type = "button";
  botaoRemover.textContent = "Remover";
  botaoRemover.addEventListener("click", removerMissao);

  item.append(nome, botaoConcluir, botaoRemover);
  lista.append(item);
}

function alternarConclusao(evento) {
  const botao = evento.target;
  const item = botao.parentElement; // O botão está diretamente dentro do li.
  item.classList.toggle("concluida");
  const concluida = item.classList.contains("concluida");
  botao.setAttribute("aria-pressed", String(concluida));

  if (concluida) {
    botao.textContent = "Reabrir";
  } else {
    botao.textContent = "Concluir";
  }
  atualizarProgresso();
}

function removerMissao(evento) {
  const item = evento.target.parentElement;
  item.remove();
  mensagem.classList.remove("erro");
  mensagem.textContent = "Missão removida.";
  atualizarProgresso();
}

function atualizarProgresso() {
  const itens = document.querySelectorAll("#missoes li");
  let concluidas = 0;
  for (const item of itens) {
    if (item.classList.contains("concluida")) {
      concluidas++;
    }
  }
  progresso.textContent = `${concluidas} de ${itens.length} missões concluídas.`;
}
