<?php
    include 'classes/postSeeder.php';
    $posts = wad\PostSeeder::seed();
    $posts[0]->addComment('Bob', 'Nice post!');
    $posts[0]->addComment('Tom', 'Good job~');
    $posts[1]->addComment('Fred', 'This is such a cice post!');
    $posts[2]->addComment('Unknown', 'Awesome!');
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
                    <img class="avatar" src="<?= $post->getImage() ?>" width="50" height="50" alt="user image" />
                    <?= $post->getUser() ?>
                    <?= $post->getDate() ?><br>
                    <?= $post->getMessage() ?><br>
                    <b>Comments:</b><br>
                    <?php $comments = $post -> getComment();
                    foreach($comments as $comment) { ?>
                        <?= $comment->getUser() ?>: <?= $comment->getComment() ?><br>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </body>
</html>