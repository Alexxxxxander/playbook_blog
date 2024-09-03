<?php
namespace src\app\controllers;
use src\app\config\Database;
use src\app\models\Post;
use src\app\models\User;

class PostController
{
    private $db;
    private $post;
    private $user;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->post = new Post($this->db);
        $this->user = new User($this->db);
    }

    public function index()
    {
        $posts = $this->post->readAll();
        $user = $this->user->getById($_SESSION['user_id']);
        include __DIR__ . '/../views/posts/index.php';
    }

    public function view($id){
        $post = $this->post->getById($id);
        $user = $this->user->getById($_SESSION['user_id']);
        include __DIR__ . '/../views/posts/view.php';
    }

    public function create()
    {
        if (!isset($_SESSION['user_id'])) {
            include __DIR__ . '/../views/users/login.php';
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->post->name = htmlspecialchars(strip_tags($_POST['name']));
            $this->post->text = htmlspecialchars(strip_tags($_POST['text']));
            $this->post->author_id = $_SESSION['user_id'];

            if ($this->post->create()) {
                header('Location: /');
            } else {
                echo "Error: Unable to create post.";
            }
        } else {
            include __DIR__ . '/../views/posts/create.php';
        }
    }

    public function search($search = null)
    {
       $posts = $this->post->search($search);
       include __DIR__ . '/../views/posts/search.php';
    }
}
