<?php

namespace App\Core;
use PDO;
use PDOException;

class Conexao{
    public static function connection() :PDO
    {

        $driver = $_ENV['DB_CONNECTION'];
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $dbName = $_ENV['DB_DATABASE'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        $conf = [
            // Define o charset da conexão para evitar problemas com acentos e emojis
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
            // Faz o PDO lançar exceções quando ocorrer erro no banco
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Usa prepared statements reais do MySQL (mais seguro e rápido)
            PDO::ATTR_EMULATE_PREPARES => false,
            // Retorna resultados como arrays associativos por padrão
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // Mantém a conexão aberta para economizar tempo em novas requisições
            PDO::ATTR_PERSISTENT => true
        ];

        try{
            $conexao = new PDO(
                $driver.":host=".$host.";port=".$port.";dbname=".$dbName,
                $user,
                $password,
                $conf
            );
            return $conexao;
        }catch(PDOException $e){
            throw new \RunTimeException ("Erro ao conectar ao banco de dados : ".$e->getMessage());
        }
    }
}