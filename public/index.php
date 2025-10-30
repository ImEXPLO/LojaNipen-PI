<?php
// Importa o autoload do Composer para carregar as rotas
require __DIR__ . '/../vendor/autoload.php'; // Obrigatório pro projeto.

// Obtém a URL do navegador
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

echo $url;

if ($url == "/"){
    require __DIR__ . '/../app/Views/home.php'; // Require significa REQUERER UM LINK - ou seja, ele chama o arquivo aí atrás que é o home
}