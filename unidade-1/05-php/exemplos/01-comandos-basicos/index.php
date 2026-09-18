<?php
$nome = 'Ana';
$quantidade = 3;
$preco = 12.50;
$disponivel = true;
const NOME_LOJA = 'Papelaria da turma';

$produto = [
    'nome' => 'Caderno',
    'categoria' => 'Material escolar',
    'estoque' => 12
];

$cores = ['Azul', 'Verde'];
$cores[] = 'Roxo';

function calcularTotal($preco, $quantidade)
{
    return $preco * $quantidade;
}

$total = calcularTotal($preco, $quantidade);
require 'consulta-api.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>Comandos básicos de PHP</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
<main>
  <h1>Comandos básicos de PHP</h1>
  <p>Leia o index.php e compare cada trecho com o resultado apresentado.</p>

  <section>
    <h2>Variáveis, textos e operações</h2>
    <p><?php echo "Olá, $nome!"; ?></p>
    <p><?= NOME_LOJA ?></p>
    <p><?php echo 'Quantidade: ' . $quantidade; ?></p>
    <p>Total calculado pela função: <?= $total ?></p>
    <p>Valor e tipo de uma variável, usando <code>var_dump()</code>:</p>
    <pre><?php var_dump($disponivel); ?></pre>
  </section>

  <section>
    <h2>Uma condição</h2>
    <?php if ($disponivel): ?>
      <p>Produto disponível.</p>
    <?php else: ?>
      <p>Produto indisponível.</p>
    <?php endif; ?>
  </section>

  <section>
    <h2>Array associativo e foreach</h2>
    <table>
      <caption>Dados do produto</caption>
      <thead><tr><th scope="col">Campo</th><th scope="col">Valor</th></tr></thead>
      <tbody>
        <?php foreach ($produto as $campo => $valor): ?>
          <tr>
            <th scope="row"><?= $campo ?></th>
            <td><?= $valor ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>

  <section>
    <h2>Array com índices numéricos</h2>
    <p>Quantidade de cores: <?= count($cores) ?></p>
    <ul>
      <?php foreach ($cores as $cor): ?>
        <li><?= $cor ?></li>
      <?php endforeach; ?>
    </ul>
    <p>Contagem com <code>for</code>:
      <?php for ($numero = 1; $numero <= 3; $numero++): ?>
        <strong><?= $numero ?> </strong>
      <?php endfor; ?>
    </p>
  </section>

  <section>
    <h2>JSONPlaceholder: consulta feita pelo servidor</h2>
    <p>O consulta-api.php faz uma requisição GET e converte o JSON em array.</p>
    <article>
      <h3><?= $publicacao['title'] ?></h3>
      <p><?= $publicacao['body'] ?></p>
    </article>
  </section>
</main>
</body>
</html>
