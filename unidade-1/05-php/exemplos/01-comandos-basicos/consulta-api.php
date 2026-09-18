<?php
$texto = file_get_contents('https://jsonplaceholder.typicode.com/posts/1');
$publicacao = json_decode($texto, true);
