<?php
$nome = $_POST['nome'];
header('Location: confirmacao.php?nome=' . rawurlencode($nome), true, 303);
exit;
