<?php
    $posts = array();
    $posts[] = array(
        'name' => 'Bob',
        'message' => 'hello',
        'image' => 'images/default.jpg',
        'date' => '1/1/11'
    );
    $posts[] = array(
        'name' => 'John',
        'message' => "It's a good day",
        'image' => 'images/default.jpg',
        'date' => '1/1/11'
    );
    $posts[] = array(
        'name' => 'Fred',
        'message' => "Sunny day",
        'image' => 'images/default.jpg',
        'date' => '4/5/16'
    );
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
                    <img src="<?= $post['image'] ?>" width="50" height="50" alt="user image" />
                    <?= $post['name'] ?>
                    <?= $post['message'] ?>
                    <?= $post['date'] ?>
                </div>
            <?php } ?>
        </div>
    </body>
</html>