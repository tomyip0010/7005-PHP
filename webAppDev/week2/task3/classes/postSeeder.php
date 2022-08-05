<?php
namespace wad;
use wad\Post;
include 'post.php';

class PostSeeder{
    // This is a class to create an object of PostSeeder.
    public static function seed() {
        // This is a class to create an array of posts.
        $posts = [];
        $posts[] = new Post("Bob", "hi!", "images/default.jpg", "1/1/11");
        $posts[] = new Post("John", "It's a good day", "images/default.jpg", "1/1/11");
        $posts[] = new Post("Fred", "Sunny day", "images/default.jpg", "4/5/16");
        return $posts;
    }
}
?>