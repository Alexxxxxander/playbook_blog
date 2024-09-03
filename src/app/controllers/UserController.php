<?php
namespace src\app\controllers;

use src\app\config\Database;
use src\app\models\User;

class UserController
{
    private $db;
    private $user;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->login = htmlspecialchars(strip_tags($_POST['login']));
            $this->user->password = md5(htmlspecialchars(strip_tags($_POST['password'])));
            $result = $this->user->create();
            if(is_string($result))  {
                $_SESSION['user_id'] = $result;
                var_dump($result);

                header('Location: /');
            } else {
                echo "Error: Unable to register.";
            }
        } else {
            include __DIR__ . '/../views/users/register.php';
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->login = htmlspecialchars(strip_tags($_POST['login']));
            $this->user->password = htmlspecialchars(strip_tags($_POST['password']));

            if ($this->user->login()) {
                $_SESSION['user_id'] = $this->user->id;
                header('Location: /');
            } else {
                echo "Error: Invalid login credentials.";
            }
        } else {
            include __DIR__ . '/../views/users/login.php';
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
    }
}
