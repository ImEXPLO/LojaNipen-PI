<?php
// Importa o autoload do Composer para carregar as rotas
require __DIR__ . '/../vendor/autoload.php'; // Obrigatório pro projeto.


// Função para renderizar as telas com layout
function render($view, $data = [])
{
    // Extrai os dados recebidos e os transforma em variáveis.
    extract($data);
    ob_start();
    // Inclui a tela que enviamos especifica
    require __DIR__ . '/../app/Views/' . $view;
    $content = ob_get_clean();
    // Inclui o layout base, que usará a variável $content
    require __DIR__ . '/../app/Views/layouts/base.php';
}

function render_sem_template($view, $data = [])
{
    // Extrai os dados recebidos e os transforma em variáveis.
    extract($data);
    ob_start();
    // Inclui a tela que enviamos especifica
    require __DIR__ . '/../app/Views/' . $view;
}

// Obtém a URL do navegador
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// NAVEGAÇÃO GERAL

if ($url == "/" || $url == "/index.php") {
    // require __DIR__ . '/../app/Views/home.php'; Require significa REQUERER UM LINK - ou seja, ele chama o arquivo aí atrás que é o home
    render_sem_template('/home.php', [
        'title' => 'Bem-vindo!',
        'lenda' => 'Agora eu sou uma lêndia do PHP!'
    ]);
} else if ($url == "/sobre") {
    render('sobre.php', ['title' => 'Sobre a Página']);
}


// USUÁRIOS

else if ($url == "/usuarios") {
    render('usuarios/lista_usuarios.php', ['title' => 'Listar Usuários!']);
} else if ($url == "/usuarios/inserir") {
    render('usuarios/form_usuarios.php', ['title' => 'Cadastrar Usuário!']);
}

// PRODUTOS

else if ($url == "/produtos") {
    render('produtos/lista_produtos.php', ['title' => 'Listar Produtos!']);
} else if ($url == "/produtos/inserir") {
    render('produtos/form_produtos.php', ['title' => 'Cadastrar Produto!']);
}
