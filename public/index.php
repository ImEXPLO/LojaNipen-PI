<?php
session_start(); // Inicia a sessão

// Importa o autoload do Composer para carregar as rotas
require __DIR__ . '/../vendor/autoload.php'; // Obrigatório pro projeto.

use App\Controllers\UsuarioController;
use App\Controllers\ProdutoController;
use App\Models\Usuario;
use App\Models\Produto;

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
$usuarioCtrl = new UsuarioController(); // Trocamos a variável do UsuarioController pra compatibilizar com as outras páginas
$produtoCtrl = new ProdutoController(); // Mesmo esquema do de cima.

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


// USUÁRIOS - ROTAS
else if ($url == "/usuarios") {
    // Cria uma instancia do Controller e chama a função de listar
    $usuarioCtrl->listar();

} else if ($url == "/usuarios/inserir") {
    render('usuarios/form_usuarios.php', ['title' => 'Cadastrar Usuário!', 'dados' => []]);
} else if ($url == "/usuarios/editar") {
    // Essa é a rota de Edição
    if (isset($_GET['id'])) {
        $usuarioCtrl->editar($_GET['id']);
    } else {
        header('Location: /usuarios');
    }
} else if ($url == "/usuarios/excluir") {
    // Essa é a rota de Exclusão Lógica
    if (isset($_GET['id'])) {
        $usuarioCtrl->excluir($_GET['id']);
    } else {
        header('Location: /usuarios');
    }
} else if ($url == "/usuarios/salvar" && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarioCtrl->salvar();
}
          // "&&" é um operador lógico, podendo ser entendido como "e", ou "and". É avaliado como verdadeiro somente se ambos os seus operandos forem verdadeiros. Ele é avaliado como falso se algum dos operandos for falso, resultando em um resultado falso

// PRODUTOS - ROTAS
else if ($url == "/produtos") {
    $produtoCtrl->listar();
} 
else if ($url == "/produtos/inserir") {
    render('produtos/form_produtos.php', ['title' => 'Cadastrar Produto!', 'dados'=> []]);
} 
else if ($url == "/produtos/editar") {
    // Essa é a rota de Edição
    if (isset($_GET['id'])) {
        $produtoCtrl->editar($_GET['id']);
    } else {
        header('Location: /produtos');
    }
}

else if ($url == "/produtos/excluir") {
    // Essa é rota de Exclusão Lógica
    if (isset($_GET['id'])) {
        $produtoCtrl->excluir($_GET['id']);
    } else {
        header('Location: /produtos');
    }
}
else if ($url == "/produtos/salvar" && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Rota do Salvar
    $produtoCtrl->salvar();
} 
// PAGINA 404 SIMPLES

else {
    echo "<h1>Erro 404 - Page Not Found - Try De Novo Despois!</h1>";
}
