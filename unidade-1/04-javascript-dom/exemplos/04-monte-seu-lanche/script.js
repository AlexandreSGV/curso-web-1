const formulario = document.querySelector("#formulario-pedido");
const campoLanche = document.querySelector("#lanche");
const campoQuantidade = document.querySelector("#quantidade");
const campoBebida = document.querySelector("#bebida");
const mensagem = document.querySelector("#mensagem");
const resultado = document.querySelector("#resultado");

formulario.addEventListener("submit", calcularPedido);
formulario.addEventListener("input", ocultarResultado);
formulario.addEventListener("change", ocultarResultado);

function formatarReais(valor) {
  return `R$ ${valor.toFixed(2).replace(".", ",")}`;
}

function ocultarResultado() {
  resultado.hidden = true;
  mensagem.classList.remove("erro");
  mensagem.textContent = "Opções alteradas. Calcule para atualizar o total.";
}

function calcularPedido(evento) {
  evento.preventDefault();
  // Mesmo no input de número e no select, .value fornece texto.
  const preco = Number(campoLanche.value);
  const quantidade = Number(campoQuantidade.value);
  mensagem.classList.remove("erro");
  resultado.hidden = true;

  if (!Number.isInteger(quantidade) || quantidade < 1 || quantidade > 10) {
    mensagem.textContent = "Informe uma quantidade inteira de 1 a 10.";
    mensagem.classList.add("erro");
    return;
  }

  if (preco !== 16 && preco !== 22 && preco !== 28) {
    mensagem.textContent = "Selecione uma das opções de sanduíche.";
    mensagem.classList.add("erro");
    return;
  }

  let adicional = 0;
  if (campoBebida.checked) {
    adicional = 6;
  }

  const subtotal = (preco + adicional) * quantidade;
  let desconto = 0;
  if (quantidade >= 3) {
    desconto = subtotal * 0.10;
  }
  const total = subtotal - desconto;

  document.querySelector("#subtotal").textContent = formatarReais(subtotal);
  document.querySelector("#desconto").textContent = formatarReais(desconto);
  document.querySelector("#total").textContent = formatarReais(total);
  resultado.hidden = false;
  mensagem.textContent = `Cálculo concluído para ${quantidade} lanche(s). Total: ${formatarReais(total)}. Nenhum pedido foi enviado.`;
}
