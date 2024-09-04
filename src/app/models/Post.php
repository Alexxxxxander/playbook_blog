<?php
namespace src\app\models;
class Post
{
    private $conn;
    private $table_name = "Post";

    public $id;
    public $name;
    public $text;
    public $author_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET Name=:name, Text=:text, Author_id=:author_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name, \PDO::PARAM_STR);
        $stmt->bindParam(":text", $this->text, \PDO::PARAM_STR);
        $stmt->bindParam(":author_id", $this->author_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readAll()
    {
        $query = "SELECT Post.Id, Post.Name, Post.Text, User.Login AS Author FROM " . $this->table_name . " JOIN User ON Post.Author_id = User.Id
        ORDER BY Post.Id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public  function  search($search){
        $query = "SELECT Id, Name, Text FROM Post WHERE Name LIKE :search OR Text LIKE :search";
        // asd; DROP DATABASE Posts; --
        $stmt = $this->conn->prepare($query);

        $searchTerm = "%$search%";
        $stmt->bindParam(':search', $searchTerm, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public function getById($id){
        $query = "SELECT Post.Id, Post.Name, Post.Text, User.Login AS Author FROM " . $this->table_name .
            " JOIN User ON Post.Author_id = User.Id HAVING Post.Id = :id ORDER BY Post.Id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
