const formulario = document.querySelector("#formulario-palpite");
const campoPalpite = document.querySelector("#palpite");
const botaoJogar = document.querySelector("#botao-jogar");
const botaoReiniciar = document.querySelector("#botao-reiniciar");
const mensagem = document.querySelector("#mensagem");
const contador = document.querySelector("#tentativas");
const historico = document.querySelector("#historico");

const limite = 5;
let segredo = sortearNumero();
let tentativas = 0;
let encerrado = false;

formulario.addEventListener("submit", conferirPalpite);
botaoReiniciar.addEventListener("click", reiniciarJogo);

function sortearNumero() {
  // Math.random() produz um número entre 0 (inclusive) e 1 (exclusive).
  // Multiplicar por 20, arredondar para baixo e somar 1 produz de 1 a 20.
  return Math.floor(Math.random() * 20) + 1;
}

function conferirPalpite(evento) {
  evento.preventDefault();
  if (encerrado) {
    return;
  }

  const palpite = Number(campoPalpite.value);
  mensagem.classList.remove("erro");
  if (!Number.isInteger(palpite) || palpite < 1 || palpite > 20) {
    mensagem.textContent = "Digite um número inteiro de 1 a 20.";
    mensagem.classList.add("erro");
    return;
  }

  tentativas++;
  const item = document.createElement("li");
  item.textContent = `Palpite: ${palpite}`;
  historico.append(item);
  contador.textContent = `Tentativas restantes: ${limite - tentativas}.`;

  if (palpite === segredo) {
    mensagem.textContent = `Acertou! O número era ${segredo}. Você usou ${tentativas} tentativa(s).`;
    mensagem.classList.add("sucesso");
    encerrarJogo();
  } else if (tentativas === limite) {
    mensagem.textContent = `Fim das tentativas. O número era ${segredo}. Experimente um novo jogo!`;
    encerrarJogo();
  } else if (palpite < segredo) {
    mensagem.textContent = "O número secreto é maior. Tente novamente!";
  } else {
    mensagem.textContent = "O número secreto é menor. Tente novamente!";
  }

  if (!encerrado) {
    campoPalpite.value = "";
    campoPalpite.focus();
  }
}

function encerrarJogo() {
  encerrado = true;
  campoPalpite.disabled = true;
  botaoJogar.disabled = true;
}

function reiniciarJogo() {
  segredo = sortearNumero();
  tentativas = 0;
  encerrado = false;
  historico.textContent = "";
  campoPalpite.value = "";
  campoPalpite.disabled = false;
  botaoJogar.disabled = false;
  mensagem.classList.remove("erro", "sucesso");
  mensagem.textContent = "Novo número sorteado. Faça seu primeiro palpite.";
  contador.textContent = `Tentativas restantes: ${limite}.`;
  campoPalpite.focus();
}
