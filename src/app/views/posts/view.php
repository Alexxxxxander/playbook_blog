<?php
namespace src\app\views\posts;
use PDO;

include __DIR__ . '/../layout.php';
?>
<h1>Статья</h1>
<?php while ($row = $post->fetch(PDO::FETCH_ASSOC)) : ?>
    <h2><?php echo $row['Name']; ?></h2>
    <p><?php echo $row['Text'];  ?></p>
    <p><strong>Author:</strong> <?php echo $row['Author']; ?></p>
<?php endwhile; ?>
