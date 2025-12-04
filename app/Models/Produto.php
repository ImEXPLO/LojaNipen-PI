<?php
// Em qual pasta ele está

// O "namespace" cria "containers" que ajudam a organizar elementos de códigos relacionados, como classes, interfaces e funções com o objetivo de evitar conflitos de nomes caso tenha-se várias bibliotecas ou frameworks.
namespace App\Models;

use PDO;
use App\Core\Database;
use PDOException;

// PDO é uma extensão do PHP orientada a objetos que fornece uma camada de abstração padronizada para acessar banco de dados, no nosso caso, o SQL/Workbench.

// o PDOExcepction fornece informações detalhadas sobre erros na operação da database, incluindo erros de drivers, erros de banco de dados e mensagens.

// Mesmo nome do Arquivo
class Produto
{

    // Aqui declaramos uma função para cada operação do CRUD
    // Buscar todos os usuários no BD
    public static function buscarTodos()
    {
        try {
            $pdo = Database::conectar();
            $sql = "SELECT * FROM produtos WHERE deleted_at IS NULL";
            // Retornamos o resultado da consulta
            return $pdo->query($sql)->fetchAll();
        } catch (PDOException $e) {
            echo "<h2>Erro ao Listar Produtos</h2>";
            echo "<p>" . $e->getMessage() . "</p>";
            exit;
        }

        // Colocamos Try/Catch pra log para erros - coisa que aqui no Dev em casa apareceu
        // Diversos :) (Alegria)

    }

    // Buscar por ID (filtra os deletados)

    public static function buscarPorId($id)
    {
        try {
            $pdo = Database::conectar();
            $sql = "SELECT * FROM produtos WHERE id_produto = :id AND deleted_at IS NULL";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "<h2>Erro ao Buscar Produto</h2>";
            echo "<p>" . $e->getMessage() . "</p>";
            exit;
        }
    }

    // Função de Salvar
    public static function salvar($dados)
    {
        try {
            $pdo = Database::conectar();

            $sql = "INSERT INTO produtos (nome, descricao, quantidade, valor_un, categoria)";
            $sql .= " VALUES (:nome, :descricao, :quantidade, :valor_un, :categoria)";


            $stmt = $pdo->prepare($sql);


            //"stmt" significa "statement", ou "declaração". a "bindParam" serve para conectar um parametro para uma variavel em específica, nesse caso, a stmt, que está declarando as variáveis de dados para nome, descrição, quantidade...

            // PARAM_STR é uma constante predefinida usada para especificar o tipo de dados de um parametro ao associar valores a uma instrução preparada. Nesse casoa, representa tipos de dados do SQL, como CHAR, VARCHAR, etc.
            $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
            $stmt->bindParam(':quantidade', $dados['quantidade'], PDO::PARAM_STR);
            $stmt->bindParam(':valor_un', $dados['valor_un'], PDO::PARAM_STR);
            $stmt->bindParam(':categoria', $dados['categoria'], PDO::PARAM_STR);

            $stmt->execute();
            return $pdo->lastInsertId();

            //O "lasInsertId" resgata a última informação fornecida ao banco de dados.


            // O "getMessage" recupera a mensagem descritiva associada a uma exceção que foi lançada. Esse método permite acessar essa mensagem para depuração, registro em log ou exibição ao usuário, e é principalmente usado com objetos de excessão (PDOExpection se transformando em uma variável como $e).
        } catch (PDOException $e) {
            echo "<h2>Erro ao Salvar no BD</h2>";
            echo "<p>" . $e->getMessage() . "</p>";
            exit;
        }
    }
    // 4. Função de Atualizar (Update no BD)

    public static function update($id, $dados)
    {

        try {
            $pdo = Database::conectar();

            $sql = "UPDATE produtos SET 
                nome = :nome, 
                descricao = :descricao, 
                quantidade = :quantidade, 
                valor_un = :valor_un, 
                categoria = :categoria,
                updated_at = NOW() 
                WHERE id_produto = :id";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':descricao', $dados['descricao']);
            $stmt->bindParam(':quantidade', $dados['quantidade']);
            $stmt->bindParam(':valor_un', $dados['valor_un']);
            $stmt->bindParam(':categoria', $dados['categoria']);

            return $stmt->execute();

        } catch (PDOException $e) {
            echo "<h2>Erro ao Atualizar</h2>";
            echo "<p>" . $e->getMessage() . "</p>";
        }
    }
    // 5. Soft Delete ou Delete Lógico pros mais chegados.

    public static function softDelete($id)
    {
        try {
            $pdo = Database::conectar();
            $sql = "UPDATE produtos SET deleted_at = NOW() WHERE id_produto = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao Excluir: " . $e->getMessage();
            exit;
        }
    }

    public static function fisicalDelete($id)
    { //copypaste do usuario.php
        try {
            $pdo = Database::conectar();
            $sql = "DELETE FROM produtos WHERE id_produto = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao Excluir Permanentemente: " . $e->getMessage();
            exit;
        }
    }
}