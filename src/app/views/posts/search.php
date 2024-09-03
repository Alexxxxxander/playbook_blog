<?php
namespace src\app\views\posts;

use PDO;

include __DIR__ . '/../layout.php';
?>
    <h1>Результат поиска</h1>
    <?php if ($posts->rowCount() > 0) : ?>
    <?php while ($row = $posts->fetch(PDO::FETCH_ASSOC)) : ?>
        <h2><a href="/index.php?page=view&id=<?php echo $row['Id']; ?>"><?php echo $row['Name']; ?></a></h2>
        <p><?php echo $row['Text']; ?></p>
    <?php endwhile; ?>
<?php else : ?>
    <p>Отсутствуют результаты по запросу: "<?php echo htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8'); ?>"</p>
<?php endif; ?>