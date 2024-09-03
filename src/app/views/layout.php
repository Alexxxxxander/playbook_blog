<?php
namespace src\app\views;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NzBlog</title>
</head>
<body>
<nav>
    <a href="/">Домой</a>
    <?php if (isset($_SESSION['user_id'])) : ?>
        <a href="?page=create">Новый пост</a>
        <a href="?page=logout">Выйти</a>
    <?php else : ?>
        <a href="?page=login">Войти</a>
        <a href="?page=register">Зарегистрироваться</a>
    <?php endif; ?>
</nav>
<hr>
</body>
</html>
