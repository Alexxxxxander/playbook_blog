<?php
namespace src\app\config;

use PDO;
use PDOException;

class Database {
    private $host = "db";  // Имя хоста базы данных (контейнер db в docker-compose)
    private $db_name = "nzblog";  // Имя базы данных
    private $username = "root";  // Имя пользователя базы данных
    private $password = "12345";  // Пароль пользователя базы данных
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            // Подключение к базе данных MariaDB с использованием PDO
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Включаем исключения для обработки ошибок
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // Устанавливаем режим выборки по умолчанию
                    PDO::ATTR_PERSISTENT => true  // Включаем постоянные соединения
                ]
            );
            $this->conn->exec("set names utf8mb4");  // Устанавливаем кодировку соединения
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
