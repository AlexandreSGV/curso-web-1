<?php
require __DIR__ . '/../inicio.php';
exigir_login();
exigir_post();

$_SESSION = [];
session_destroy();
setcookie(session_name(), '', time() - 3600, '/');
ir('/');
