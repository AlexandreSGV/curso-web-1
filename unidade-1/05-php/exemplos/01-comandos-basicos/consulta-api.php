<?php
// Este arquivo prepara os dados; o index.php apresenta o resultado.
$publicacao = null;
$erroApi = '';

if (!function_exists('curl_init')) {
    $erroApi = 'Ative a extensão cURL do PHP para executar esta consulta.';
} else {
    $consulta = curl_init('https://jsonplaceholder.typicode.com/posts/1');
    curl_setopt($consulta, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($consulta, CURLOPT_TIMEOUT, 5);

    $texto = curl_exec($consulta);
    $status = curl_getinfo($consulta, CURLINFO_HTTP_CODE);

    if ($texto === false || $status !== 200) {
        $erroApi = 'Não foi possível consultar a API. Verifique a conexão e tente novamente.';
    } else {
        $dados = json_decode($texto, true);

        if (is_array($dados) && isset($dados['title'], $dados['body'])
            && is_string($dados['title']) && is_string($dados['body'])) {
            $publicacao = $dados;
        } else {
            $erroApi = 'A API não devolveu a publicação no formato esperado.';
        }
    }
}
