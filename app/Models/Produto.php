<?php 
// Em qual pasta ele está
namespace App\Models;

use PDO; 
use App\Core\Database;
use PDOException;

// Mesmo nome do Arquivo
class Produto {
 
    // Aqui declaramos uma função para cada operação do CRUD

    // Buscar todos os usuários no BD
    public static function buscarTodos(){
        // Primeiro vamos conectar no Banco de Dados
        // Precisamos importar o PDO antes de a classe
        // Como vamos utilizar arquivo DATABASE, importamos ele também
        $pdo = Database::conectar();

        // Geramos o Script SQL de consulta
        $sql = "SELECT * FROM produtos";

        // Retornamos o resultado da consulta
        return $pdo->query($sql)->fetchAll();
    }

    public static function salvar($dados){
       try{
        $pdo = Database::conectar();

        $senha_criptografada = password_hash($dados['senha'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO produtos (nome, cpf, data_nascimento, celular, rua, numero, complemento, bairro, cidade, cep, estado, email, nivel_acesso, genero, senha)";
        $sql .= " VALUES (:nome, :cpf, :data_nascimento, :celular, :rua, :numero, :complemento, :bairro, :cidade, :cep, :estado, :email, :nivel_acesso, :genero, :senha)";

        // Prepara o SQL para ser inserido no BD e limpa códigos maliciosos
        $stmt = $pdo->prepare($sql);

        // Passa as variaveis para o SQL
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
       
    }catch (PDOException $e){
        echo "Erro ao inserir: " . $e->getMessage();
        exit;
    }
        
    }
}