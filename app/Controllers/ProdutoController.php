<?php

namespace App\Controllers;

// Importa o Model de Usuario
use App\Models\Produto;

class ProdutoController
{

    // Busca os produtos e chama a tela de listar
    public function listar()
    {
        // Chama a model e a função que busca os dados e armazena na var
        $lista_produtos = Produto::buscarTodos();

        render("produtos/lista_produtos.php", [
            'title' => "Lista de Produtos",
            'produtos' => $lista_produtos
        ]);

    }

    public function editar($id) {
        $produto = Produto::buscarPorId($id);

        if (!$produto) {
            header('Location: /produtos');
            exit;
        }

        render("produtos/form_produtos.php", [
            'title' => "Editar Produto",
            'dados' => $produto
        ]);
    }

    // Exclusão Lógica
    public function excluir($id) {
        Produto::softDelete($id);
        header('Location: /produtos');
        exit;
    }
    public function salvar()
    {

        // 1. Primeiro filtro pro ID no nosso BD.
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        // 2. Limpa os dados, remove tudo que não for texto puro 

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

        // Se houver erros, volta ao formulário
        if (!empty($erros)) {
            $_SESSION['erros'] = $erros;
            
            // Guarda o ID e os dados na sessão para não perder o que digitou
            $dados['id_produto'] = $id; // Atenção: Verifique se sua PK é id_produto
            $_SESSION['dados'] = $dados;

            // Redireciona para PRODUTOS (estava usuarios antes)
            if ($id) {
                header('Location: /produtos/editar?id=' . $id);
            } else {
                header('Location: /produtos/inserir');
            }
            exit;
        }

        // Se não houver erros, decide se Salva ou Atualiza
        if ($id) {
            // Tem ID? É Edição!
            // Certifique-se que o método no Model se chama 'update' ou 'atualizar'
            Produto::update($id, $dados);
        } else {
            // Não tem ID? É Criação!
            Produto::salvar($dados);
        }

        // Redireciona para a lista de PRODUTOS
        header('Location: /produtos');
        exit;
    }
}