<?php
namespace src\app\models;
use PDO;

class User
{
    private $conn;
    private $table_name = "User";

    public $id;
    public $login;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET Login=:login, Password=:password";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":login", $this->login,\PDO::PARAM_STR);
        $stmt->bindParam(":password", $this->password);

        if ($stmt->execute()) {
            return  $this->conn-> lastInsertId();
        }
        return false;
    }

    public function login()
    {
        $query = "SELECT Id, Password FROM " . $this->table_name . " WHERE Login = :login";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":login", $this->login, \PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && $user['Password'] === md5($this->password)) {
            $this->id = $user['Id'];
            return true;
        }

        return false;
    }

    public function getById($Id){
        $query = "SELECT * FROM " . $this->table_name . " WHERE Id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
