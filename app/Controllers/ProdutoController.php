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
    public function salvar()
    {
        // 1. Limpa os dados, remove tudo que não for texto puro 
    
        $dados = [
            'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'descricao' => filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS),
            'quantidade' => filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_SPECIAL_CHARS),
            'valor_un' => filter_input(INPUT_POST, 'valor_un', FILTER_SANITIZE_SPECIAL_CHARS),
            'categoria' => filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        // Cria a Lista de Erros
        $erros = [];

        // Verifica se o nome está vazio
        if (empty($dados['nome'])) {
            $erros[] = 'O campo NOME não pode ficar em branco!';
        } else if (strlen($dados['nome']) < 4) {
            $erros[] = 'O campo NOME deve ser mais que 3 caracteres!';
        }

        // Se não houver erros, salva
        if (empty($erros)) {
            $id = Produto::salvar($dados);
           // header('Location: /usuarios');
        } else {
            // Se houve erros, volta ao formulário
            $_SESSION['erros'] = $erros;
            $_SESSION['dados'] = $dados;
            // header('Location: /usuarios/inserir');
        }
    }
}


?>