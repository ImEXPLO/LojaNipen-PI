<?php 
// Em qual pasta ele está
namespace App\Models;

use PDO; 
use App\Core\Database;

// Mesmo nome do Arquivo
class Usuario {
 
    // Aqui declaramos uma função para cada operação do CRUD

    // Buscar todos os usuários no BD
    public static function buscarTodos(){
        // Primeiro vamos conectar no Banco de Dados
        // Precisamos importar o PDO antes de a classe
        // Como vamos utilizar arquivo DATABASE, importamos ele também
        $pdo = Database::conectar();

        // Geramos o Script SQL de consulta
        $sql = "SELECT * FROM usuarios";

        // Retornamos o resultado da consulta
        return $pdo->query($sql)->fetchAll();
    }
}

?>