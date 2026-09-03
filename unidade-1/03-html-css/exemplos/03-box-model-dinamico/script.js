const formulario = document.querySelector('#controles');
const caixa = document.querySelector('#caixa-alvo');
const conteudoCaixa = document.querySelector('#conteudo-caixa');
const medidas = document.querySelector('#medidas');

const campos = {
  conteudo: document.querySelector('#conteudo'),
  corFundo: document.querySelector('#cor-fundo'),
  corTexto: document.querySelector('#cor-texto'),
  corBorda: document.querySelector('#cor-borda'),
  tipoBorda: document.querySelector('#tipo-borda'),
  largura: document.querySelector('#largura'),
  altura: document.querySelector('#altura'),
  margem: document.querySelector('#margem'),
  padding: document.querySelector('#padding'),
  borda: document.querySelector('#borda'),
  boxSizing: document.querySelector('#box-sizing')
};

const saidas = {
  largura: document.querySelector('#valor-largura'),
  altura: document.querySelector('#valor-altura'),
  margem: document.querySelector('#valor-margem'),
  padding: document.querySelector('#valor-padding'),
  borda: document.querySelector('#valor-borda')
};

function emPixels(valor) {
  return `${valor}px`;
}

function atualizarCaixa() {
  conteudoCaixa.textContent = campos.conteudo.value || 'Caixa sem texto';
  caixa.style.backgroundColor = campos.corFundo.value;
  caixa.style.color = campos.corTexto.value;
  caixa.style.borderColor = campos.corBorda.value;
  caixa.style.borderStyle = campos.tipoBorda.value;
  caixa.style.width = emPixels(campos.largura.value);
  caixa.style.height = emPixels(campos.altura.value);
  caixa.style.margin = emPixels(campos.margem.value);
  caixa.style.padding = emPixels(campos.padding.value);
  caixa.style.borderWidth = emPixels(campos.borda.value);
  caixa.style.boxSizing = campos.boxSizing.value;

  saidas.largura.value = emPixels(campos.largura.value);
  saidas.altura.value = emPixels(campos.altura.value);
  saidas.margem.value = emPixels(campos.margem.value);
  saidas.padding.value = emPixels(campos.padding.value);
  saidas.borda.value = emPixels(campos.borda.value);

  const retangulo = caixa.getBoundingClientRect();
  const margemTotal = Number(campos.margem.value) * 2;
  const larguraOcupada = Math.round(retangulo.width + margemTotal);
  const alturaOcupada = Math.round(retangulo.height + margemTotal);

  medidas.textContent =
    `Caixa visível: ${Math.round(retangulo.width)} × ${Math.round(retangulo.height)} px. ` +
    `Espaço com margens: ${larguraOcupada} × ${alturaOcupada} px.`;
}

formulario.addEventListener('input', atualizarCaixa);
formulario.addEventListener('change', atualizarCaixa);
formulario.addEventListener('reset', () => requestAnimationFrame(atualizarCaixa));

atualizarCaixa();
