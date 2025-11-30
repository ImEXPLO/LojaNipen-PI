<?php
// Em qual pasta ele está
namespace App\Models;

use PDO;
use App\Core\Database;
use PDOException;

// Mesmo nome do Arquivo
class Usuario
{

    // Aqui declaramos uma função para cada operação do CRUD

    // Buscar todos os usuários no BD
    public static function buscarTodos()
    {
        // Primeiro vamos conectar no Banco de Dados
        // Precisamos importar o PDO antes de a classe
        // Como vamos utilizar arquivo DATABASE, importamos ele também
        $pdo = Database::conectar();

        // Geramos o Script SQL de consulta
        $sql = "SELECT * FROM usuarios WHERE deleted_at IS NULL"; // Adicionado o "WHERE deleted_at IS NULL"
                                                                  // Existente no Repo do Professor.
        // Retornamos o resultado da consulta
        return $pdo->query($sql)->fetchAll();
    }

    // Função buscarPorID = Como o próprio nome já diz, serve para
    // Buscar pelo id de usuário.

    public static function buscarPorId($id)
    {
        $pdo = Database::conectar();

        // Garante que não dá pra editar alguém excluído
        // Com ajuda do repo existente - adicionamos um extra na função que seria filtrar as buscas com
        // somente usuários existentes.

        $sql = "SELECT * FROM usuarios WHERE id_usuario = :id AND deleted_at IS NULL";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Função buscarPorEmail = Como o próprio nome já diz, serve para
    // Buscar pelo email do usuário.

    public static function buscarPorEmail($email)
    {
        $pdo = Database::conectar();
        $sql = "SELECT * FROM usuarios WHERE email = :email AND deleted_at IS NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Funções de Salvar, Editar, Exclusão Lógica e Exclusão Física.

    public static function salvar($dados)
    {
        try {
            $pdo = Database::conectar();

            $senha_criptografada = password_hash($dados['senha'], PASSWORD_BCRYPT);

            $sql = "INSERT INTO usuarios (nome, cpf, data_nascimento, celular, rua, numero, complemento, bairro, cidade, cep, estado, email, nivel_acesso, genero, senha)";
            $sql .= " VALUES (:nome, :cpf, :data_nascimento, :celular, :rua, :numero, :complemento, :bairro, :cidade, :cep, :estado, :email, :nivel_acesso, :genero, :senha)";

            // Prepara o SQL para ser inserido no BD e limpa códigos maliciosos
            $stmt = $pdo->prepare($sql);

            // Passa as variaveis para o SQL
            $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
            $stmt->bindParam(':data_nascimento', $dados['data_nascimento'], PDO::PARAM_STR);
            $stmt->bindParam(':celular', $dados['celular'], PDO::PARAM_STR);
            $stmt->bindParam(':rua', $dados['rua'], PDO::PARAM_STR);
            $stmt->bindParam(':numero', $dados['numero'], PDO::PARAM_STR);
            $stmt->bindParam(':complemento', $dados['complemento'], PDO::PARAM_STR);
            $stmt->bindParam(':bairro', $dados['bairro'], PDO::PARAM_STR);
            $stmt->bindParam(':cidade', $dados['cidade'], PDO::PARAM_STR);
            $stmt->bindParam(':cep', $dados['cep'], PDO::PARAM_STR);
            $stmt->bindParam(':estado', $dados['estado'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $dados['email'], PDO::PARAM_STR);
            $stmt->bindParam(':nivel_acesso', $dados['nivel_acesso'], PDO::PARAM_STR);
            $stmt->bindParam(':genero', $dados['genero'], PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha_criptografada);

            // Executa o SQL

            $stmt->execute();
            // Retorna o ID de Registro no BD
            return (int) $pdo->lastInsertId();

        } catch (PDOException $e) {
            echo "Erro ao inserir: " . $e->getMessage();
            exit;
        }

    }

    // Atualiza um usuário existente
    public static function atualizar($id, $dados)
    {
        $pdo = Database::conectar();

        // Verifica se a senha foi fornecida para atualização
        if (!empty($dados['senha'])) {
            $sql = "UPDATE usuarios SET
                nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento,
                celular = :celular, rua = :rua, numero = :numero,
                complemento = :complemento, bairro = :bairro, cidade = :cidade,
                cep = :cep, estado = :estado, email = :email,
                nivel_acesso = :nivel_acesso, genero = :genero, senha = :senha, updated_at = NOW()
                WHERE id_usuario = :id";

            $senha_hash = password_hash($dados['senha'], PASSWORD_BCRYPT);

        } else {
            $sql = "UPDATE usuarios SET
                nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento,
                celular = :celular, rua = :rua, numero = :numero,
                complemento = :complemento, bairro = :bairro, cidade = :cidade,
                cep = :cep, estado = :estado, email = :email,
                nivel_acesso = :nivel_acesso, genero = :genero, updated_at = NOW()
                WHERE id_usuario = :id";
        }

        $stmt = $pdo->prepare($sql);

        // Associa os parâmetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
        $stmt->bindParam(':data_nascimento', $dados['data_nascimento']);
        $stmt->bindParam(':celular', $dados['celular'], PDO::PARAM_STR);
        $stmt->bindParam(':rua', $dados['rua'], PDO::PARAM_STR);
        $stmt->bindParam(':numero', $dados['numero'], PDO::PARAM_STR);
        $stmt->bindParam(':complemento', $dados['complemento'], PDO::PARAM_STR);
        $stmt->bindParam(':bairro', $dados['bairro'], PDO::PARAM_STR);
        $stmt->bindParam(':cidade', $dados['cidade'], PDO::PARAM_STR);
        $stmt->bindParam(':cep', $dados['cep'], PDO::PARAM_STR);
        $stmt->bindParam(':estado', $dados['estado'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $dados['email'], PDO::PARAM_STR);
        $stmt->bindParam(':genero', $dados['genero'], PDO::PARAM_STR);
        $stmt->bindParam(':nivel_acesso', $dados['nivel_acesso'], PDO::PARAM_STR);

        // Só se pode fazer bindParam de uma variável que existe dentro do texto $sql. Por isso não tem senha aqui.


        if (!empty($dados['senha'])) {
            $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
        }

        return $stmt->execute();
    }

    // Exclusão lógica (soft delete)
    public static function softDelete($id)
    {
        $pdo = Database::conectar();
        $sql = "UPDATE usuarios SET deleted_at = NOW() WHERE id_usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Exclusão física (não recomendada para produção)
    public static function fisicalDelete($id)
    {
        $pdo = Database::conectar();
        $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}