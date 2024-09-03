<?php
namespace src\app\views\posts;
use PDO;

include __DIR__ . '/../layout.php';
?>
<!-- Поисковая форма -->
<form method="get" action="?page=search">
    <input type="text" name="search" placeholder="Поиск" required>
    <input type="hidden" name="page" value="search">
    <button type="submit">Найти</button>
</form>
<!--<p>Айди пользователя: <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "неизвестно"?></p> -->
<h1>Посты в блоге</h1>
<?php while ($row = $posts->fetch(PDO::FETCH_ASSOC)) : ?>
    <h2><a href="/?page=view&id=<?php echo $row['Id']; ?>"><?php echo $row['Name']; ?></a></h2>
    <p><?php echo mb_substr($row['Text'], 0,20) . "...";  ?></p>
    <p><strong>Author:</strong> <?php echo $row['Author']; ?></p>
<?php endwhile; ?>
