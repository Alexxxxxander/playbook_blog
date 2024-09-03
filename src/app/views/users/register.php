<?php
namespace src\app\views\users;
include __DIR__ . '/../layout.php';
?>
<h1>Регистрация</h1>
<form method="post" action="?page=register">
    <label for="login">Логин:</label>
    <input type="text" name="login" required>
    <br>
    <label for="password">Пароль:</label>
    <input type="password" name="password" required>
    <br>
    <input type="submit" value="Зарегистрироваться">
</form>
