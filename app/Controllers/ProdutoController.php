<?php 

namespace App\Controllers;

// Importa o Model de Usuario
use App\Models\Produto;

class ProdutoController{

    // Busca os produtos e chama a tela de listar
    public function listar(){
        // Chama a model e a função que busca os dados e armazena na var
        $lista_produtos = Produto::buscarTodos();

        render("produtos/lista_produtos.php", [
            'title' => "Lista de Produtos",
            'produtos' => $lista_produtos
        ]); 

    }
}

?>