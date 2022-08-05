<?php
    include 'classes/postSeeder.php';
    $posts = wad\PostSeeder::seed();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>title</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div id="content">
            <h1>Social Media</h1>
            <?php foreach($posts as $post) { ?>
                <div id="post">
                    <img src="<?= $post->getImage() ?>" width="50" height="50" alt="user image" />
                    <?= $post->getUser() ?>
                    <?= $post->getMessage() ?>
                    <?= $post->getDate() ?>
                </div>
            <?php } ?>
        </div>
    </body>
</html>