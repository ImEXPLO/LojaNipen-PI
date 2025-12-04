<?php
// O "namespace" cria "containers" que ajudam a organizar elementos de códigos relacionados, como classes, interfaces e funções com o objetivo de evitar conflitos de nomes caso tenha-se várias bibliotecas ou frameworks.
namespace App\Controllers;

// Importa o Model de Usuario
use App\Models\Usuario;

class UsuarioController
{

    // Busca os usuarios e chama a tela de listar
    public function listar()
    {
        // Chama a model e a função que busca os dados e armazena na var
        $lista_usuarios = Usuario::buscarTodos();


        // O "render" de modo geral é uma função de renderização ou até mesmo um método que é responsavel por gerar e retornar uma saída de uma visualização ou modelo.
        render("usuarios/lista_usuarios.php", [
            'title' => "Lista de Usuários",
            'usuarios' => $lista_usuarios
        ]);
    }

    public function editar($id)
    {
        $usuario = Usuario::buscarPorId($id);

        if (!$usuario) {
            header('Location: /usuarios');
            exit;
        }

        render("usuarios/form_usuarios.php", [
            'title' => "Editar Usuário",
            'dados' => $usuario
        ]);
    }

    public function excluir($id)
    {
        Usuario::softDelete($id);
        header('Location: /usuarios');
        exit;
    }

    public function excluirFisico($id) {
        Usuario::fisicalDelete($id);
        header('Location: /usuarios');
        exit;
    }

    public function salvar()
    {

        // Verifica se veio um ID (campo oculto do form)
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        // 1. Limpa os dados, remove tudo que não for texto puro 
        $dados = [
            'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'cpf' => filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS),
            'data_nascimento' => $_POST['data_nascimento'] ?? '',
            'celular' => filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS),
            'rua' => filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS),
            'numero' => filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS),
            'complemento' => filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_SPECIAL_CHARS),
            'bairro' => filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS),
            'cidade' => filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS),
            'cep' => filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS),
            'estado' => filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'nivel_acesso' => filter_input(INPUT_POST, 'nivel_acesso', FILTER_DEFAULT),
            'genero' => filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS),
            'senha' => filter_input(INPUT_POST, 'senha', FILTER_DEFAULT)
        ];

        // Cria a Lista de Erros
        $erros = [];

        // Verificação do nome estar vazio e também sobre caracteres minimos.

        if (empty($dados['nome'])) {
            $erros[] = 'O campo NOME não pode ficar em branco!';
        } else if (strlen($dados['nome']) < 4) {
            $erros[] = 'O campo NOME deve ser mais que 3 caracteres!';
        }

        // Se não houver erros, salva
        // Se houver erros, volta para o formulário
        if (!empty($erros)) {
            $_SESSION['erros'] = $erros;
            
            // Guarda os dados na sessão para não perder o que foi digitado
            // Importante: garante que o ID volte junto
            $dados['id_usuario'] = $id;
            $_SESSION['dados'] = $dados;

            // Decide para onde voltar (Edição ou Cadastro Novo)
            if ($id) {
                header('Location: /usuarios/editar?id=' . $id);
            } else {
                header('Location: /usuarios/inserir');
            }
            exit;
        }

        if ($id) {
            // Tem ID? Então é UPDATE
            Usuario::atualizar($id, $dados);
        } else {
            // Não tem ID? Então é CREATE
            Usuario::salvar($dados);
        }

        header('Location: /usuarios');
        exit;
    }
}

