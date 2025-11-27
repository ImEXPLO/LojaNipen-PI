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

        $sql = "INSERT INTO produtos (nome, descricao, quantidade, valor_un, categoria)";
        $sql .= " VALUES (:nome, :descricao, :quantidade, :valor_un, :categoria)";

        // Prepara o SQL para ser inserido no BD e limpa códigos maliciosos
        $stmt = $pdo->prepare($sql);

        // Passa as variaveis para o SQL
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
        $stmt->bindParam(':quantidade', $dados['quantidade'], PDO::PARAM_STR);
        $stmt->bindParam(':valor_un', $dados['valor_un'], PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $dados['categoria'], PDO::PARAM_STR);
       
    }catch (PDOException $e){
        echo "Erro ao inserir: " . $e->getMessage();
        exit;
    }
        
    }
}

// Nota: Estou com um problema em conectar/entrar na lista de usuarios - os outros links estão OK - V.