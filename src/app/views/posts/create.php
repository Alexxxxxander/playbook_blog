<?php
namespace src\app\views\posts;
include __DIR__ . '/../layout.php';

?>
<h1>Создать пост</h1>
<form method="post">
    <label for="name">Название:</label>
    <input type="text" name="name" required>
    <br>
    <label for="text">Текст:</label>
    <textarea name="text" required></textarea>
    <br>
    <input type="submit" value="Create">
</form>
