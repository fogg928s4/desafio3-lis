<?php
// app/Database/DB.php
namespace App\Database;

use PDO;
use PDOException;

class DB {
    private static ?PDO $instance = null;
    
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            $host = '127.0.0.1';
            $dbname = 'survey_app';
            $user = 'dbuser';
            $pass = 'dbpass';
            $charset = 'utf8mb4';
            
            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            
            try {
                self::$instance = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                throw new \Exception('Error de conexión: ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
