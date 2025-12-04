<?php

namespace App\Core;

use PDO;
use PDOException;

// PDO é uma extensão do PHP orientada a objetos que fornece uma camada de abstração padronizada para acessar banco de dados, no nosso caso, o SQL/Workbench.

// o PDOExcepction fornece informações detalhadas sobre erros na operação da database, incluindo erros de drivers, erros de banco de dados e mensagens.


// Na Fatec usar $banco = lojanipen - Em casa (Victor), usar $banco = loja_nipen
class Database {
    public static function conectar() {
        $host = '127.0.0.1';
        $porta = '3306';
        $banco = 'loja_nipen';
        $usuario = 'root';
        $senha = '';
        
        $dsn = "mysql:host=$host;port=$porta;dbname=$banco;charset=utf8";
        
        try {
            return new PDO($dsn, $usuario, $senha, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}